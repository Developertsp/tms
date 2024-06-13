<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:view-users|create-users|update-users|delete-users', ['only' => ['index','store']]);
        $this->middleware('permission:create-users', ['only' => ['create','store']]);
        $this->middleware('permission:update-users', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-users', ['only' => ['destroy']]);
    }

    public function index()
    {
        $department_id = Auth::user()->department_id;
        $data['users'] = $department_id ? User::where('department_id', $department_id)->get() : User::get();
        return view('users.list', $data);
    }

    public function create()
    {
        $data['roles'] = Role::get();
        $data['departments'] = Department::where('is_enable', 1)->get();
        return view('users.create', $data);
    }

    public function store(Request $request)
    {
        // check for spatie role id instead of name
        $this->validate($request, [
            'name'          => 'required|alpha_space',
            'roles'         => 'required',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required',
            'profile_pic'   => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'joining_date'  => 'nullable|date_format:Y-m-d',
            'expiry_date'   => 'nullable|date_format:Y-m-d',
            // 'start_time'    => 'nullable|date_format:H:i',
            // 'end_time'      => 'nullable|date_format:H:i',
            'phone'         => 'nullable|numeric',
            'whatsapp'      => 'nullable|numeric',
        ]);

        if($request->hasFile('profile_pic')){
            $image = $request->file('profile_pic');
            $image_name = time() . '_' . uniqid('', true) . '.' . $image->getClientOriginalExtension();
            $org_name = $image->getClientOriginalName();
            $request->file('profile_pic')->storeAs('public/profile_pics/', $image_name);
        }

        $user = new User();
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->password     = Hash::make($request->password);
        $user->joining_date = $request->joining_date;
        $user->expiry_date  = $request->expiry_date;
        $user->start_time   = $request->start_time;
        $user->end_time     = $request->end_time;
        $user->phone        = $request->phone;
        $user->whatsapp     = $request->whatsapp;
        $user->created_by   = Auth::id();
        $user->department_id = $request->department ?? NULL;

        if($request->hasFile('profile_pic')){
            $user->profile_pic = $image_name;
        }

        $response = $user->save();
        $user->assignRole($request->roles);
    
        return redirect()->route('users.list')->with('success','User created successfully');
    }

    public function edit($id)
    {
        $data['user'] = User::find($id);
        $data['user_role'] = $data['user']->roles->pluck('name','name')->all();
        $data['roles'] = Role::get();
        $data['departments'] = Department::where('is_enable', 1)->get();
        return view('users.edit', $data);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required|alpha_space',
            'roles'         => 'required',
            'email'         => 'required|email|unique:users,email,'.$request->id,
            'profile_pic'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'joining_date'  => 'nullable|date_format:Y-m-d',
            'expiry_date'   => 'nullable|date_format:Y-m-d',
            // 'start_time'    => 'nullable|date_format:g:i A',
            // 'end_time'      => 'nullable|date_format:g:i A',
            'phone'         => 'nullable|numeric',
            'whatsapp'      => 'nullable|numeric',
        ]);
    
        if($request->hasFile('profile_pic')){
            $image = $request->file('profile_pic');
            $image_name = time() . '_' . uniqid('', true) . '.' . $image->getClientOriginalExtension();
            $request->file('profile_pic')->storeAs('public/profile_pics/', $image_name);
        }
        
        $post_data['name']         = $request->name;
        $post_data['email']        = $request->email;
        $post_data['joining_date'] = $request->joining_date;
        $post_data['expiry_date']  = $request->expiry_date;
        $post_data['start_time']   = $request->start_time;
        $post_data['end_time']     = $request->end_time;
        $post_data['phone']        = $request->phone;
        $post_data['whatsapp']     = $request->whatsapp;
        $post_data['updated_by']   = Auth::id();
        $post_data['department_id'] = $request->department ?? NULL;

        if($request->hasFile('profile_pic')){
            $post_data['profile_pic'] = $image_name;
        }


        if(!empty($request->password)){ 
            $post_data['password'] = Hash::make($request->password);
        }
    
        $user = User::find($request->id);
        $response = $user->update($post_data);

        DB::table('model_has_roles')->where('model_id',$request->id)->delete();
    
        $user->assignRole($request->roles);
    
        return redirect()->route('users.list')->with('success','User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Soft delete

        return redirect()->route('users.list')->with('success', 'Record deleted successfully.');
    }

    public function profile()
    {
        $data['user'] = Auth::user();
        return view('users.profile', $data);
    }

    public function profile_update(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required|alpha_space',
            'profile_pic'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'phone'         => 'nullable|numeric',
            'whatsapp'      => 'nullable|numeric',
        ]);
    
        if($request->hasFile('profile_pic')){
            $image = $request->file('profile_pic');
            $image_name = time() . '_' . uniqid('', true) . '.' . $image->getClientOriginalExtension();
            $request->file('profile_pic')->storeAs('public/profile_pics/', $image_name);
        }
        
        $user_id = Auth::id();

        $post_data['name']         = $request->name;
        $post_data['phone']        = $request->phone;
        $post_data['whatsapp']     = $request->whatsapp;
        $post_data['updated_by']   = $user_id;

        if($request->hasFile('profile_pic')){
            $post_data['profile_pic'] = $image_name;
        }


        if(!empty($request->password)){ 
            $post_data['password'] = Hash::make($request->password);
        }
    
        $user = User::find($user_id);
        $response = $user->update($post_data);
    
        return redirect()->route('users.profile')->with('success','User updated successfully');
    }
}
