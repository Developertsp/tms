@extends('layout.app')
@section('title', 'Create Department | TSP - Task Management System')
<<<<<<< HEAD
@section('pageTitle', 'Departments')
@section('breadcrumTitle', 'Create Department')

@section('content')
<!-- Start Page Content here -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Enter Detail</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('departments.store') }}"  method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="floating-label" for="role">Department Name</label>
                                    <input name="name" type="text" class="form-control" id="name" placeholder="department name" value="{{ old('name') }}" required>
                                </div>
                                @if ($errors->has('name'))
                                    <span class="help-block text-danger">
                                        {{ $errors->first('name') }}
                                    </span>
                                @endif
                            </div>
                                                        
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="floating-label" for="role">Offcial Email</label>
                                    <input name="email" type="email" class="form-control" id="email" placeholder="departmental offcial email" value="{{ old('email') }}" required>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="help-block text-danger">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="floating-label" for="role">Total Members</label>
                                    <input name="members" type="number" class="form-control" id="members" placeholder="total members " value="{{ old('members') }}" required>
                                </div>
                                @if ($errors->has('members'))
                                    <span class="help-block text-danger">
                                        {{ $errors->first('members') }}
                                    </span>
                                @endif
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="floating-label" for="role">Short Description</label>
                                    <input name="description" type="text" class="form-control" id="description" placeholder="shortly describe department" value="{{ old('description') }}" required>
                                </div>
                                @if ($errors->has('description'))
                                    <span class="help-block text-danger">
                                        {{ $errors->first('description') }}
                                    </span>
                                @endif
                            </div>

                            <div class="col-sm-3">
                                <button type="submit" class="btn  btn-primary">Save</button>
                            </div>    
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
=======
@section('pageTitle', 'Add New Department')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('departments.store') }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Department Name</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="Enter Department Name" value="{{ old('name') }}" required>
                            <div class="invalid-feedback text-danger">
                                Department name is required.
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>
                        
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>

>>>>>>> f822cf6 (updation in the)
@endsection