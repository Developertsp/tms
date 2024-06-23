@extends('layout.app')
@section('title', 'Task List | TSP - Task Management System')
@section('pageTitle', 'Task List')
@section('breadcrumTitle', 'Task List')

@section('content')
<!-- Start Page Content here -->
<style>
    .btn-success {
        background-color: #00952e !important;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Task Management</h5>
            </div>
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group fill">
                                <label for="departmentFilter">Filter by Department:</label>
                                <select id="departmentFilter" class="form-control">
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                    <option value="{{ $department->name }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group fill">
                                <label for="userFilter">Filter by User:</label>
                                <select id="userFilter" class="form-control">
                                    <option value="">Select User</option>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->name }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group fill">
                                <label for="statusFilter">Filter by Status:</label>
                                <select id="statusFilter" class="form-control">
                                    <option value="">Select Status</option>
                                    @foreach ($task_status as $status)
                                    <option value="{{ $status }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group fill">
                                <label for="perfromanceFilter">Filter by Performance:</label>
                                <select id="perfromanceFilter" class="form-control">
                                    <option value="">Select Option</option>
                                    <option value="Deadline Missed">Deadline Missed</option>
                                    <option value="Deadline Acheived">Deadline Acheived</option>
                                    <option value="Performance N/D">Performance N/D</option>
                                    <option value="Deadline N/D">Deadline N/D</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <table class="table" id="tasksTable">
                        <thead>
                            <tr>
                                <th># Details</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Title</th>
                                <th>Assigned By</th>
                                <th>Assign To</th>
                                <th>Department</th>
                                <th>Project</th>
                                <th>Due Date</th>
                                <th>Performance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                            @php
                            $currentDate = \Carbon\Carbon::now()->startOfDay();
                            $endDate = isset($task->end_date) ? \Carbon\Carbon::parse($task->end_date)->startOfDay() : null;
                            $isDeadlinePassed = $endDate !== null && $endDate->lt($currentDate);

                            $isNotClosed = isset($task_status[$task->status]) && $task_status[$task->status] != 'Closed';
                            $daysRemaining = null;
                            if ($endDate !== null) {
                            $daysRemaining = $endDate->diffInDays($currentDate, false);
                            $daysRemaining = $endDate->lt($currentDate) ? -$daysRemaining : $daysRemaining;
                            $daysRemaining = $endDate->isPast() ? $daysRemaining : -$daysRemaining;
                            $daysLabel = ($daysRemaining >= 0) ? $daysRemaining . ' Remaining' : abs($daysRemaining) . ' Over';
                            }

                            if ($task_status[$task->status] == 'Closed') {
                            $label = 'Deadline Acheived';
                            } elseif ($isNotClosed && $isDeadlinePassed) {
                            $label = 'Deadline Missed';
                            } elseif ($isNotClosed && !$isDeadlinePassed) {
                            $label = 'Performance N/D';
                            }
                            @endphp
                            <tr class="{{ $isDeadlinePassed && $isNotClosed ? 'bg-danger' : '' }}">
                                <td>
                                    <a href="{{ route('tasks.show', base64_encode($task->id)) }}" class="fw-bold">
                                        #{{ $task->id }} <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('tasks.show', base64_encode($task->id)) }}" class="btn {{ (config('constants.PRIORITY_LIST')[$task->priority] == 'Medium') ? 'btn-warning' : ((config('constants.PRIORITY_LIST')[$task->priority] == 'High') ? 'btn-danger' : 'btn-secondary') }} rounded-pill py-0">
                                        {{ config('constants.PRIORITY_LIST')[$task->priority] ?? '' }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('tasks.show', base64_encode($task->id)) }}" class="btn {{ ($task_status[$task->status] == 'Assigned') ? 'btn-primary' : (($task_status[$task->status] == 'Closed') ? 'btn-success' : 'btn-secondary') }} rounded-pill py-0">
                                        {{ $task_status[$task->status] ?? '' }}
                                    </a>
                                </td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->creator->name }}</td>
                                <td>
                                    @foreach ($task->users as $user)
                                    <span>{{ $user->name }}</span>@if(!$loop->last), @endif
                                    @endforeach
                                </td>
                                <td>{{ $task->department->name }}</td>
                                <td>{{ $task->project->name }}</td>
                                <td>{{ $task->end_date ?? 'N/D' }}, Days({{$daysLabel ?? ''}})</td>
                                <td>{{ $label ?? 'Deadline N/D' }}</td>
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
    $(document).ready(function() {
        var table = $('#tasksTable').DataTable({
            "order": [
                [0, "desc"]
            ]
        });

        // Filter for task satus
        $('#statusFilter').on('change', function() {
            var selectedValue = $(this).val();
            table.column(2).search(selectedValue).draw();
        });

        // Filter for department
        $('#departmentFilter').on('change', function() {
            var selectedValue = $(this).val();
            table.column(5).search(selectedValue).draw();
        });

        // Filter for users
        $('#userFilter').on('change', function() {
            var selectedValue = $(this).val();
            table.column(4).search(selectedValue).draw();
        });


        // Filter for performance
        $('#perfromanceFilter').on('change', function() {
            var selectedValue = $(this).val();
            table.column(9).search(selectedValue).draw();
        });


    });
</script>
@endsection