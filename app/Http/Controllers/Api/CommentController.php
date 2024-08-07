<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        $this->validate($request, [
            'comment' => 'required',
            'task_id' => 'required|exists:tasks,id',
            'userId' => 'nullable|exists:users,id'
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->task_id = $request->task_id;
        $comment->comment = $request->comment;
        $comment->is_private = 2;
        $comment->save();

        // Notification
        $task = Task::with('users')->find($request->task_id);
        $notification = new Notification();
        $notification->task_id = $request->task_id;
        $notification->title = 'New Comment';
        $notification->message = 'A new comment is added by ' . Auth::user()->name;
        $notification->created_by = Auth::id();

        if (Auth::id() == $task->created_by) {
            // If the commenter is the creator, notify the assigned user
            $notification->user_id = $task->users[0]->id;
        } else {
            // If the commenter is the assigned user, notify the creator
            $notification->user_id = $task->created_by;
        }
        $notification->save();

        // Notification for tagged user
        if ($request->userId) {
            $tagged_user_notification = new Notification();
            $tagged_user_notification->task_id = $request->task_id;
            $tagged_user_notification->title = 'New Comment';
            $tagged_user_notification->message = 'You are tagged by ' . Auth::user()->name;
            $tagged_user_notification->created_by = Auth::id();
            $tagged_user_notification->user_id = $request->userId;
            $tagged_user_notification->save();

            // push notification to tagged user
            $tagged_user_id = [$request->userId];
            $tagged_user_post = [
                'notification_message' => 'You are tagged in a comment',
                'url' => route('tasks.show', ['id' => base64_encode($notification->task_id)])
            ];

            $push_notification_to_tagged_user = new PushNotificationService();
            $push_notification_to_tagged_user->send($tagged_user_post, $tagged_user_id);
        }

        // push notification
        $msg_post = [
            'notification_message' => 'A new comment is added',
            'url' => route('tasks.show', ['id' => base64_encode($notification->task_id)])
        ];

        $user_ids = [$notification->user_id];

        $push_notification = new PushNotificationService();
        $push_notification->send($msg_post, $user_ids);

        return response()->json(['message' => 'Comment added successfully', 'comment' => $comment], 201);
    }
}

