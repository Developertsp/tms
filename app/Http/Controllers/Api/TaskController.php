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
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    
        // Apply abilities middleware based on the action
        // $this->middleware('abilities:view-tasks|create-tasks', ['only' => ['index', 'store']]);
        // $this->middleware('abilities:create-tasks', ['only' => ['create']]);
        // $this->middleware('abilities:update-tasks', ['only' => ['edit', 'update']]);
        // $this->middleware('abilities:delete-tasks', ['only' => ['destroy']]);
    }
    

    public function index()
    {
        $user = auth('sanctum')->user();
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
            'status' => 'success',
            'message' => 'Data Retrieved',
            'data' => [
                'tasks' => $tasks,
                'users' => $users,
                'departments' => $departments,
                'projects' => $projects
            ]
        ]);
    }

    public function show($id)
    {
        $task_id = base64_decode($id);
        $task = Task::with('project', 'users:id,name', 'attachments', 'comments.user', 'logs.user', 'tracking.user')->find($task_id);

        if (!$task) {
            return response()->json(['status'=>'success','message' => 'Task not found'], 404);
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
            'status' => 'success',
            'message' => 'Data retrieved Successfully',
            'data' => [
                'task' => $task,
                'users' => $users,
                'departments' => $departments,
                'projects' => $projects
            ]
        ]);
    }


    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_id'    => 'required|string',
            'priority'      => 'required|string',
            'status'        => 'required|string',
            'attachment'   => 'max:2048',
            'title'         => 'required',
            'description'   => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 400);
        }
        try {
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

            return response()->json(['status' => 'success', 'message' => 'Task assigned successfully', 'task' => $task]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error in assigning task', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task_id'       => 'required|string',
            'project_id'    => 'required|string',
            'priority'      => 'required|string',
            'status'        => 'required',
            'attachment'    => 'max:2048',
            'title'         => 'required',
            'description'   => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 400);
        }

        $task = Task::find($request->task_id);

        if (!$task) {
            return response()->json(['status' => 'error','message' => 'Task not found'], 404);
        }

        try {
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
            return response()->json(['status' => 'success', 'message' => 'Task updated successfully', 'task' => $task]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error in updating task', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        // $task_id = base64_decode($id);
        try {
            $task_id = $id;
            $task = Task::find($task_id);
            if (!$task) {
                return response()->json(['status' => 'empty','message' => 'Task not found'], 404);
            }

            $task->is_enable = 0;
            $task->delete();

            return response()->json(['status' => 'success', 'message' => 'Task deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error in deleting tasks record', 'error' => $e->getMessage()], 500);
        }
    }
}
