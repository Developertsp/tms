<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JdTask;
use Spatie\Permission\Models\Role;
use App\Models\Task;
use Carbon\Carbon;
use App\Models\User;

class JdTaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:view-jd-tasks|create-jd-tasks|update-jd-tasks|delete-jd-tasks', ['only' => ['index','store']]);
        $this->middleware('permission:create-jd-tasks', ['only' => ['create','store']]);
        $this->middleware('permission:update-jd-tasks', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-jd-tasks', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data['task_list'] = JdTask::with('user')->where('company_id', user_company_id())->get();
        return view('jd_tasks.list', $data);
    }

    public function create()
    {
        $data['roles'] = Role::where('company_id', user_company_id())->orderBy('id')->get();
        $data['frequency'] = config('constants.JD_TASK_FREQUENCY');
        return view('jd_tasks.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'         => 'required',
            'description'   => 'required',
            'role'          => 'required',
            'user'          => 'required',
            'frequency'     => 'required',
        ]);

        $jd_task = new JdTask();
        
        $jd_task['title']       = $request->title;
        $jd_task['description'] = $request->description;
        $jd_task['role']        = $request->role;
        $jd_task['user_id']     = $request->user;
        $jd_task['frequency']   = $request->frequency;
        $jd_task['company_id']  = user_company_id();
        $jd_task['created_by']  = Auth::id();
        
        $response = $jd_task->save();
    
        return redirect()->route('jd.list')->with('success','JD Task created successfully');
    }

    public function edit($id)
    {
        $data['roles'] = Role::where('company_id', user_company_id())->orderBy('id')->get();
        $data['frequency'] = config('constants.JD_TASK_FREQUENCY');
        $data['jd_task'] = JdTask::find($id);
        
        $roles = Role::find($data['jd_task']->role);
        $data['users'] = User::role($roles->name)->where('company_id', user_company_id())->where('is_enable', 1)->orderBy('id')->get();

        return view('jd_tasks.edit', $data);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title'         => 'required',
            'description'   => 'required',
            'role'          => 'required',
            'user'          => 'required',
            'frequency'     => 'required',
        ]);

        $post_data['title']       = $request->title;
        $post_data['description'] = $request->description;
        $post_data['role']        = $request->role;
        $post_data['user_id']     = $request->user;
        $post_data['frequency']   = $request->frequency;
        $post_data['updated_by']  = Auth::id();

        $jd_task = JdTask::find($request->id);
        $response   = $jd_task->update($post_data);

        return redirect()->route('jd.list')->with('success', 'Data successcully updated!');
    }

    public function destroy($id)
    {
        $jd_task = JdTask::findOrFail($id);
        $jd_task->delete($jd_task);

        return redirect()->route('jd.list')->with('success', 'Data deleted successfully!');
    }

    public function cronJob(Request $request)
    {
        // link http://127.0.0.1:8000/jd/cronJob?id=8
        $user_id = $request->id;

        $jd_tasks = JdTask::where('is_enable', 1)->where('user_id', $user_id)->get();

        $today = Carbon::today(config('app.timezone'))->format('Y-m-d');;

        foreach ($jd_tasks as $jd_task){
            $task = new Task();

            $task['priority']       = 3;
            $task['status']         = 1;
            $task['title']          = $jd_task->title;
            $task['description']    = $jd_task->description;
            $task['created_by']     = $user_id;
            $task['start_date']     = $today;
            $task['end_date']       = $today;

            $response = $task->save();

            $user = $user_id;
            $task->users()->attach($user);
        }

        echo 'complete';
    }
}