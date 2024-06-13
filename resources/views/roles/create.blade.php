@extends('layout.app')
@section('title', 'Create Role | TSP - Task Management System')
@section('pageTitle', 'Add New Role')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('roles.store') }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Role Name</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="Enter Role Name" value="{{ old('name') }}" required>
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
                                    <input name="permissions[]" class="form-check-input" type="checkbox" value="{{ $permission->id }}" id="permission_{{$permission->id}}">
                                    <label class="form-check-label" for="permission_{{$permission->id}}">
                                        {{ $permission->name}}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                        
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>

@endsection