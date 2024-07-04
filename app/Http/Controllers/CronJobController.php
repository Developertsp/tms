<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JdTask;
use Illuminate\Support\Carbon;
use App\Models\Task;

class CronJobController extends Controller
{
    public function cronJobDaily(Request $request)
    {
        if($request->key == 'HamzaTspUK007'){
            $user_id = $request->id;

            $jd_tasks = JdTask::where('is_enable', 1)->where('user_id', $user_id)->where('frequency', 1)->get();

            if(count($jd_tasks) > 0){
                $today = Carbon::today(config('app.timezone'))->format('Y-m-d');

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
        else{
            echo 'wrong';
        }
    }

    public function cronJobWeekly(Request $request)
    {
        if($request->key == 'HamzaTspUK007'){
            $user_id = $request->id;

            $jd_tasks = JdTask::where('is_enable', 1)->where('user_id', $user_id)->where('frequency', 2)->get();

            if(count($jd_tasks) > 0){
                $today = Carbon::today(config('app.timezone'))->format('Y-m-d');

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
        else{
            echo 'wrong';
        }
    }

    public function cronJobMonthly(Request $request)
    {
        if($request->key == 'HamzaTspUK007'){
            $user_id = $request->id;

            $jd_tasks = JdTask::where('is_enable', 1)->where('user_id', $user_id)->where('frequency', 3)->get();

            if(count($jd_tasks) > 0){
                $today = Carbon::today(config('app.timezone'))->format('Y-m-d');

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
        else{
            echo 'wrong';
        }
    }
}
