@extends('layout.app')
@section('title', 'Edit Project | TSP - Task Management System')
@section('pageTitle', 'Edit Project Detail')

@section('content')

<!-- Start Page Content here -->

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Enter Detail</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('projects.update') }}" method="post" class="form-horizontal needs-validation" role="form" novalidate enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $project->id }}">
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Project Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" id="name" value="{{ $project->name }}" class="form-control" placeholder="Enter Project Name" required>
                        </div>
                        @if ($errors->has('name'))
                        <span class="help-block text-danger">
                            {{ $errors->first('name') }}
                        </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Project Overview</label>
                        <div class="col-sm-9">
                            <input type="text" name="description" id="description" value="{{ $project->description }}" class="form-control" placeholder="Enter description" required>
                        </div>
                        @if ($errors->has('description'))
                        <span class="help-block text-danger">
                            {{ $errors->first('description') }}
                        </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Project Plan</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="project_plan" id="project_plan" rows="5" valu>{{ $project->plan }}</textarea>
                        </div>
                        @if ($errors->has('description'))
                        <span class="help-block text-danger">
                            {{ $errors->first('description') }}
                        </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Refrence URL</label>
                        <div class="col-sm-9">
                            <input type="text" name="ref_url" id="ref_url" value="{{ $project->ref_url }}" class="form-control" placeholder="Enter description">
                        </div>
                        @if ($errors->has('ref_url'))
                        <span class="help-block text-danger">
                            {{ $errors->first('ref_url') }}
                        </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Deadline</label>
                        <div class="col-sm-9">
                            <input type="date" name="deadline" id="deadline" value="{{ $project->deadline ? \Carbon\Carbon::parse($project->deadline)->format('Y-m-d') : '' }}" class="form-control">
                        </div>
                        @if ($errors->has('deadline'))
                        <span class="help-block text-danger">
                            {{ $errors->first('deadline') }}
                        </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label for="profile" class="col-sm-3 col-form-label">Attachments</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" name="project_files[]" id="project_files" class="custom-file-input" multiple> 
                                    <label class="custom-file-label" for="project_files">Choose file</label>
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('project_files'))
                        <span class="help-block text-danger">
                            {{ $errors->first('project_files') }}
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