@extends('layout.app')
@section('title', 'Task Detail | TSP - Task Management System')
@section('pageTitle', 'Task Detail')

@section('content')

<div class="row">
    
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
                        <div class="mb-3">
                            <label for="status" class="form-label">Status:</label>
                            <select class="form-select" name="status" id="status" aria-label="Task Status" required>
                                @foreach ($status as $key => $val)
                                    <option value="{{ $key }}" {{ $task->status == $key ? 'selected' : '' }} >{{ $val }}</option>
                                @endforeach
                            </select>
                        </div>
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


    <div class="col-lg-8">
        <div class="card card-body">
            <div>
                <h2 class="card-title "><u> Summary </u></h2>
                <h3 class="card-title">{{ $task->title }}</h3>
            </div>
            <div>
                <h2 class="card-title "><u> Description </u></h2>
                <p class="card-title">{{ $task->description }}</p>
            </div>
            <hr>
            <div class="col-md-12">
                <i class="fa fa-paperclip m-r-10 m-b-10"></i> Attachments
            </div>
            <div class="col-md-12 col-xs-12">
                <a data-toggle="modal" data-target="#ata_model" class="btn btn-primary btn-sm rounded-pill waves-effect waves-light">
                    <div data-bs-toggle="modal" data-bs-target="#attachments_modal">
                        <span class="btn-label task-span-margin-left-minus" ><i class="fa fa-plus"></i></span> <span class="" style=" text-transform: capitalize;">New Attachments </span>
                    </div>
                </a>
            </div>
            <hr>
            @foreach ($task->attachments as $attachment)
                <h6> <a href="{{ asset('storage/tasks_file/'.$attachment->path ) }}" target="_blank">{{ $attachment->file_name }}</a> <span class="float-end"><a href="{{ asset('storage/tasks_file/'.$attachment->path ) }}" download><i class="fas fa-download"></i></a></span></h6>
            @endforeach
            <hr>
            <h5>Comments</h5>
            <form action="{{ route('comments.store') }}" method="post" id="comment_form">
                @csrf
                <input type="hidden" name="task_id" id="task_id" value="{{ $task->id }}">
                <div class="mb-3">
                    <textarea class="form-control" name="comment" placeholder="Write description here" id="comment" style="height: 100px" required></textarea>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                </div>
            </form>
            <hr>
            @foreach ($task->comments as $comment)
                <div>
                    <h6>{{ $comment->user->name }} <span class="float-end">{{ $comment->formatted_created_at }}</span></h6>
                    <p>{{ $comment->comment }}</p>
                    <hr style="border-top: dashed 1px;" />
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card card-body">
            <button type="button" class="btn btn-primary rounded-pill waves-effect waves-light mt-2" data-bs-toggle="modal" data-bs-target="#logs_modal">Task Log</button>
            <p>
                <h4>Status <span class="badge badge-soft-success float-end"> {{ config('constants.STATUS_LIST')[$task->status] }}</span> <i class="bx bx-edit float-end" data-bs-toggle="modal" data-bs-target="#status_modal"></i></h4>
                <h4>Priority <span class="badge badge-soft-success float-end">{{ config('constants.PRIORITY_LIST')[$task->priority] }}</span></h4>
                <h4>Project <span class="float-end">{{ $task->project->name }}</span></h4>
                <h4>Created At <span class="float-end">{{ $task->formatted_created_at }}</span></h4>
                <h4>Created By <span class="float-end">{{ $task->creator->name }}</span></h4>
                <h4>Start Task <span class="float-end">{{ $task->formatted_start_date }}</span></h4>
                <h4>End Task <span class="float-end">{{ $task->end_date ? $task->formatted_end_date : '' }}</span></h4>
                <h4>Assign To </h4> 
                <span class="float-end">@foreach ($task->users as $user)
                    <span>{{ $user->name }}</span>@if(!$loop->last), @endif
                @endforeach</span>
            </p>
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