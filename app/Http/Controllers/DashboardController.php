<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\PushNotificationService;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Task;
use App\Models\Attachment;
use App\Models\Project;
use App\Models\Log;
use App\Models\Company;
use App\Models\Department;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }

    public function index()
    {
        $today = Carbon::today();
        $user = Auth::user();
        $department_id = $user->department_id;

        if (system_role()) {

            // Count all tasks
            $data['totalCount'] = Task::where('is_enable', 1)->count();
            // Count tasks with specific statuses
            $data['assignedCount'] = Task::where('is_enable', 1)->where('status', 1)->count();
            $data['workStartedCount'] = Task::where('is_enable', 1)->where('status', 2)->count();
            $data['closedCount'] = Task::where('is_enable', 1)->where('status', 3)->count();

            // Today Count all tasks
            $data['todayTotalCount'] = Task::where('is_enable', 1)->whereDate('created_at', $today)->count();
            // Count Today tasks with specific statuses
            $data['todayAssignedCount'] = Task::where('is_enable', 1)->whereDate('created_at', $today)->where('status', 1)->count();
            $data['todayWorkStartedCount'] = Task::where('is_enable', 1)->whereDate('created_at', $today)->where('status', 2)->count();
            $data['todayClosedCount'] = Task::where('is_enable', 1)->whereDate('created_at', $today)->where('status', 3)->count();
           
            $data['companies'] = Company::where('is_enable', 1)->count();
            $data['departments'] = Department::where('is_enable', 1)->count();
            $data['projects'] = Project::where('is_enable', 1)->count();
            $data['users'] = User::where('is_enable', 1)->count();

        } else {
            
            // Count all tasks
            $data['totalCount'] = Task::where('is_enable', 1)->count();
            // Count tasks with specific statuses
            $data['assignedCount'] = Task::where('is_enable', 1)->where('status', 1)->count();
            $data['workStartedCount'] = Task::where('is_enable', 1)->where('status', 2)->count();
            $data['closedCount'] = Task::where('is_enable', 1)->where('status', 3)->count();
            $data['missedCount'] = Task::where('is_enable', 1)->where('status', '!=', 3)->whereDate('end_date', '<', \Carbon\Carbon::now()->format('Y-m-d'))->count();
            
            // Today Count all tasks
            $data['todayTotalCount'] = Task::where('is_enable', 1)->whereDate('created_at', $today)->count();
            // Count Today tasks with specific statuses
            $data['todayAssignedCount'] = Task::where('is_enable', 1)->whereDate('created_at', $today)->where('status', 1)->count();
            $data['todayWorkStartedCount'] = Task::where('is_enable', 1)->whereDate('created_at', $today)->where('status', 2)->count();
            $data['todayClosedCount'] = Task::where('is_enable', 1)->whereDate('created_at', $today)->where('status', 3)->count();
           
            $data['companies'] = Company::where('is_enable', 1)->count();
            $data['departments'] = Department::where('is_enable', 1)->count();
            $data['total_projects'] = Project::where(['is_enable' => 1, 'company_id' => user_company_id()])->count();
            $data['projects'] = Project::where(['is_enable' => 1, 'company_id' => user_company_id()])->orderBy('id','DESC')->take('5')->get();
            $data['users'] = User::where('is_enable', 1)->count();
        }

        return view('dashboard',$data);
    }
}
