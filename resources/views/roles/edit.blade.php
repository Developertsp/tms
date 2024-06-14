@extends('layout.app')
@section('title', 'Edit Role | TSP - Task Management System')
@section('pageTitle', 'Edit Role Details')
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
                                    <input name="name" type="text" class="form-control" id="name" placeholder="Enter Role Name" value="{{ $role->name }}" required>
                                    <div class="invalid-feedback">Example invalid feedback text</div>
                                </div>
                            </div>
                            @foreach ($permissions as $permission)
                                <div class="col-sm-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="permissions[]" class="form-check-input" value="{{ $permission->id }}" id="permission_{{$permission->id}}" {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="exampleCheck1">{{ $permission->name}}</label>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-sm-3">
                                <button type="submit" class="btn  btn-primary">Update</button>
                            </div>    
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection