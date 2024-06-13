@extends('layout.app')
@section('title', 'Create Department | TSP - Task Management System')
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

@endsection