@extends('layout.app')
@section('title', 'Assign Task | TSP - Task Management System')
@section('pageTitle', 'Assign Task')
@section('breadcrumTitle', 'Create New Task')
@section('content')

<!-- Start Page Content here -->

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Enter Task Details</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('tasks.store') }}" method="POST" id="task_form" class="form-horizontal needs-validation" role="form" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group fill">
                                <label for="project_id">Project Name</label>
                                <select name="project_id" id="project_id" class="form-control">
                                    <option value="" selected>Please select project</option>
                                    @foreach ($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('project_id'))
                            <span class="help-block text-danger">
                                {{ $errors->first('project_id') }}
                            </span>
                            @endif
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group fill">
                                <label for="priority">Priority</label>
                                <select name="priority" id="priority" class="form-control">
                                    <option value="" selected>Select Task Priority</option>
                                    @foreach ($priority as $key => $val)
                                    <option value="{{ $key }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('priority'))
                            <span class="help-block text-danger">
                                {{ $errors->first('priority') }}
                            </span>
                            @endif
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group fill">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    @foreach ($status as $key => $val)
                                    <option value="{{ $key }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('status'))
                            <span class="help-block text-danger">
                                {{ $errors->first('status') }}
                            </span>
                            @endif
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group fill">
                                <label for="status">Assign To</label>
                                <select name="assign_to[]" id="assign_to" class="form-control">
                                    <option value="" selected>Please select one from blow</option>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('assign_to'))
                            <span class="help-block text-danger">
                                {{ $errors->first('assign_to') }}
                            </span>
                            @endif
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group fill">
                                <label for="start_date">Start Date</label>
                                <input type="date" class="form-control" name="start_date" id="start_date">
                            </div>
                            @if ($errors->has('start_date'))
                            <span class="help-block text-danger">
                                {{ $errors->first('start_date') }}
                            </span>
                            @endif
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group fill">
                                <label for="end_date">End Date</label>
                                <input type="date" class="form-control" name="end_date" id="end_date">
                            </div>
                            @if ($errors->has('end_date'))
                            <span class="help-block text-danger">
                                {{ $errors->first('end_date') }}
                            </span>
                            @endif
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group fill">
                                <label for="Task Title">Task Title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter Task Title" required>
                            </div>
                            @if ($errors->has('Task Title'))
                            <span class="help-block text-danger">
                                {{ $errors->first('Task Title') }}
                            </span>
                            @endif
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="description">Task Attachment</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="attachment" class="form-control" id="validatedCustomFile" required="">
                                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                                </div>
                            </div>
                            @if ($errors->has('Task Title'))
                            <span class="help-block text-danger">
                                {{ $errors->first('Task Title') }}
                            </span>
                            @endif
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="description">Task Description</label>
                                <textarea class="form-control" name="description" placeholder="Write description here" id="description" required rows="3"></textarea>
                            </div>
                            @if ($errors->has('description'))
                            <span class="help-block text-danger">
                                {{ $errors->first('description') }}
                            </span>
                            @endif
                        </div>

                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                    </div>
            </div>

            </form>
        </div>
    </div>
</div>
</div>


@endsection