@extends('layout.app')
@section('title', 'Departments List | TSP - Task Management System')
@section('pageTitle', 'Departments List')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="departments-datatable" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($departments as $department)
                            <tr>
                                <td>{{ $department->name }}</td>
                                <td>
                                    @can('update-departments')
                                        <a class="btn btn-primary" href="{{ route('departments.edit', $department->id) }}">Edit</a>
                                    @endcan
                                    @can('delete-departments')
                                        <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                                        </form>
                                    @endcan
                                </td>
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
        $('#departments-datatable').DataTable();
    </script>
@endsection