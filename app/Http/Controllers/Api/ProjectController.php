<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');

        // $this->middleware('permission:view-projects|create-projects|update-projects|delete-projects', ['only' => ['index', 'store']]);
        // $this->middleware('permission:create-projects', ['only' => ['create', 'store']]);
        // $this->middleware('permission:update-projects', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:delete-projects', ['only' => ['destroy']]);
    }

    public function index()
    {
        try{
        if (system_role()) {
            $projects = Project::with('company:id,name')->where('is_enable', 1)->orderBy('company_id')->get();
        } else {
            $projects = Project::where('is_enable', 1)->where('company_id', user_company_id())->orderBy('id')->get();
        }
        
        if ($projects->isEmpty()) {
            return response()->json(['status' => 'empty', 'message' => 'No projects found'], 404);
        }

        return response()->json(['status' => 'success', 'message' => 'projects retrieved successfully', 'data' => $projects]);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => 'Error retrieving projects', 'error' => $e->getMessage()], 500);
    }
    }

    public function create()
    {
        $user = Auth::user();
        $department_id = $user->department_id;

        if ($department_id) {
            $departments = Department::where('is_enable', 1)->where('id', $department_id)->where('company_id', user_company_id())->get();
        } else {
            $departments = Department::where('is_enable', 1)->where('company_id', user_company_id())->get();
        }

        $status = config('constants.PROJECT_STATUS_LIST');

        return response()->json([
            'departments' => $departments,
            'status' => $status
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $project = new Project();
        $project->name = $request->name;
        $project->description = $request->description ?? null;
        $project->plan = $request->project_plan ?? null;
        $project->department_id = $request->department_id ?? null;
        $project->ref_url = $request->ref_url ?? null;
        $project->deadline = $request->deadline ?? null;
        $project->company_id = user_company_id();
        $project->status = $request->status;
        $project->created_by = Auth::id();

        $project->save();

        return response()->json(['message' => 'Project created successfully', 'project' => $project]);
    }

    public function edit($id)
    {
        $user = Auth::user();
        $department_id = $user->department_id;

        if ($department_id) {
            $departments = Department::where('is_enable', 1)->where('id', $department_id)->where('company_id', user_company_id())->get();
        } else {
            $departments = Department::where('is_enable', 1)->where('company_id', user_company_id())->get();
        }

        $status = config('constants.PROJECT_STATUS_LIST');
        $project = Project::find($id);

        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        return response()->json([
            'departments' => $departments,
            'status' => $status,
            'project' => $project
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $project = Project::find($request->id);

        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $project->name = $request->name;
        $project->description = $request->description;
        $project->plan = $request->project_plan;
        $project->department_id = $request->department_id;
        $project->ref_url = $request->ref_url;
        $project->deadline = $request->deadline;
        $project->status = $request->status;
        $project->updated_by = Auth::id();

        $project->save();

        return response()->json(['message' => 'Project updated successfully', 'project' => $project]);
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete(); // Soft delete

        return response()->json(['message' => 'Project deleted successfully']);
    }

    public function show($id)
    {
        $project_id = base64_decode($id);
        $project = Project::with('comments.user', 'attachments')->find($project_id);

        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $ref_url = explode('*', $project->ref_url);

        return response()->json([
            'project' => $project,
            'ref_url' => $ref_url
        ]);
    }

    public function soft_delete_functions($id)
    {
        // Soft delete a record
        $record = Project::find($id);
        $record->delete();

        // Querying soft deleted records
        $allRecords = Project::withTrashed()->get(); // Includes soft deleted
        $trashedRecords = Project::onlyTrashed()->get(); // Only soft deleted

        // Restoring a soft deleted record
        $trashedRecord = Project::withTrashed()->find($id);
        $trashedRecord->restore();

        // Permanently deleting a record
        $trashedRecord->forceDelete();
    }
}

