@extends('layout.app')
@section('title', 'Edit Role | TSP - Task Management System')
@section('pageTitle', 'Edit Role Details')

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

@endsection