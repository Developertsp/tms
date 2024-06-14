@extends('layout.app')
@section('title', 'Task List | TSP - Task Management System')
@section('pageTitle', 'Task List')
@section('breadcrumTitle', 'Task List')

@section('content')
<!-- Start Page Content here -->

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Task Management</h5>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Task ID</th>
                                    <th>Title</th>
                                    <th>Assign To</th>
                                    <th>Project</th>
                                    <th>Status</th>
                                    <th>Priority</th>
                                    <th>Created By</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td><a href="{{ route('tasks.show', base64_encode($task->id)) }}"> {{ $task->id }} </a></td>
                                        <td>{{ $task->title }}</td>
                                        <td>
                                            @foreach ($task->users as $user)
                                            <span>{{ $user->name }}</span>@if(!$loop->last), @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $task->project->name }}</td>
                                        <td>{{ config('constants.STATUS_LIST')[$task->status] }}</td>
                                        <td>{{ config('constants.PRIORITY_LIST')[$task->priority] }}</td>
                                        <td>{{ $task->creator->name }}</td>
                                        <td>{{ $task->formatted_created_at  }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script>
    $('#users-datatable').DataTable({
        "order": [
            [0, "desc"]
        ]
    });
</script>
@endsection