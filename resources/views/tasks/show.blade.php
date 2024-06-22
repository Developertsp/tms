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
                    <textarea class="form-control" name="comment" placeholder="Write comment here" id="comment" required></textarea>
                </div>
                <div class="float-right">
                    <button type="submit" class="btn btn-primary w-md ">Submit</button>
                </div>
            </form>

        </div>
    </div>

    <div class="col-lg-4">
        <div class="card card-body pb-5">
            <button type="button" class="btn btn-primary rounded-pill waves-effect waves-light mt-2 py-1 fw-bold" data-toggle="modal" data-target="#logs_modal"> <span class="text-white"><i class="fas fa-eye"></i> </span>  Task Log</button>
            <div class="d-flex justify-content-between mt-4">
                <h5>Name:</h5>
                <h5><span class="badge badge-soft-success float-end"> {{ $task->project->name }} </span></h5>
            </div>

            <div class="d-flex justify-content-between">
                <h5>Status:</h5>
                <h5><span class="badge badge-soft-success float-end btn {{ (config('constants.STATUS_LIST')[$task->status] == 'Assigned') ? 'btn-primary' : ((config('constants.STATUS_LIST')[$task->status] == 'Closed') ? 'btn-success' : 'btn-secondary' ) }}  rounded-pill py-1 px-2"> {{ config('constants.STATUS_LIST')[$task->status] }}</span> <i class="fa fa-edit float-end" style="cursor:pointer;" data-toggle="modal" data-target="#status_modal"></i></h5>
            </div>
            <div class="d-flex justify-content-between ">
                <h5>Priority:</h5>
                <h5><span class="badge badge-soft-success float-end btn {{ (config('constants.PRIORITY_LIST')[$task->priority] == 'Medium') ? 'btn-warning' : ((config('constants.PRIORITY_LIST')[$task->priority] == 'High') ? 'btn-danger' : 'btn-secondary' ) }}  rounded-pill py-1 px-4"> {{ config('constants.PRIORITY_LIST')[$task->priority] }}</span></h5>
            </div>
            <div class="d-flex justify-content-between ">
                <h5>Created At:</h5>
                <h5><span class="badge badge-soft-success float-end rounded-pill py-1 "> {{ $task->formatted_created_at }}</span> </h5>
            </div>
            <div class="d-flex justify-content-between ">
                <h5>Created By:</h5>
                <h5><span class="badge badge-soft-success float-end rounded-pill py-1 "> {{ $task->creator->name }}</span> </h5>
            </div>
            <div class="d-flex justify-content-between ">
                <h5>Start Task:</h5>
                <h5><span class="badge badge-soft-success float-end rounded-pill py-1 "> {{ $task->formatted_start_date }}</span> </h5>
            </div>
            <div class="d-flex justify-content-between ">
                <h5>End Task:</h5>
                <h5><span class="badge badge-soft-success float-end rounded-pill py-1 "> {{ $task->end_date ? $task->formatted_end_date : '' }}</span> </h5>
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
<div class="modal fade" id="logs_modal" tabindex="-1" role="dialog" aria-labelledby="logsModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logsModal">Log History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @foreach ($task->logs as $log)
                <p>Change status from {{ config('constants.STATUS_LIST')[$log->old_status] }} to {{ config('constants.STATUS_LIST')[$log->status] }} BY {{ $log->user->name}} <span class="float-end"> {{ $log->formatted_created_at}} </span></p>
                <hr>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal for Status Change -->
<div id="status_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="status-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="status-modalLabel">Status</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="px-3" action="{{ route('tasks.update') }}" method="post">
                @csrf
                <input type="hidden" name="task_id" value="{{ $task->id }}">
                <div class="modal-body">
                    <div class="form-group fill mb-3">
                        <label style="cursor:pointer;" for="status">Change Status: </label>
                        <select style="cursor:pointer;" class="form-control" name="status" id="status" required>
                            <option value="" selected> Select task Status</option>
                            @foreach ($status as $key => $val)
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal for Attachments -->
<div id="attachments_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="attachmentsModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="attachmentsModal">Add Attachments</h4>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('attachments.store')}}" method="post" enctype="multipart/form-data" class="dropzone" id="file-dropzone">
                        @csrf
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                    </form>
                    <p>Maz file size is 2mb.</p>
                    <div class="modal-footer">
                        <button id="upload-button" class="btn btn-primary">Upload</button>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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