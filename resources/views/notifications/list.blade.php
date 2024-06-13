@extends('layout.app')
@section('title', 'Notifications List | TSP - Task Management System')
@section('pageTitle', 'Notifications List')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="notifications-datatable" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Detail</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($notifications as $notification)
                            <tr>
                                <td><a href="{{ route('tasks.show', base64_encode($notification->task_id)) }}"> {{ $notification->message }} </a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

@endsection

@section('script')
    <script>
        $('#notifications-datatable').DataTable();
    </script>
@endsection