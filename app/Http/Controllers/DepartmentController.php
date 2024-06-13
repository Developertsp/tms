<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:view-departments|create-departments|update-departments|delete-departments', ['only' => ['index','store']]);
        $this->middleware('permission:create-departments', ['only' => ['create','store']]);
        $this->middleware('permission:update-departments', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-departments', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data['departments'] = Department::where('is_enable', 1)->get();
        return view('departments.list', $data);
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|alpha_space|unique:departments,name'
        ]);

        $department = new Department();

        $department['name']    = $request->name;
        $department['created_by'] = Auth::id();

        $response = $department->save();

        return redirect()->route('departments.list')->with('success', 'Department created successfully');
    }

    public function edit($id)
    {
        $data['department'] = Department::where('is_enable', 1)->find($id);
        return view('departments.edit', $data);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|alpha_space|unique:departments,name,' . $request->id
        ]);

        $post_data['name']       = $request->name; 
        $post_data['updated_by'] = Auth::id(); 

        $department = Department::find($request->id);
        $response   = $department->update($post_data);

        return redirect()->route('departments.list')->with('success', 'Data successcully updated!');
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete($department);

        return redirect()->route('departments.list')->with('success', 'Data deleted successfully!');
    }
}
