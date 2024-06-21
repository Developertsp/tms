@extends('layout.app')
@section('title', 'Project Detail | TSP - Task Management System')
@section('pageTitle', 'Project Detail')

@section('content')

<div class="row">
    
    <!-- Modal for Attachments -->
    <div id="attachments_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="attachmentsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLiveLabel">Add Attachments</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('projects.attachments.store')}}" method="post" enctype="multipart/form-data" class="dropzone" id="file-dropzone">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                    </form>
                    <p>Maz file size is 2mb.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                    <button id="upload-button" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-12">
        <div class="card card-body">
            <div>
                <h2 class="card-title "><u> Project Name </u></h2>
                <h3 class="card-title">{{ $project->name }}</h3>
            </div>

            <div>
                <h2 class="card-title "><u> Overview </u></h2>
                <p class="card-title">{{ $project->description }}</p>
            </div>

            <div>
                <h2 class="card-title "><u> Plan </u></h2>
                <p class="card-title">{{ $project->plan }}</p>
            </div>

            <div>
                <h2 class="card-title "><u> Refrence URLs </u></h2>
                @foreach ($ref_url as $url)
                    <p class="card-title"><a href="{{$url}}" target="_blank">{{ $url }}</a></p>
                @endforeach
            </div>

            <div>
                <h2 class="card-title "><u> Deadline </u></h2>
                <p class="card-title">{{ $project->deadline }}</p>
            </div>

            <hr>
            <div class="col-md-12">
                <i class="fa fa-paperclip m-r-10 m-b-10"></i> Attachments
            </div>
            <div class="col-md-12 col-xs-12">
                <a data-toggle="modal" data-target="#attachments_modal" class="btn btn-primary btn-sm rounded-pill waves-effect waves-light">
                    <div data-bs-toggle="modal" data-bs-target="#attachments_modal">
                        <span class="btn-label task-span-margin-left-minus" ><i class="fa fa-plus"></i></span> <span class="" style=" text-transform: capitalize;">New Attachments </span>
                    </div>
                </a>
            </div>
            <hr>
            @foreach ($project->attachments as $attachment)
                <h6> <a href="{{ asset('storage/projects_file/'.$attachment->path ) }}" target="_blank">{{ $attachment->file_name }}</a> <span class="float-end"><a href="{{ asset('storage/tasks_file/'.$attachment->path ) }}" download><i class="fas fa-download"></i></a></span></h6>
            @endforeach
            <hr>
            <h5>Comments</h5>
            <form action="{{ route('projects.comments.store') }}" method="post" id="comment_form">
                @csrf
                <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}">
                <div class="mb-3">
                    <textarea class="form-control" name="comment" placeholder="Write description here" id="comment" style="height: 100px" required></textarea>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                </div>
            </form>
            <hr>
            @foreach ($project->comments as $comment)
                <div>
                    <h6>{{ $comment->user->name }} <span class="float-end">{{ $comment->formatted_created_at }}</span></h6>
                    <p>{{ $comment->comment }}</p>
                    <hr style="border-top: dashed 1px;" />
                </div>
            @endforeach
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