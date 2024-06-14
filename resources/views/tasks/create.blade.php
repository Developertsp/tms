@extends('layout.app')
@section('title', 'Assign Task | TSP - Task Management System')
@section('pageTitle', 'Assign Task')

@section('content')
<!-- Start Page Content here -->

<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Tasks Management</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Create new Task</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">

        <!-- Latest Customers start -->
        <div class="col-lg-12">
            <div class="card table-card review-card">
                <div class="card-header borderless ">
                    <h5>Create new Task</h5>
                    <div class="card-header-right">
                        <div class="btn-group card-option">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="feather icon-more-horizontal"></i>
                            </button>
                            <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="review-block">


                        <div class="row">
                            <div class="col-xl-12">
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
                            <!-- end col -->
                        </div>
                    </div>
                    <div class="text-right  m-r-20">
                        <a href="#!" class="b-b-primary text-primary">View all Customer Reviews</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Customers end -->
    </div>
    <!-- [ Main Content ] end -->
</div>



@endsection