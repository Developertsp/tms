<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

//models..
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
=======
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
>>>>>>> f822cf6 (updation in the)

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

<<<<<<< HEAD
        $this->middleware('permission:view-roles|create-roles|update-roles|delete-roles', ['only' => ['index', 'store']]);
        $this->middleware('permission:create-roles', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-roles', ['only' => ['edit', 'update']]);
=======
        $this->middleware('permission:view-roles|create-roles|update-roles|delete-roles', ['only' => ['index','store']]);
        $this->middleware('permission:create-roles', ['only' => ['create','store']]);
        $this->middleware('permission:update-roles', ['only' => ['edit','update']]);
>>>>>>> f822cf6 (updation in the)
        $this->middleware('permission:delete-roles', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
<<<<<<< HEAD
        $data['user'] = Auth::user();
        
        if (system_role()) {
            $data['roles'] = Role::whereNull('company_id')->orderBy('id')->skip(1)->take(PHP_INT_MAX)->get();
        } else {
            $data['roles'] = Role::where('company_id', user_company_id())->orderBy('id')->get();
        }
=======
        $data['roles'] = Role::get();
>>>>>>> f822cf6 (updation in the)
        return view('roles.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
<<<<<<< HEAD
        $permissions = Permission::orderBy('id')->skip(4)->take(PHP_INT_MAX)->get();
        return view('roles.create', compact('permissions'));
=======
        $data['permissions'] = Permission::get();
        return view('roles.create', $data);
>>>>>>> f822cf6 (updation in the)
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
<<<<<<< HEAD
            'name' => 'required',
            'permissions' => 'required|array|min:1'
        ]);

        $companyRoleName = user_company_id() . '#' . $request->input('name');
        $companyId = user_company_id();
        $existingRole = Role::where('name', $companyRoleName)
                            ->where('company_id', $companyId)
                            ->first();
    
        if ($existingRole) {
            return redirect()->back()->withErrors(['name' => 'The role name is already taken.'])->withInput();
        }
        
        $role = Role::create([
            'name' => $companyRoleName,
        ]);

        $role->company_id = user_company_id();
        $role->save();
        if ($request->input('permissions')) {
            $permissions = array_map('intval', $request->input('permissions'));
            $role->syncPermissions($permissions);
        }

        return redirect()->route('roles.index')->with('success', 'Role created successfully');
=======
            'name' => 'required|alpha_space|unique:roles,name',
        ]);

        $role = Role::create(['name' => $request->input('name')]);

        if($request->input('permissions')){
            $permissions = array_map('intval', $request->input('permissions'));
            $role->syncPermissions($permissions);
        }
    
        return redirect()->route('roles.index')->with('success','Role created successfully');
>>>>>>> f822cf6 (updation in the)
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['role'] = Role::find($id);
        $data['permissions'] = Permission::get();
        $data['rolePermissions'] = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
<<<<<<< HEAD
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

=======
                                    ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                                    ->all();
    
>>>>>>> f822cf6 (updation in the)
        return view('roles.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
<<<<<<< HEAD
            'name' => 'required',
            'permissions' => 'required|array|min:1'
        ]);

        $companyRoleName = user_company_id() . '#' . $request->input('name');
        $role = Role::find($id);
        $role->name = $companyRoleName;
        $role->save();

        if ($request->input('permissions')) {
            $permissions = array_map('intval', $request->input('permissions'));
            $role->syncPermissions($permissions);
        }

        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
=======
            'name' => 'required|alpha_space|unique:roles,name,' . $id,
        ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        if($request->input('permissions')){
            $permissions = array_map('intval', $request->input('permissions'));
            $role->syncPermissions($permissions);
        }
    
        return redirect()->route('roles.index')->with('success','Role updated successfully');
>>>>>>> f822cf6 (updation in the)
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Record deleted successfully.');
    }
}
