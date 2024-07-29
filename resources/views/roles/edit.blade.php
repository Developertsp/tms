@extends('layout.app')
@section('title', 'Edit Role | TSP - Task Management System')
@section('pageTitle', 'Edit Role Details')
<<<<<<< HEAD
@section('breadcrumTitle', 'Edit Role Details')

@section('content')
<!-- Start Page Content here -->

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Edit Detail</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('roles.update', $role->id) }}" method="post" class="needs-validation" novalidate>
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="floating-label" for="role">Role Name</label>
                                <input name="name" type="text" class="form-control" id="name" placeholder="Enter Role Name" value="{{filter_company_id($role->name) }}" required>
                                <div class="invalid-feedback">Example invalid feedback text</div>
                                @if ($errors->has('name'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('name') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        @foreach ($permissions as $permission)
                        <div class="col-sm-3">
                            <div class="form-group form-check"  >
                                <input type="checkbox" style="cursor: pointer;" name="permissions[]" class="form-check-input" value="{{ $permission->id }}" id="permission_{{$permission->id}}"  {{ in_array($permission->id, old('permissions', $rolePermissions)) ? 'checked' : '' }}>
                                <label class="form-check-label" style="cursor: pointer;"  for="permission_{{$permission->id}}">{{ $permission->name}}</label>
                            </div>
                        </div>
                        @endforeach

                        @if ($errors->has('permissions'))
                        <span class="help-block text-danger">
                            {{ $errors->first('permissions') }}
                        </span>
                        @endif
                        <div class="col-sm-3">
                            <button type="submit" class="btn  btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
=======

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('roles.update', $role->id) }}" method="post" class="needs-validation" novalidate>
                        @method('PATCH')
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Role Name</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="Enter Role Name" value="{{ $role->name }}" required>
                            <div class="invalid-feedback text-danger">
                                Role name is required.
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>

                        @foreach ($permissions as $permission)
                            <div class="mb-3">
                                <div class="form-check">
                                    <input name="permissions[]" class="form-check-input" type="checkbox" value="{{ $permission->id }}" id="permission_{{$permission->id}}" {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission_{{$permission->id}}">
                                        {{ $permission->name}}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                        
                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
>>>>>>> f822cf6 (updation in the)

@endsection