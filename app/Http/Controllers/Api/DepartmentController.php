<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\Company;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');

    //     $this->middleware('permission:view-departments|create-departments|update-departments|delete-departments', ['only' => ['index', 'store']]);
    //     $this->middleware('permission:create-departments', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:update-departments', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:delete-departments', ['only' => ['destroy']]);
    // }

    public function index()
    {
        try {
            $user = auth('sanctum')->user();
            if (system_role()) {
                $departments = Department::with('company:id,name')->where('is_enable', 1)->orderBy('company_id')->get();
            } else {
                $departments = Department::where('is_enable', 1)->where('company_id', user_company_id())->orderBy('id')->get();
            }

            if ($departments->isEmpty()) {
                return response()->json(['status' => 'empty', 'message' => 'No department found'], 404);
            }
            return response()->json(['status' => 'success', 'message' => 'All departments', 'data' => [
                'user' => $user,
                'departments' => $departments
            ]]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error retrieving departments record', 'error' => $e->getMessage()], 500);
        }
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),  [
            'name' => 'required',
            'description' => 'required',
            'members' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $department = new Department();
        $department->name = $request->name;
        $department->description = $request->description;
        $department->members = $request->members;
        $department->email = $request->email ?? null;
        $department->company_id = user_company_id();
        $department->created_by = auth('sanctum')->user()->id;

        try {
            $department->save();

            return response()->json([
                'success' => 'success',
                'message' => 'Department created successfully',
                'data' => $department
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error creating department record', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),  [
            'name' => 'required',
            'description' => 'required',
            'members' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $department = Department::find($id);
        if(!$department)
        {
            return response()->json(['status' => 'empty','message' => 'Department not found'], 404);
        }
        
        try {
            $department->name = $request->name;
            $department->description = $request->description;
            $department->members = $request->members;
            $department->email = $request->email ?? null;
            $department->company_id = user_company_id();
            $department->updated_by = auth('sanctum')->user()->id;
            $department->save();

            return response()->json([
                'success' => 'success',
                'message' => 'Department updated successfully',
                'data' => $department
            ], 200);
          }catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error in updating department record', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
      try {
        $department = Department::find($id);
        if(!$department)
        {
            return response()->json(['status' => 'empty','message' => 'Department not found'], 404);
        }
        $department->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Department deleted successfully'
        ], 200);
      } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => 'Error in deleting department record', 'error' => $e->getMessage()], 500);
      }
    }
}
