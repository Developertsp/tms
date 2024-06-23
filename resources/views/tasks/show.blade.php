@extends('layout.app')
@section('title', 'Task Detail | TSP - Task Management System')
@section('pageTitle', 'Task Details')
@section('breadcrumTitle', 'Task Details')

@section('content')

<div class="row">

    <div class="col-lg-8">
        <div class="card card-body">

            <div class="bg-secondary rounded py-2 mt-2 px-4 text-white">
                <h4 class=" fw-bold text-white"><u> Summary: </u></h4>
                <p class="card-title">{{ $task->title }}</p>
            </div>

            <div class="bg-secondary rounded py-2 mt-2 px-4 text-white">
                <h4 class=" fw-bold text-white"><u> Description: </u></h4>
                <p class="card-title">{{ $task->description }}</p>
            </div>

            <hr>
            <div class="col-md-12 bg-secondary rounded py-2 mt-2 px-4 text-white">
                <i class="fa fa-paperclip m-r-10 m-b-10"></i> Attachments
            </div>

            <div class="col-md-12 col-xs-12 rounded py-2 mt-1 px-4 text-white">
                <a data-toggle="modal" data-target="#attachments_modal" class=" px-4 btn btn-primary btn-sm rounded-pill waves-effect waves-light">
                    <div data-bs-toggle="modal" data-bs-target="#attachments_modal">
                        <span class="btn-label task-span-margin-left-minus "><i class="fa fa-plus"></i></span> <span class="" style=" text-transform: capitalize;">New Attachments </span>
                    </div>
                </a>
            </div>
            <hr>
            @foreach ($task->attachments as $attachment)
            <h6> <a href="{{ asset('storage/tasks_file/'.$attachment->path ) }}" target="_blank">{{ $attachment->file_name }} <i class="fas fa-eye"></i> </a> <span class="float-end"><a href="{{ asset('storage/tasks_file/'.$attachment->path ) }}" download><i class="fas fa-download"></i></a></span></h6>
            @endforeach
            <hr>
            <div class="col-md-12 bg-secondary rounded py-2 mt-2 px-4 text-white">
                <i class="fa fa-comment m-r-10 m-b-10"></i> Comments
            </div>
            <hr>
            @foreach ($task->comments as $comment)
            <div>
                <h6>{{ $comment->user->name }} <span class="float-end">{{ $comment->formatted_created_at }}</span></h6>
                <p>{{ $comment->comment }}</p>
                <hr style="border-top: dashed 1px;" />
            </div>
            @endforeach

            <form action="{{ route('comments.store') }}" method="post" id="comment_form">
                @csrf
                <input type="hidden" name="task_id" id="task_id" value="{{ $task->id }}">
                <div class="mb-3">
                    <textarea class="form-control" name="comment" placeholder="Write comment here" id="comment" required=""></textarea>
                </div>
                <div class="float-right">
                    <button type="submit" class="btn btn-primary w-md ">Submit</button>
                </div>
            </form>

        </div>
    </div>

    <div class="col-lg-4">
        <div class="card card-body pb-5">
            <button type="button" class="btn btn-primary rounded-pill waves-effect waves-light mt-2 py-1 fw-bold">
                <h6 class="text-white fw-bold mt-1">Tracking & Updation | <i class="fa fa-edit float-right mx-2 mt-1" style="cursor:pointer;" data-toggle="modal" data-target="#details_modal"></i> <i class="fas fa-eye float-right mx-1 mt-1" data-toggle="modal" data-target="#logs_modal"></i> </h6>
            </button>

            <div class="d-flex justify-content-between mt-4">
                <h5>Pro. Name:</h5>
                <h5><span class="badge badge-soft-success float-end"> {{ $task->project->name }} </span></h5>
            </div>

            <div class="d-flex justify-content-between">
                <h5>Task Status:</h5>
                <h5><span class="badge badge-soft-success float-end btn {{ (config('constants.STATUS_LIST')[$task->status] == 'Assigned') ? 'btn-primary' : ((config('constants.STATUS_LIST')[$task->status] == 'Closed') ? 'btn-success' : 'btn-secondary' ) }}  rounded-pill py-1 px-3"> {{ config('constants.STATUS_LIST')[$task->status] }}</span> </h5>
            </div>
            <div class="d-flex justify-content-between ">
                <h5>Task Priority:</h5>
                <h5><span class="badge badge-soft-success float-end btn {{ (config('constants.PRIORITY_LIST')[$task->priority] == 'Medium') ? 'btn-warning' : ((config('constants.PRIORITY_LIST')[$task->priority] == 'High') ? 'btn-danger' : 'btn-secondary' ) }}  rounded-pill py-1 px-4"> {{ config('constants.PRIORITY_LIST')[$task->priority] }}</span></h5>
            </div>
            <div class="d-flex justify-content-between ">
                <h5>Created At:</h5>
                <h5><span class="badge badge-soft-success float-end rounded-pill py-1 "> {{ $task->formatted_created_at }}</span> </h5>
            </div>
            <div class="d-flex justify-content-between ">
                <h5>Task Start:</h5>
                <h5><span class="badge badge-soft-success float-end rounded-pill py-1 "> {{ $task->formatted_start_date }}</span> </h5>
            </div>
            <div class="d-flex justify-content-between ">
                <h5>Task End:</h5>
                <h5><span class="badge badge-soft-success float-end rounded-pill py-1 "> {{ $task->end_date ? $task->formatted_end_date : '' }}</span> </h5>
            </div>
            <div class="d-flex justify-content-between ">
                <h5>Assigned By:</h5>
                <h5><span class="badge badge-soft-success float-end rounded-pill py-1 "> {{ $task->creator->name }}</span> </h5>
            </div>
            <h5>Assign To: </h5>
            <span class="float-end px-5">
                @foreach ($task->users as $ind => $user)
                <b>{{++$ind}}. </b><span>{{ $user->name }}</span>@if(!$loop->last), @endif
                @endforeach
            </span>

        </div>
    </div>
</div>

<!--  Modal for Logs -->
<div class="modal fade bd-example-modal-lg" id="logs_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">LOG History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                @foreach ($task->logs as $log)
                <p>Change status from {{ config('constants.STATUS_LIST')[$log->old_status] }} to {{ config('constants.STATUS_LIST')[$log->status] }} BY {{ $log->user->name}} <span class="float-end"> {{ $log->formatted_created_at}} </span></p>
                <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->

<!-- Modal for Attachments -->
<div class="modal fade" id="attachments_modal" tabindex="-1" role="dialog" aria-labelledby="status_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="status_modalLabel">Add Attachments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('attachments.store')}}" method="post" enctype="multipart/form-data" class="dropzone" id="file-dropzone">
                            @csrf
                            <input type="hidden" name="task_id" value="{{ $task->id }}">
                        </form>
                        <p>Maz file size is 2mb.</p>
                        <div class="modal-footer">
                            <button type="button" class="btn  btn-secondary rounded py-1" data-dismiss="modal">Close</button>
                            <button id="upload-button" class="btn btn-primary rounded py-1">Upload</button>
                        </div>
                    </div> <!-- end card-body-->
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
<!-- Modal for details Change -->
<div class="modal fade" id="details_modal" tabindex="-1" role="dialog" aria-labelledby="status_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="status_modalLabel">Update Task Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="task_status_from" action="{{ route('tasks.update') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">

                    <div class="row">

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group fill">
                                <label for="department_id">Department Name</label>
                                <select name="department_id" id="department_id" class="form-control">
                                    <option value="" selected>Please select department</option>
                                    @foreach ($departments as $deparment)
                                    <option value="{{ $deparment->id }}" {{ $deparment->id == $task->department_id ? 'selected' : '' }}>{{ $deparment->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('department_id'))
                            <span class="help-block text-danger">
                                {{ $errors->first('department_id') }}
                            </span>
                            @endif
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group fill">
                                <label for="project_id">Project Name</label>
                                <select name="project_id" id="project_id" class="form-control">
                                    <option value="" selected>Please select project</option>
                                    @foreach ($projects as $project)
                                    <option value="{{ $project->id }}" {{ $project->id == $task->project_id ? 'selected' : '' }}>{{ $project->name }}</option>
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
                                    @foreach ($task_preority as $key => $val)
                                    <option value="{{ $key }}" {{ $task->priority == $key  ? 'selected' : '' }}>{{ $val }}</option>
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
                                    @foreach ($task_status as $key => $val)
                                    <option value="{{ $key }}" {{ $task->status == $key ? 'selected' : '' }}>{{ $val }}</option>
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
                                    <option value="{{ $user->id }}" {{ (isset($assignedUsers[$user->id]) && $assignedUsers[$user->id] == $user->name)  ? 'selected' : '' }}>{{ $user->name }}</option>
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
                                <input type="date" min="{{ \Carbon\Carbon::now()->toDateString() }}" class="form-control" name="start_date" value="{{ old('start_date',$task->start_date ?? '')}}" id="start_date">
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
                                <input type="date" min="{{ \Carbon\Carbon::now()->toDateString() }}" class="form-control" name="end_date" value="{{ old('end_date',$task->end_date ?? '')}}" id="end_date">
                            </div>
                            @if ($errors->has('end_date'))
                            <span class="help-block text-danger">
                                {{ $errors->first('end_date') }}
                            </span>
                            @endif
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="description">Task Attachment</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="attachment" class="form-control" id="validatedCustomFile" >
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
                            <div class="form-group fill">
                                <label for="Task Title">Task Title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter Task Title" value="{{ old('title',$task->title ?? '')}}" required="">
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
                                <textarea class="form-control" name="description" placeholder="Write description here" id="description" required="" rows="3"> {{ old('description',$task->description ?? '')}}</textarea>
                            </div>
                            @if ($errors->has('description'))
                            <span class="help-block text-danger">
                                {{ $errors->first('description') }}
                            </span>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn  btn-secondary rounded py-1" data-dismiss="modal">Close</button>
                    <button type="submit" for="task_status_from" class="btn  btn-primary rounded py-1">Update Details</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section('script')
<script>
    Dropzone.options.fileDropzone = {
        autoProcessQueue: false,
        maxFilesize: 2, // MB
        parallelUploads: 10,
        addRemoveLinks: true,
        dictRemoveFile: 'Remove',
        init: function() {
            var submitButton = document.querySelector("#upload-button");
            var myDropzone = this;

            submitButton.addEventListener("click", function() {
                myDropzone.processQueue();
            });

            this.on("success", function(file, response) {
                console.log(response);
                // location.reload();
            });

            this.on("queuecomplete", function() {
                console.log("All files have been uploaded successfully.");
                setTimeout(function() {
                    location.reload();
                }, 1000); // Delay of 1 second
            });

            this.on("removedfile", function(file) {
                console.log('File removed:', file);
                // Handle file removal if necessary
            });
        }
    };
</script>
@endsection