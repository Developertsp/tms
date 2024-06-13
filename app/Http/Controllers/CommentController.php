<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\Task;
use App\Services\PushNotificationService;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // return $request;

        $this->validate($request, [
            'comment' => 'required',
        ]);

        $comment = new Comment();

        $comment['user_id'] = Auth::id();
        $comment['task_id'] = $request->task_id;
        $comment['comment'] = $request->comment;
        $comment['is_private'] = 2;

        $comment->save();


        // Notification
        $task = Task::with('users')->find($request->task_id);
        $notification = new Notification();
        $notification['task_id']    = $request->task_id;
        $notification['title']      = 'New Comment';
        $notification['message']    = 'A new comment is added by '. Auth::user()->name;
        $notification['created_by'] = Auth::id();

        if (Auth::id() == $task->created_by) {
            // If the commenter is the creator, notify the assigned user
            $notification['user_id'] = $task->users[0]->id;
        } else {
            // If the commenter is the assigned user, notify the creator
            $notification['user_id'] = $task->created_by;
        }
        $notification->save();

        // push notification
        $msg_post = [
            'notification_message' => 'A new comment is added',
            'url' => route('tasks.show', ['id' => base64_encode($notification['task_id'])])
        ];
        $user_ids = [$notification['user_id']];
        $push_notification = new PushNotificationService();
        $push_notification->send($msg_post, $user_ids);

        return redirect()->route('tasks.show', ['id' => base64_encode($request->task_id)])->with('success', 'Comment added successfully');
    }
}
