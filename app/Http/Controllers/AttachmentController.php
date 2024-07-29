<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Notification;

class AttachmentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
<<<<<<< HEAD
            'file' => 'required|max:10240',
=======
            'file' => 'required|max:2048',
>>>>>>> f822cf6 (updation in the)
        ]);

        $task_id = $request->task_id;

        if ($request->file('file')) {
            $file       = $request->file('file');
            $file_name  = time() . '_' . uniqid('', true) . '.' . $file->getClientOriginalExtension();
            $org_name   = $file->getClientOriginalName();
            $request->file('file')->storeAs('public/tasks_file/', $file_name);

            $file_data = new Attachment();

            $file_data['task_id']       = $task_id;
            $file_data['file_name']     = $org_name;
            $file_data['path']          = $file_name;
            $file_data['created_by']    = Auth::id();

            $file_data->save();

            // Notification
            $task = Task::with('users')->find($task_id);
            
            $notification = new Notification();

            $notification['task_id']    = $request->task_id;
            $notification['title']      = 'New Attachment';
            $notification['message']    = 'A new attachment is added by '. Auth::user()->name;
            $notification['created_by'] = Auth::id();

            if (Auth::id() == $task->created_by) {
                // If user is creator, notify the assigned user
                $notification['user_id'] = $task->users[0]->id;
            } else {
                // If user is assigned user, notify the creator
                $notification['user_id'] = $task->created_by;
            }

            $notification->save();

            if($file_data){
                return response()->json(['success' => 'File uploaded'], 200);
            }
        }
    }
}
