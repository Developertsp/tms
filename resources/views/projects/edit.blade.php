@extends('layout.app')
@section('title', 'Edit Project | TSP - Task Management System')
@section('pageTitle', 'Edit Project Detail')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('projects.update') }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" name="id" value="{{ $project->id }}">
                        <div class="mb-3">
                            <label for="name" class="form-label">Project Name</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="Enter Project Name" value="{{ $project->name }}" required>
                            <div class="invalid-feedback text-danger">
                                Project name is required.
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>
                        
                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>

@endsection