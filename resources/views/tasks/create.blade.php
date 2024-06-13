@extends('layout.app')
@section('title', 'Assign Task | TSP - Task Management System')
@section('pageTitle', 'Assign Task')

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="header-title">Floating labels</h5>
                    <p class="sub-header">Create beautifully simple form labels that float over your input fields.</p>

                    <form action="{{ route('tasks.store') }}" method="POST" id="task_form" class="form-horizontal needs-validation" role="form" novalidate enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="project_id" id="project_id" aria-label="Project Name" required>
                                        <option value="" selected>Please select project</option>
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="project_id">Project Name</label>
                                </div>
                            </div>    
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="priority" id="priority" aria-label="Task Priority" required>
                                        <option value="" selected>Select Task Priority</option>
                                        @foreach ($priority as $key => $val)
                                            <option value="{{ $key }}">{{ $val }}</option>
                                        @endforeach
                                    </select>
                                    <label for="priority">Priority</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="status" id="status" aria-label="Task Status" required>
                                        @foreach ($status as $key => $val)
                                            <option value="{{ $key }}">{{ $val }}</option>
                                        @endforeach
                                    </select>
                                    <label for="status">Status</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="assign_to[]" id="assign_to" aria-label="Assign To">
                                        <option value="" selected>Please select one from blow</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="assign_to">Assign To</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" name="start_date" id="start_date">
                                    <label for="start_date">Start Date</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" name="end_date" id="end_date">
                                    <label for="end_date">End Date</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter Task Title" required>
                                    <label for="title">Task Title</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-floating mb-2">
                                <textarea class="form-control" name="description" placeholder="Write description here" id="description" style="height: 100px" required></textarea>
                                <label for="description">Task Description</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class=" mb-2">
                                <input type="file" name="attachment" class="form-control" id="attachment">
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

@endsection