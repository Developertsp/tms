@extends('layout.app')
@section('title', 'Create Role | TSP - Task Management System')
@section('pageTitle', 'Add New Role')
@section('breadcrumTitle', 'Add New Role')

@section('content')
<!-- Start Page Content here -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Enter Detail</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.store') }}"  method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="floating-label" for="role">Role Name</label>
                                    <input name="name" type="text" class="form-control" id="name" placeholder="Enter Role Name" value="{{ old('name') }}" required>
                                    <div class="invalid-feedback">Example invalid feedback text</div>
                                </div>
                            </div>
                            @foreach ($permissions as $permission)
                                <div class="col-sm-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="permissions[]" class="form-check-input" value="{{ $permission->id }}" id="permission_{{$permission->id}}">
                                        <label class="form-check-label" for="exampleCheck1">{{ $permission->name}}</label>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-sm-3">
                                <button type="submit" class="btn  btn-primary">Save</button>
                            </div>    
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection