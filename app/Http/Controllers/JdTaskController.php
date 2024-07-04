<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JdTask;
use Spatie\Permission\Models\Role;

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
        return view('jd_tasks.list');
    }

    public function create()
    {
        $data['roles'] = Role::whereNull('company_id')->orderBy('id')->skip(1)->take(PHP_INT_MAX)->get();
        $data['frequency'] = config('constants.JD_TASK_FREQUENCY');
        return view('jd_tasks.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'         => 'required',
            'description'   => 'required',
            'role'          => 'required',
            'frequency'     => 'required',
        ]);

        $jd_task = new JdTask();
        
        $jd_task['title']       = $request->title;
        $jd_task['description'] = $request->description;
        $jd_task['role']        = $request->role;
        $jd_task['frequency']   = $request->frequency;
        $jd_task['company_id']  = user_company_id();
        $jd_task['created_by']  = Auth::id();
        
        $response = $jd_task->save();
    
        return redirect()->route('jd.list')->with('success','JD Task created successfully');
    }
}
