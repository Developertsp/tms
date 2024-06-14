@extends('layout.app')
@section('title', 'Create Department | TSP - Task Management System')
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
                                    <input name="name" type="text" class="form-control" id="name" placeholder="Enter Department Name" value="{{ old('name') }}" required>
                                </div>
                                @if ($errors->has('name'))
                                    <span class="help-block text-danger">
                                        {{ $errors->first('name') }}
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
@endsection