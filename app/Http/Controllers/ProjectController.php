<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:view-projects|create-projects|update-projects|delete-projects', ['only' => ['index','store']]);
        $this->middleware('permission:create-projects', ['only' => ['create','store']]);
        $this->middleware('permission:update-projects', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-projects', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data['projects'] = Project::where('is_enable', 1)->get();
        return view('projects.list', $data);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|alpha_space|unique:projects,name',
        ]);

        $project = new Project();
        
        $project['name'] = $request->name;
        $project['created_by'] = Auth::id();
        
        $response = $project->save();
    
        return redirect()->route('projects.list')->with('success','Project created successfully');
    }

    public function edit($id)
    {
        $data['project'] = Project::find($id);
        return view('projects.edit', $data);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|alpha_space|unique:projects,name,' . $request->id,
        ]);

        $post_data['name']          = $request->name;
        $post_data['updated_by']    = Auth::id();

        $project = Project::find($request->id);
        $response = $project->update($post_data);
    
        return redirect()->route('projects.list')->with('success','Data updated successfully');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete(); // Soft delete

        return redirect()->route('projects.list')->with('success', 'Record deleted successfully.');
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
