@extends('layout.app')
@section('title', 'User Profile | TSP - Task Management System')
@section('pageTitle', 'User Profile')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    
                    <div class="row">
                        <h4 class="col-md-9 header-title">Edit User Profile </h4>
                        {{-- <img class="col-md-3" style="width: 100px; height: 100px" src="{{ asset('storage/profile_pics/default.jpg')}}" alt="user-image" class="rounded-circle"> --}}
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="p-2">
                                <form action="{{ route('users.profile_update') }}" method="post" id="user_profile_form" class="form-horizontal needs-validation" role="form" novalidate enctype="multipart/form-data">
                                    @csrf
                                    {{-- <input type="hidden" name="id" value="{{ $user->id }}"> --}}
                                    <div class="mb-2 row">
                                        <label class="col-md-2 col-form-label" for="name">Full Name</label>
                                        <div class="col-md-10">
                                            <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control" placeholder="Type here full name..." required>
                                            <div class="invalid-feedback text-danger">
                                                Name is required.
                                            </div>
                                            @if ($errors->has('name'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('name') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="mb-2 row">
                                        <label class="col-md-2 col-form-label" for="password">Password</label>
                                        <div class="col-md-10">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                        </div>
                                    </div>

                                    <div class="mb-2 row">
                                        <label class="col-md-2 col-form-label" for="profile_pic">Profile Picture</label>
                                        <div class="col-md-10">
                                            <input type="file" name="profile_pic" id="profile_pic" class="form-control" accept="image/*">
                                            @if ($errors->has('profile_pic'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('profile_pic') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-2 row">
                                        <label class="col-md-2 col-form-label" for="phone">Phone Number</label>
                                        <div class="col-md-10">
                                            <input type="number" name="phone" id="phone" value="{{ $user->phone ?? '' }}" class="form-control">
                                            @if ($errors->has('phone'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('phone') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-2 row">
                                        <label class="col-md-2 col-form-label" for="whatsapp">WhatsApp</label>
                                        <div class="col-md-10">
                                            <input type="number" name="whatsapp" id="whatsapp" value="{{ $user->whatsapp ?? '' }}" class="form-control">
                                            @if ($errors->has('whatsapp'))
                                                <span class="help-block text-danger">
                                                    {{ $errors->first('whatsapp') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>

                    </div>
                    <!-- end row -->
                </div>
            </div> <!-- end card -->
        </div><!-- end col -->
    </div>

@endsection