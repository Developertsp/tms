@extends('layout.app')
@section('title', 'Edit Role | TSP - Task Management System')
@section('pageTitle', 'Edit Role Details')

@section('content')
<!-- Start Page Content here -->

<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">System Roles</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Edit System Roles</a></li>
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
                    <h5>Edit Role</h5>
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
                            <div class="col-lg-12">
                                <form action="{{ route('roles.update', $role->id) }}" method="post" class="needs-validation" novalidate>
                                    @method('PATCH')
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Role Name</label>
                                        <input name="name" type="text" class="form-control" id="name" placeholder="Enter Role Name" value="{{ $role->name }}" required>
                                        <div class="invalid-feedback text-danger">
                                            Role name is required.
                                        </div>
                                        @if ($errors->has('name'))
                                        <span class="help-block text-danger">
                                            {{ $errors->first('name') }}
                                        </span>
                                        @endif
                                    </div>

                                    @foreach ($permissions as $permission)
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input name="permissions[]" class="form-check-input" type="checkbox" value="{{ $permission->id }}" id="permission_{{$permission->id}}" {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission_{{$permission->id}}">
                                                {{ $permission->name}}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach

                                    <button class="btn btn-primary" type="submit">Update</button>
                                </form>

                            </div>
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