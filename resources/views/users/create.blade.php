@extends('layout.app')
@section('title', 'Create User | TSP - Task Management System')
@section('pageTitle', 'Add New User')
@section('breadcrumTitle', 'Add New User')

@section('content')
<!-- Start Page Content here -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Enter Detail</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="post" id="user_form" class="form-horizontal needs-validation" role="form" novalidate enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Full Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="Type here full name..." required>
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-sm-3 col-form-label">Role</label>
                            <div class="col-sm-9">
                                <select name="roles" id="roles" class="mb-3 form-control" required>
                                    <option value="" selected>Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}" @if(old('roles')==$role->name) selected @endif>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('roles'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('roles') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="department" class="col-sm-3 col-form-label">Department</label>
                            <div class="col-sm-9">
                                <select name="department" id="department" class="form-control" required>
                                    <option value="" selected>Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" @if(old('department')==$department->id) selected @endif>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('roles'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('department') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="Email" required>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="profile" class="col-sm-3 col-form-label">Profile Picture</label>
                            <div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" name="profile_pic" id="profile_pic" class="custom-file-input" accept="image/*">
                                        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('profile_pic'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('profile_pic') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Joining Date</label>
                            <div class="col-sm-9">
                                <input type="date" name="joining_date" id="joining_date" value="{{ old('joining_date') }}" class="form-control">
                            </div>
                            @if ($errors->has('joining_date'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('joining_date') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Contract Expired</label>
                            <div class="col-sm-9">
                                <input type="date" name="expiry_date" id="expiry_date" value="{{ old('expiry_date') }}" class="form-control">
                            </div>
                            @if ($errors->has('expiry_date'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('expiry_date') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Start Time</label>
                            <div class="col-sm-9">
                                <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}" class="form-control">
                            </div>
                            @if ($errors->has('start_time'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('start_time') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">End Time</label>
                            <div class="col-sm-9">
                                <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}" class="form-control">
                            </div>
                            @if ($errors->has('end_time'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('end_time') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Phone Number</label>
                            <div class="col-sm-9">
                                <input type="number" name="phone" id="phone" value="{{ old('phone') }}" class="form-control">
                            </div>
                            @if ($errors->has('phone'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('phone') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Whatsapp</label>
                            <div class="col-sm-9">
                                <input type="number" name="whatsapp" id="whatsapp" value="{{ old('whatsapp') }}" class="form-control">
                            </div>
                            @if ($errors->has('whatsapp'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('whatsapp') }}
                                </span>
                            @endif
                        </div>


                        <div class="col-sm-3">
                            <button type="submit" class="btn  btn-primary">Save</button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection