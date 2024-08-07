<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JdTask;
use Spatie\Permission\Models\Role;
use App\Models\User;

class JdTaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');

        $this->middleware('permission:view-jd-tasks|create-jd-tasks|update-jd-tasks|delete-jd-tasks', ['only' => ['index', 'store']]);
        $this->middleware('permission:create-jd-tasks', ['only' => ['store']]);
        $this->middleware('permission:update-jd-tasks', ['only' => ['update']]);
        $this->middleware('permission:delete-jd-tasks', ['only' => ['destroy']]);
    }

    public function index()
    {
        $task_list = JdTask::with('user')->where('company_id', user_company_id())->get();

        return response()->json([
            'success' => true,
            'data' => $task_list
        ], 200);
    }

    public function create()
    {
        $roles = Role::where('company_id', user_company_id())->orderBy('id')->get();
        $frequency = config('constants.JD_TASK_FREQUENCY');

        return response()->json([
            'success' => true,
            'data' => [
                'roles' => $roles,
                'frequency' => $frequency
            ]
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'role' => 'required',
            'user' => 'required|array',
            'frequency' => 'required',
        ]);

        try {
            foreach ($request->user as $user) {
                $jd_task = new JdTask();

                $jd_task->title = $request->title;
                $jd_task->description = $request->description;
                $jd_task->role = $request->role;
                $jd_task->user_id = $user;
                $jd_task->frequency = $request->frequency;
                $jd_task->company_id = user_company_id();
                $jd_task->created_by = Auth::id();

                $jd_task->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'JD Task created successfully'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the JD Task: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $jd_task = JdTask::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $jd_task
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'role' => 'required',
            'user' => 'required',
            'frequency' => 'required',
        ]);

        $jd_task = JdTask::findOrFail($id);
        $jd_task->title = $request->title;
        $jd_task->description = $request->description;
        $jd_task->role = $request->role;
        $jd_task->user_id = $request->user;
        $jd_task->frequency = $request->frequency;
        $jd_task->updated_by = Auth::id();

        $jd_task->save();

        return response()->json([
            'success' => true,
            'message' => 'JD Task updated successfully',
            'data' => $jd_task
        ], 200);
    }

    public function destroy($id)
    {
        $jd_task = JdTask::findOrFail($id);
        $jd_task->delete();

        return response()->json([
            'success' => true,
            'message' => 'JD Task deleted successfully'
        ], 200);
    }
}
