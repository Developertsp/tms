<?php

namespace App\Http\Controllers\Api;
use Carbon\Carbon;
use App\Models\Log;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use App\Models\Attachment;
use App\Models\Department;
use App\Exports\TasksExport;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\PushNotificationService;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');

        $this->middleware('permission:view-tasks|create-tasks|update-tasks|delete-tasks', ['only' => ['index', 'store']]);
        $this->middleware('permission:create-tasks', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-tasks', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-tasks', ['only' => ['destroy']]);
    }

    public function index()
    {
        $user = Auth::user();
        $department_id = $user->department_id;

        if ($department_id) {
            if ($user->scope == 2) {
                $tasks = Task::where('is_enable', 1)->where('department_id', $department_id)->with('project', 'department', 'users', 'creator')->orderBy('id', 'desc')->get();
                $users = User::where('is_enable', 1)->where('department_id', $department_id)->where('company_id', user_company_id())->get();
            } else {
                $tasks = Task::whereHas('users', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->where('is_enable', 1)
                    ->with('project', 'department', 'users', 'creator')
                    ->orderBy('id', 'desc')
                    ->get();

                $users = User::where('is_enable', 1)->where('id', $user->id)->where('department_id', $department_id)->where('company_id', user_company_id())->get();
            }
            $departments = Department::where('is_enable', 1)->where('id', $department_id)->where('company_id', user_company_id())->get();
        } else {
            $tasks = Task::where('is_enable', 1)->with('project', 'department', 'users', 'creator')->orderBy('id', 'desc')->get();
            $users = User::where('is_enable', 1)->where('company_id', user_company_id())->get();
            $departments = Department::where('is_enable', 1)->where('company_id', user_company_id())->get();
        }

        $projects = Project::where('is_enable', 1)->where('company_id', user_company_id())->get();

        return response()->json([
            'tasks' => $tasks,
            'users' => $users,
            'departments' => $departments,
            'projects' => $projects
        ]);
    }

    public function show($id)
    {
        $task_id = base64_decode($id);
        $task = Task::with('project', 'users:id,name', 'attachments', 'comments.user', 'logs.user', 'tracking.user')->find($task_id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $user = Auth::user();
        $department_id = $user->department_id;

        if ($department_id) {
            if ($user->scope == 2) {
                $users = User::where('is_enable', 1)->where('department_id', $department_id)->where('company_id', user_company_id())->get();
            } else {
                $users = User::where('is_enable', 1)->where('id', $user->id)->where('department_id', $department_id)->where('company_id', user_company_id())->get();
            }
            $departments = Department::where('is_enable', 1)->where('id', $department_id)->where('company_id', user_company_id())->get();
        } else {
            $users = User::where('is_enable', 1)->where('company_id', user_company_id())->get();
            $departments = Department::where('is_enable', 1)->where('company_id', user_company_id())->get();
        }

        $projects = Project::where('is_enable', 1)->where('company_id', user_company_id())->get();

        return response()->json([
            'task' => $task,
            'users' => $users,
            'departments' => $departments,
            'projects' => $projects
        ]);
    }

    public function create()
    {
        $user = Auth::user();
        $department_id = $user->department_id;

        $projects = Project::where('is_enable', 1)->where('company_id', user_company_id())->get();
        $status = config('constants.STATUS_LIST');
        $priority = config('constants.PRIORITY_LIST');

        if ($department_id) {
            if ($user->scope == 2) {
                $users = User::where('is_enable', 1)->where('department_id', $department_id)->where('company_id', user_company_id())->get();
            } else {
                $users = User::where('is_enable', 1)->where('id', $user->id)->where('department_id', $department_id)->where('company_id', user_company_id())->get();
            }
            $departments = Department::where('is_enable', 1)->where('id', $department_id)->where('company_id', user_company_id())->get();
        } else {
            $users = User::where('is_enable', 1)->where('company_id', user_company_id())->get();
            $departments = Department::where('is_enable', 1)->where('company_id', user_company_id())->get();
        }

        return response()->json([
            'projects' => $projects,
            'status' => $status,
            'priority' => $priority,
            'users' => $users,
            'departments' => $departments
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'project_id'    => 'required|numeric',
            'priority'      => 'required|numeric',
            'status'        => 'required|numeric',
            'attachment'   => 'max:2048',
            'title'         => 'required',
            'description'   => 'required',
        ]);

        $task = new Task();

        $task->company_id     = user_company_id();
        $task->project_id     = $request->project_id;
        $task->priority       = $request->priority;
        $task->status         = $request->status;
        $task->title          = $request->title;
        $task->description    = $request->description;
        $task->created_by     = Auth::id();
        $task->start_date     = $request->start_date ?? NULL;
        $task->end_date       = $request->end_date ?? NULL;
        $task->department_id  = $request->department_id;

        $task->save();

        if ($request->assign_to) {
            $users = $request->assign_to;
            $task->users()->attach($users);
        }

        if ($request->hasFile('attachment')) {
            $file       = $request->file('attachment');
            $file_name  = time() . '_' . uniqid('', true) . '.' . $file->getClientOriginalExtension();
            $org_name   = $file->getClientOriginalName();

            $request->file('attachment')->storeAs('public/tasks_file/', $file_name);

            $file_data = new Attachment();
            $file_data->task_id       = $task->id;
            $file_data->file_name     = $org_name;
            $file_data->path          = $file_name;
            $file_data->created_by    = Auth::id();

            $file_data->save();
        }

        if ($request->assign_to) {
            $notification = new Notification();

            $notification->task_id    = $task->id;
            $notification->title      = 'New Task Assigned';
            $notification->message    = 'A new task is assigned to you by ' . Auth::user()->name;
            $notification->user_id    = $request->assign_to;
            $notification->created_by = Auth::id();

            $notification->save();

            $msg_post = [
                'notification_message' => 'New task is assigned to you.',
                'url' => route('tasks.show', ['id' => base64_encode($notification->task_id)])
            ];
            $user_ids = [$notification->user_id];
            $push_notification = new PushNotificationService();
            $push_notification->send($msg_post, $user_ids);
        }

        return response()->json(['message' => 'Task assigned successfully', 'task' => $task]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'task_id'       => 'required|numeric',
            'project_id'    => 'required|numeric',
            'priority'      => 'required|numeric',
            'status'        => 'required|numeric',
            'attachment'    => 'max:2048',
            'title'         => 'required',
            'description'   => 'required',
        ]);

        $task = Task::find($request->task_id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->project_id     = $request->project_id;
        $task->priority       = $request->priority;
        $task->status         = $request->status;
        $task->title          = $request->title;
        $task->description    = $request->description;
        $task->updated_by     = Auth::id();
        $task->start_date     = $request->start_date ?? NULL;
        $task->end_date       = $request->end_date ?? NULL;
        $task->department_id  = $request->department_id;

        $task->save();

        if ($request->assign_to) {
            $users = $request->assign_to;
            $task->users()->sync($users);
        }

        if ($request->hasFile('attachment')) {
            $file       = $request->file('attachment');
            $file_name  = time() . '_' . uniqid('', true) . '.' . $file->getClientOriginalExtension();
            $org_name   = $file->getClientOriginalName();

            $request->file('attachment')->storeAs('public/tasks_file/', $file_name);

            $file_data = new Attachment();
            $file_data->task_id       = $task->id;
            $file_data->file_name     = $org_name;
            $file_data->path          = $file_name;
            $file_data->created_by    = Auth::id();

            $file_data->save();
        }

        return response()->json(['message' => 'Task updated successfully', 'task' => $task]);
    }

    public function destroy($id)
    {
        $task_id = base64_decode($id);
        $task = Task::find($task_id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->is_enable = 0;
        $task->save();

        return response()->json(['message' => 'Task deleted successfully']);
    }
}
