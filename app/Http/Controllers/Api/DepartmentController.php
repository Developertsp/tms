<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\Company;

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

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'members' => 'required',
        ]);

        $department = new Department();
        $department->name = $request->name;
        $department->description = $request->description;
        $department->members = $request->members;
        $department->email = $request->email ?? null;
        $department->company_id = user_company_id();
        $department->created_by = Auth::id();

        $department->save();

        return response()->json([
            'success' => true,
            'message' => 'Department created successfully',
            'data' => $department
        ], 201);
    }

    public function show($id)
    {
        $department = Department::with('company:id,name')->where('is_enable', 1)->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $department
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'members' => 'required',
        ]);

        $department = Department::findOrFail($id);
        $department->name = $request->name;
        $department->description = $request->description;
        $department->members = $request->members;
        $department->email = $request->email ?? null;
        $department->company_id = user_company_id();
        $department->updated_by = Auth::id();

        $department->save();

        return response()->json([
            'success' => true,
            'message' => 'Department updated successfully',
            'data' => $department
        ], 200);
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return response()->json([
            'success' => true,
            'message' => 'Department deleted successfully'
        ], 200);
    }
}
