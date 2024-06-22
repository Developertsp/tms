@extends('layout.app')
@section('title', 'Dashboard | TSP - Task Management System')
@section('pageTitle', 'Dashboard')
@section('breadcrumTitle', 'User Dashboard')

@section('content')

<!-- Start Page Content here -->
<!-- [ Main Content ] start -->
<div class="row">
    <div class="col-lg-7 col-md-12">
        <!-- support-section start -->
        <div class="row">
            <div class="col-sm-6">
                <div class="card support-bar overflow-hidden">
                    <div class="card-body pb-0">
                        <h2 class="m-0">{{$todayTotalCount ?? 0 }}</h2>
                        <span class="text-c-blue">Today Tasks</span>
                        <p class="mb-3 mt-3">Today total number of tasks requests that come in.</p>
                    </div>
                    <div id="support-chart"></div>
                    <div class="card-footer bg-primary text-white">
                        <div class="row text-center">
                            <div class="col">
                                <h4 class="m-0 text-white">{{$todayAssignedCount ?? 0 }}</h4>
                                <span>Open</span>
                            </div>
                            <div class="col">
                                <h4 class="m-0 text-white">{{$todayWorkStartedCount ?? 0 }}</h4>
                                <span>Running</span>
                            </div>
                            <div class="col">
                                <h4 class="m-0 text-white">{{$todayClosedCount ?? 0 }}</h4>
                                <span>Done</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card support-bar overflow-hidden">
                    <div class="card-body pb-0">
                        <h2 class="m-0">{{$totalCount ?? 0 }}</h2>
                        <span class="text-c-green">Total Tasks</span>
                        <p class="mb-3 mt-3">Total number of tasks requests that come in.</p>
                    </div>
                    <div id="support-chart1"></div>
                    <div class="card-footer bg-success text-white">
                        <div class="row text-center">
                            <div class="col">
                                <h4 class="m-0 text-white">{{$assignedCount ?? 0 }}</h4>
                                <span>Open</span>
                            </div>
                            <div class="col">
                                <h4 class="m-0 text-white">{{$workStartedCount ?? 0 }}</h4>
                                <span>Running</span>
                            </div>
                            <div class="col">
                                <h4 class="m-0 text-white">{{$closedCount ?? 0 }}</h4>
                                <span>Done</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- support-section end -->
    </div>
    <div class="col-lg-5 col-md-12">
        <!-- page statustic card start -->
        <div class="row">
            @if(system_role())
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-yellow">$30200</h4>
                                <h6 class="text-muted m-b-0">Earning</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="feather icon-bar-chart-2 f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-yellow">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <p class="text-white m-b-0">% change</p>
                            </div>
                            <div class="col-3 text-right">
                                <i class="feather icon-trending-up text-white f-16"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-red">$6702</h4>
                                <h6 class="text-muted m-b-0">Pendding</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="feather icon-calendar f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-red">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <p class="text-white m-b-0">0 % change</p>
                            </div>
                            <div class="col-3 text-right">
                                <i class="feather icon-trending-down text-white f-16"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-green">{{$companies ?? 0 }} +</h4>
                                <h6 class="text-muted m-b-0">Companies</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="feather icon-file-text f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-green">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <p class="text-white m-b-0">% change</p>
                            </div>
                            <div class="col-3 text-right">
                                <i class="feather icon-trending-up text-white f-16"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-blue">{{$users ?? 0 }} +</h4>
                                <h6 class="text-muted m-b-0"> Users</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="feather icon-bar-chart-2 f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-blue">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <p class="text-white m-b-0">% change</p>
                            </div>
                            <div class="col-3 text-right">
                                <i class="feather icon-trending-down text-white f-16"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(!system_role())

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-yellow">{{$departments ?? 0 }}</h4>
                                <h6 class="text-muted m-b-0">Deparments</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="feather icon-calendar f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-yellow">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <p class="text-white m-b-0">% change</p>
                            </div>
                            <div class="col-3 text-right">
                                <i class="feather icon-trending-up text-white f-16"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-green">{{$total_projects ?? 0 }} +</h4>
                                <h6 class="text-muted m-b-0">Projects</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="feather icon-bar-chart f-28"></i>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-c-green">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <p class="text-white m-b-0">% change</p>
                            </div>
                            <div class="col-3 text-right">
                                <i class="feather icon-trending-up text-white f-16"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-red">{{$assignedCount ?? 0 }}</h4>
                                <h6 class="text-muted m-b-0">Queue Task</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="feather icon-thumbs-down f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-red">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <p class="text-white m-b-0">% change</p>
                            </div>
                            <div class="col-3 text-right">
                                <i class="feather icon-trending-down text-white f-16"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <!-- page statustic card end -->
    </div>

    <!-- prject ,team member start -->
    <div class="col-xl-8 col-md-12">
        <div class="card latest-update-card">
            <div class="card-header">
                <h5>Latest Updates</h5>
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
                <div class="latest-update-box">
                    <div class="row p-t-30 p-b-30">
                        <div class="col-auto text-right update-meta">
                            <p class="text-muted m-b-0 d-inline-flex">2 hrs ago</p>
                            <i class="feather icon-twitter bg-twitter update-icon"></i>
                        </div>
                        <div class="col">
                            <a href="#!">
                                <h6>+ 1652 Followers</h6>
                            </a>
                            <p class="text-muted m-b-0">You’re getting more and more followers, keep it up!</p>
                        </div>
                    </div>
                    <div class="row p-b-30">
                        <div class="col-auto text-right update-meta">
                            <p class="text-muted m-b-0 d-inline-flex">4 hrs ago</p>
                            <i class="feather icon-briefcase bg-c-red update-icon"></i>
                        </div>
                        <div class="col">
                            <a href="#!">
                                <h6>+ 5 New Products were added!</h6>
                            </a>
                            <p class="text-muted m-b-0">Congratulations!</p>
                        </div>
                    </div>
                    <div class="row p-b-0">
                        <div class="col-auto text-right update-meta">
                            <p class="text-muted m-b-0 d-inline-flex">2 day ago</p>
                            <i class="feather icon-facebook bg-facebook update-icon"></i>
                        </div>
                        <div class="col">
                            <a href="#!">
                                <h6>+1 Friend Requests</h6>
                            </a>
                            <p class="text-muted m-b-10">This is great, keep it up!</p>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tr>
                                        <td class="b-none">
                                            <a href="#!" class="align-middle">
                                                <img src="assets/images/user/avatar-2.jpg" alt="user image" class="img-radius wid-40 align-top m-r-15">
                                                <div class="d-inline-block">
                                                    <h6>Jeny William</h6>
                                                    <p class="text-muted m-b-0">Graphic Designer</p>
                                                </div>
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="card chat-card">
            <div class="card-header">
                <h5>Chat</h5>
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
                <div class="row m-b-20 received-chat">
                    <div class="col-auto p-r-0">
                        <img src="assets/images/user/avatar-2.jpg" alt="user image" class="img-radius wid-40">
                    </div>
                    <div class="col">
                        <div class="msg">
                            <p class="m-b-0">Nice to meet you!</p>
                        </div>
                        <p class="text-muted m-b-0"><i class="fa fa-clock-o m-r-10"></i>10:20am</p>
                    </div>
                </div>
                <div class="row m-b-20 send-chat">
                    <div class="col">
                        <div class="msg">
                            <p class="m-b-0">Nice to meet you!</p>
                        </div>
                        <p class="text-muted m-b-0"><i class="fa fa-clock-o m-r-10"></i>10:20am</p>
                    </div>
                    <div class="col-auto p-l-0">
                        <img src="assets/images/user/avatar-3.jpg" alt="user image" class="img-radius wid-40">
                    </div>
                </div>
                <div class="row m-b-20 received-chat">
                    <div class="col-auto p-r-0">
                        <img src="assets/images/user/avatar-2.jpg" alt="user image" class="img-radius wid-40">
                    </div>
                    <div class="col">
                        <div class="msg">
                            <p class="m-b-0">Nice to meet you!</p>
                            <img src="assets/images/widget/dashborad-1.jpg" alt="">
                            <img src="assets/images/widget/dashborad-3.jpg" alt="">
                        </div>
                        <p class="text-muted m-b-0"><i class="fa fa-clock-o m-r-10"></i>10:20am</p>
                    </div>
                </div>
                <div class="form-group m-t-15">
                    <label class="floating-label" for="Project">Send message</label>
                    <input type="text" name="task-insert" class="form-control" id="Project">
                    <div class="form-icon">
                        <button class="btn btn-primary btn-icon">
                            <i class="feather icon-message-circle"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- prject ,team member start -->
    @if(!system_role())
    <!-- Latest Projects start -->
    <div class="col-xl-8 col-md-12">
        <div class="card table-card">
            <div class="card-header">
                <h5>Latest Projects</h5>
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
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Due Date</th>
                                <th class="text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $key => $project)
                            <tr>
                                <td>{{$project->name ?? '' }}</td>
                                <td>{{$project->deadline ?? '' }}</td>
                                <td class="text-right"><label class="badge badge-light-danger">{{ $proj_status[$project->status] ?? '' }}</label></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="text-center mb-3">
                    <a href="{{route('projects.list')}}" class="b-b-primary text-primary">View all Projects</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-12">
        <div class="card user-card2">
            <div class="card-body text-center">
                <h6 class="m-b-15">Project Risk</h6>
                <div class="risk-rate">
                    <span><b>5</b></span>
                </div>
                <h6 class="m-b-10 m-t-10">Balanced</h6>
                <a href="#!" class="text-c-green b-b-success">Change Your Risk</a>
                <div class="row justify-content-center m-t-10 b-t-default m-l-0 m-r-0">
                    <div class="col m-t-15 b-r-default">
                        <h6 class="text-muted">Nr</h6>
                        <h6>AWS 2455</h6>
                    </div>
                    <div class="col m-t-15">
                        <h6 class="text-muted">Created</h6>
                        <h6>30th Sep</h6>
                    </div>
                </div>
            </div>
            <button class="btn btn-success btn-block">Download Overall Report</button>
        </div>
    </div>
    <!-- Latest Projects end -->
    @endif
</div>
<!-- [ Main Content ] end -->
</div>

@endsection