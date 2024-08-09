<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()],400);
        }
        $project = new Project();
        $project->name = $request->name;
        $project->description = $request->description ?? null;
        $project->plan = $request->project_plan ?? null;
        $project->department_id = $request->department_id ?? null;
        $project->ref_url = $request->ref_url ?? null;
        $project->deadline = $request->deadline ?? null;
        $project->company_id = user_company_id() ?? 2;
        $project->status = $request->status;
        $project->created_by = auth('sanctum')->user()->id;
        try {
            $project->save();
            return response()->json(['status' => 'success','message' => 'Project created successfully', 'project' => $project]);
        } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => 'Error in creating project record', 'error' => $e->getMessage()], 500);
        }
    }


    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $project = Project::find($id);

        if (!$project) {
            return response()->json(['status' => 'empty','message' => 'Project not found'], 404);
        }

        $project->name = $request->name;
        $project->description = $request->description;
        $project->plan = $request->project_plan;
        $project->department_id = $request->department_id;
        $project->ref_url = $request->ref_url;
        $project->deadline = $request->deadline;
        $project->status = $request->status;
        $project->updated_by = Auth::id();

       try {
            $project->save();
            return response()->json(['status' => 'success','message' => 'Project updated successfully', 'project' => $project]);
            } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error in updating project record', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id) :JsonResponse
    {  
     
        try {
            $project = Project::find($id);
            if (!$project) {
                return response()->json(['status' => 'empty','message' => 'Project not found'], 404);
            }
            $project->delete(); // Soft delete
            return response()->json(['status' => 'success','message' => 'Project deleted successfully']);
         }catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error in deleting projects record', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
         try {
            $project_id = $id;
            $project = Project::with('comments.user', 'attachments')->find($project_id);
    
            if (!$project) {
                return response()->json(['status' => 'empty','message' => 'Project not found'], 404);
            }
    
            $ref_url = explode('*', $project->ref_url);
            return response()->json([
                 'status' => 'success',
                 'message' => 'Project detail Retrieved',
                 'data' => [
                    'project' => $project,
                    'ref_url' => $ref_url,
                 ]
            ]);
         } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error in retrieving projects record', 'error' => $e->getMessage()], 500);
        }
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

