<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use Carbon\Carbon;
use App\Models\Log;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;

use App\Models\Attachment;
use App\Models\Department;
use App\Exports\TasksExport;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\PushNotificationService;


=======
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use App\Models\Attachment;
use App\Models\Log;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\PushNotificationService;

>>>>>>> f822cf6 (updation in the)
class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

<<<<<<< HEAD
        $this->middleware('permission:view-tasks|create-tasks|update-tasks|delete-tasks', ['only' => ['index', 'store']]);
        $this->middleware('permission:create-tasks', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-tasks', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-tasks', ['only' => ['destroy']]);
        parent::__construct();
=======
        $this->middleware('permission:view-tasks|create-tasks|update-tasks|delete-tasks', ['only' => ['index','store']]);
        $this->middleware('permission:create-tasks', ['only' => ['create','store']]);
        $this->middleware('permission:update-tasks', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-tasks', ['only' => ['destroy']]);
>>>>>>> f822cf6 (updation in the)
    }

    public function index()
    {
<<<<<<< HEAD
        $user = Auth::user();
        $department_id = $user->department_id;
        $data['department_id'] = $department_id; 
        if ($department_id) {
            if ($user->scope == 2) {
                $data['tasks'] = Task::where('is_enable', 1)->where('department_id', $department_id)->with('project', 'department', 'users', 'creator')->orderBy('id', 'desc')->get();
                $data['users'] = User::where('is_enable', 1)->where('department_id', $department_id)->where('company_id', user_company_id())->get();
            } else {
                $data['tasks'] = Task::whereHas('users', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->where('is_enable', 1)
                    ->with('project', 'department', 'users', 'creator')
                    ->orderBy('id', 'desc')
                    ->get();

                $data['users'] = User::where('is_enable', 1)->where('id', $user->id)->where('department_id', $department_id)->where('company_id', user_company_id())->get();
            }
            $data['departments'] = Department::where('is_enable', 1)->where('id', $department_id)->where('company_id', user_company_id())->get();
        } else {
            $data['tasks'] = Task::where('is_enable', 1)->with('project', 'department', 'users', 'creator')->orderBy('id', 'desc')->get();
            $data['users'] = User::where('is_enable', 1)->where('company_id', user_company_id())->get();
            $data['departments'] = Department::where('is_enable', 1)->where('company_id', user_company_id())->get();
        }

        $data['projects']   = Project::where('is_enable', 1)->where('company_id', user_company_id())->get();
=======
        // $data['tasks'] = Task::where('is_enable', 1)->with('project', 'users', 'creator')->orderBy('id', 'desc')->get();
        
        $user = Auth::user();
        $department_id = $user->department_id;

        if($department_id){
            $data['tasks'] = Task::whereHas('users', function ($query) use ($department_id) {
                $query->where('department_id', $department_id);
            })->where('is_enable', 1)
              ->with('project', 'users', 'creator')
              ->orderBy('id', 'desc')
              ->get();
        }
        else{
            $data['tasks'] = Task::where('is_enable', 1)->with('project', 'users', 'creator')->orderBy('id', 'desc')->get();
        }

>>>>>>> f822cf6 (updation in the)
        return view('tasks.list', $data);
    }

    public function show($id)
    {
<<<<<<< HEAD
        $user = Auth::user();
        $department_id = $user->department_id;

        $task_id        = base64_decode($id);
        $data['task']   = Task::with('project', 'users:id,name', 'attachments', 'comments.user', 'logs.user', 'tracking.user')->find($task_id);
        $data['assignedUsers'] = $data['task']->users->pluck('name', 'id')->toArray();
        // $data['users']      = User::where('is_enable', 1)->where('company_id', user_company_id())->get();
        $data['projects']   = Project::where('is_enable', 1)->where('company_id', user_company_id())->get();
        // $data['departments'] = Department::where('is_enable', 1)->where('company_id', user_company_id())->get();

        if ($department_id) {
            if ($user->scope == 2) {
                $data['users'] = User::where('is_enable', 1)->where('department_id', $department_id)->where('company_id', user_company_id())->get();
            } else {
                $data['users'] = User::where('is_enable', 1)->where('id', $user->id)->where('department_id', $department_id)->where('company_id', user_company_id())->get();
            }
            $data['departments'] = Department::where('is_enable', 1)->where('id', $department_id)->where('company_id', user_company_id())->get();
        } else {
            $data['users'] = User::where('is_enable', 1)->where('company_id', user_company_id())->get();
            $data['departments'] = Department::where('is_enable', 1)->where('company_id', user_company_id())->get();
        }
=======
        $task_id        = base64_decode($id);
        $data['task']   = Task::with('project', 'users', 'attachments', 'comments.user', 'logs.user')->find($task_id);
        $data['status'] = config('constants.STATUS_LIST');
>>>>>>> f822cf6 (updation in the)

        return view('tasks.show', $data);
    }

    public function create()
    {
<<<<<<< HEAD
        $user = Auth::user();
   
        $department_id = $user->department_id;
        

        $data['projects']   = Project::where('is_enable', 1)->where('company_id', user_company_id())->get();
        $data['status']     = config('constants.STATUS_LIST');
        $data['priority']   = config('constants.PRIORITY_LIST');

        if ($department_id) {
            if ($user->scope == 2) {
                $data['users'] = User::where('is_enable', 1)->where('department_id', $department_id)->where('company_id', user_company_id())->get();
            } else {
                $data['users'] = User::where('is_enable', 1)->where('id', $user->id)->where('department_id', $department_id)->where('company_id', user_company_id())->get();
            }
            $data['departments'] = Department::where('is_enable', 1)->where('id', $department_id)->where('company_id', user_company_id())->get();
        } else {
            $data['users'] = User::where('is_enable', 1)->where('company_id', user_company_id())->get();
            $data['departments'] = Department::where('is_enable', 1)->where('company_id', user_company_id())->get();
        }

=======
        $data['users']      = User::where('is_enable', 1)->get();
        $data['projects']   = Project::where('is_enable', 1)->get();
        $data['status']     = config('constants.STATUS_LIST');
        $data['priority']   = config('constants.PRIORITY_LIST');

>>>>>>> f822cf6 (updation in the)
        return view('tasks.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'project_id'    => 'required|numeric',
            'priority'      => 'required|numeric',
            'status'        => 'required|numeric',
            // 'assign_to'     => 'required|numeric',
            'attachment'   => 'max:2048',
            'title'         => 'required',
            'description'   => 'required',
        ]);

        $task = new Task();

<<<<<<< HEAD
        $task['company_id']     = user_company_id();
=======
>>>>>>> f822cf6 (updation in the)
        $task['project_id']     = $request->project_id;
        $task['priority']       = $request->priority;
        $task['status']         = $request->status;
        $task['title']          = $request->title;
        $task['description']    = $request->description;
        $task['created_by']     = Auth::id();
        $task['start_date']     = $request->start_date ?? NULL;
        $task['end_date']       = $request->end_date ?? NULL;
<<<<<<< HEAD
        $task['department_id']  = $request->department_id;

        $response = $task->save();

        // return $request->assign_to;
        if ($request->assign_to) {
            $users = $request->assign_to;
            $task->users()->attach($users);
        }

        if ($request->hasFile('attachment')) {
            $file       = $request->file('attachment');
            $file_name  = time() . '_' . uniqid('', true) . '.' . $file->getClientOriginalExtension();
            $org_name   = $file->getClientOriginalName();

=======

        $response = $task->save();

        $users = $request->assign_to;
        $task->users()->attach($users);

        if($request->hasFile('attachment')){
            $file       = $request->file('attachment');
            $file_name  = time() . '_' . uniqid('', true) . '.' . $file->getClientOriginalExtension();
            $org_name   = $file->getClientOriginalName();
            
>>>>>>> f822cf6 (updation in the)
            $request->file('attachment')->storeAs('public/tasks_file/', $file_name);

            $file_data = new Attachment();

            $file_data['task_id']       = $task->id;
            $file_data['file_name']     = $org_name;
            $file_data['path']          = $file_name;
            $file_data['created_by']    = Auth::id();

            $file_data->save();
        }

<<<<<<< HEAD
        if ($request->assign_to) {
            // Notification
            $notification = new Notification();

            $notification['task_id']    = $task->id;
            $notification['title']      = 'New Task Assigned';
            $notification['message']    = 'A new task is assigned to you by ' . Auth::user()->name;
            $notification['user_id']    = $request->assign_to;
            $notification['created_by'] = Auth::id();

            $notification->save();

            // push notification
            $msg_post = [
                'notification_message' => 'New task is assigned to you.',
                'url' => route('tasks.show', ['id' => base64_encode($notification['task_id'])])
            ];
            $user_ids = [$notification['user_id']];
            $push_notification = new PushNotificationService();
            $push_notification->send($msg_post, $user_ids);
        }

        return redirect()->route('tasks.list')->with('success', 'Task assigned successfully');
=======
        // Notification
        $notification = new Notification();

        $notification['task_id']    = $task->id;
        $notification['title']      = 'New Task Assigned';
        $notification['message']    = 'A new task is assigned to you by '. Auth::user()->name;
        $notification['user_id']    = $request->assign_to[0];
        $notification['created_by'] = Auth::id();

        $notification->save();

        // push notification
        $msg_post = [
            'notification_message' => 'New task is assigned to you.',
            'url' => route('tasks.show', ['id' => base64_encode($notification['task_id'])])
        ];
        $user_ids = [$notification['user_id']];
        $push_notification = new PushNotificationService();
        $push_notification->send($msg_post, $user_ids);

        return redirect()->route('tasks.list')->with('success','Task assigned successfully');
>>>>>>> f822cf6 (updation in the)
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'task_id' => 'required',
            'status' => 'required',
        ]);
<<<<<<< HEAD
=======
        
>>>>>>> f822cf6 (updation in the)
        // Find the task and store the old status
        $task = Task::find($request->task_id);
        $old_status = $task->status;

<<<<<<< HEAD
        $task['department_id']  = $request->department_id ?? Null;
        $task['project_id']     = $request->project_id;
        $task['priority']       = $request->priority;
        $task['status']         = $request->status;
        $task['title']          = $request->title;
        $task['description']    = $request->description;
        $task['updated_by']     = Auth::id();
        $task['start_date']     = $request->start_date ?? NULL;
        $task['end_date']       = $request->end_date ?? NULL;

        if($request->status == config('constants.TASK_STATUS')['Closed']){
            $task['closed_date'] = Carbon::now()->format('Y-m-d');
        }

        if($request->status == config('constants.TASK_STATUS')['Revision']){
            $task['revisions'] = $task->revisions + 1;

            // if revised then send notification to user
            $notification = new Notification();

            $notification['task_id']    = $request->task_id;
            $notification['title']      = 'Task Revised';
            $notification['message']    = 'You task is revised to you by ' . Auth::user()->name;
            $notification['user_id']    = $request->assign_to[0];
            $notification['created_by'] = Auth::id();

            $notification->save();

            // push notification
            $msg_post = [
                'notification_message' => 'You task is revised to you by ' . Auth::user()->name,
                'url' => route('tasks.show', ['id' => base64_encode($notification['task_id'])])
            ];
            $user_ids = [$notification['user_id']];
            $push_notification = new PushNotificationService();
            $push_notification->send($msg_post, $user_ids);


        }

        $task_response = $task->save();

        $users = array_filter($request->assign_to);
        if (!empty($users)) {
            $task->users()->sync($users);
        }

        if ($request->hasFile('attachment')) {
            $file       = $request->file('attachment');
            $file_name  = time() . '_' . uniqid('', true) . '.' . $file->getClientOriginalExtension();
            $org_name   = $file->getClientOriginalName();

            $request->file('attachment')->storeAs('public/tasks_file/', $file_name);

            $file_data = new Attachment();

            $file_data['task_id']       = $request->task_id;
            $file_data['file_name']     = $org_name;
            $file_data['path']          = $file_name;
            $file_data['created_by']    = Auth::id();

            $file_data->save();
        }

        if (!empty($users)) {
            // Notification
            $notification = new Notification();

            $notification['task_id']    = $request->task_id;
            $notification['title']      = 'Task Updated';
            $notification['message']    = 'You task is updated to you by ' . Auth::user()->name;
            $notification['user_id']    = $request->assign_to[0];
            $notification['created_by'] = Auth::id();

            $notification->save();

            // push notification
            $msg_post = [
                'notification_message' => 'Your task is updated to you.',
                'url' => route('tasks.show', ['id' => base64_encode($notification['task_id'])])
            ];
            $user_ids = [$notification['user_id']];
            $push_notification = new PushNotificationService();
            $push_notification->send($msg_post, $user_ids);
        }
=======
        // Prepare the task data for update
        $task_data['status'] = $request->status;
        $task_data['updated_by'] = Auth::id();
        $task_response = $task->update($task_data);
        

>>>>>>> f822cf6 (updation in the)
        // Create a log entry
        $log_data = new Log();
        $log_data['user_id']    = Auth::id();
        $log_data['task_id']    = $request->task_id;
        $log_data['old_status'] = $old_status;
        $log_data['status']     = $request->status;
        $log_data->save();

        $old_status = config('constants.STATUS_LIST')[$old_status];
        $new_status = config('constants.STATUS_LIST')[$request->status];
<<<<<<< HEAD

        $message = '. Changed status from ' . $old_status . ' to ' . $new_status;

=======
        
        $message = '. Changed status from '.$old_status.' to '.$new_status; 
        
>>>>>>> f822cf6 (updation in the)
        // Notification
        $notification = new Notification();
        $notification['task_id']    = $request->task_id;
        $notification['title']      = 'Status Changed';
        $notification['message']    = 'Task # ' . $request->task_id . $message . Auth::user()->name;
        $notification['created_by'] = Auth::id();

        if (Auth::id() == $task->created_by) {
            // If user is creator, notify the assigned user
            $notification['user_id'] = $task->users[0]->id;
        } else {
            // If user is assigned user, notify the creator
            $notification['user_id'] = $task->created_by;
        }
        $notification->save();

        // push notification
        $msg_post = [
            'notification_message' => 'Task Staus Changed.',
            'url' => route('tasks.show', ['id' => base64_encode($notification['task_id'])])
        ];
        $user_ids = [$notification['user_id']];
        $push_notification = new PushNotificationService();
        $push_notification->send($msg_post, $user_ids);

        return redirect()->route('tasks.show', ['id' => base64_encode($request->task_id)])->with('success', 'Task updated successfully');
    }
<<<<<<< HEAD

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete($task);

        return redirect()->route('tasks.list')->with('success', 'Data deleted successfully!');
    }

    public function report()
    {
        $user = Auth::user();
        $department_id = $user->department_id;

        // $data['users']      = User::where('is_enable', 1)->where('company_id', user_company_id())->get();
        $data['projects']   = Project::where('is_enable', 1)->where('company_id', user_company_id())->get();
        // $data['departments'] = Department::where('is_enable', 1)->where('company_id', user_company_id())->get();
        $data['status']     = config('constants.STATUS_LIST');
        $data['priority']   = config('constants.PRIORITY_LIST');

        if ($department_id) {
            if ($user->scope == 2) {
                $data['users'] = User::where('is_enable', 1)->where('department_id', $department_id)->where('company_id', user_company_id())->get();
            } else {
                $data['users'] = User::where('is_enable', 1)->where('id', $user->id)->where('department_id', $department_id)->where('company_id', user_company_id())->get();
            }
            $data['departments'] = Department::where('is_enable', 1)->where('id', $department_id)->where('company_id', user_company_id())->get();
        } else {
            $data['users'] = User::where('is_enable', 1)->where('company_id', user_company_id())->get();
            $data['departments'] = Department::where('is_enable', 1)->where('company_id', user_company_id())->get();
        }

        return view('tasks.report', $data);
    }

    public function export(Request $request)
    {
        // Start with a base query
        $query = Task::where('is_enable', 1)
            ->with('project', 'department', 'users', 'creator')
            ->orderBy('id', 'desc');

        if(Auth::user()->scope == 2){
            $query->where('department_id', Auth::user()->department_id);
        }

        if(Auth::user()->scope == 3){
            $query->whereHas('users', function ($query) {
                $query->where('user_id', Auth::user()->id);
            });
        }

        // Apply filters based on request parameters
        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        if ($request->filled('project_id')) {
            $query->where('project_id', $request->project_id);
        }

        if ($request->filled('assign_to')) {
            $assignTo = array_filter($request->assign_to);
            if (!empty($assignTo)) {
                $query->whereHas('users', function ($query) use ($assignTo) {
                    $query->whereIn('user_id', $assignTo);
                });
            }
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('start_date')) {
            $startDate = \Carbon\Carbon::parse($request->start_date)->startOfDay();
            $query->whereDate('start_date', '>=', $startDate);
        }

        if ($request->filled('end_date')) {
            $endDate = \Carbon\Carbon::parse($request->end_date)->endOfDay();
            $query->whereDate('end_date', '<=', $endDate);
        }

        if ($request->filled('performance')) {
            $performance = $request->performance;
            $todayDate = Carbon::today()->format('Y-m-d');
            
            if ($performance === 'D_Missed') {
                $query->where(function ($query) use ($todayDate) {
                    $query->where(function ($query) {
                        $query->whereColumn('closed_date', '>', 'end_date');
                    })->orWhere(function ($query) use ($todayDate) {
                        $query->whereNotNull('end_date')
                            ->where('end_date', '<', $todayDate)
                            ->whereNull('closed_date');
                    });
                });

            }
            elseif ($performance === 'D_Achieved') {
                $query->whereNotNull('end_date')
                    ->whereColumn('closed_date', '<=', 'end_Date')
                    ->where('status', 3);
            }
        }

        $tasks = $query->pluck('id');

        // Download the Excel file using TasksExport
        return Excel::download(new TasksExport($tasks), 'tasks.xlsx');
    }

    public function update_task_deadline(Request $request)
    {
        $task = Task::find($request->task_id);

        if($task->end_date){
            $this->validate($request, [
                'end_date' => 'required',
                'reason' => 'required',
            ]);
        }
        else{
            $this->validate($request, [
                'end_date' => 'required',
            ]);
        }

        $task['end_date']  = $request->end_date ?? NULL;
        $task['deadline_reason']  = $request->reason ?? NULL;
        $task_response = $task->save();

        return redirect()->route('tasks.show', ['id' => base64_encode($request->task_id)])->with('success', 'Task updated successfully');
    }
=======
>>>>>>> f822cf6 (updation in the)
}
