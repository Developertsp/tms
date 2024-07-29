<<<<<<< HEAD
<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        <a href="#!" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
            <img src="{{ asset('assets/theme2/images/logo.png') }}" alt="" class="logo">
            <img src="{{ asset('assets/theme2/images/logo-icon.png') }}" alt="" class="logo-thumb">
        </a>
        <a href="#!" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto d-none">
            <li class="nav-item">
                <a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
                <div class="search-bar">
                    <input type="text" class="form-control border-0 shadow-none" placeholder="Search hear">
                    <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                            class="icon feather icon-bell"></i></a>
                    <div class="dropdown-menu dropdown-menu-right notification">
                        <div class="noti-head">
                            <h6 class="d-inline-block m-b-0">Notifications</h6>
                            <div class="float-right">
                                <!-- <a href="#!" class="m-r-10">mark as read</a> -->
                                <a href="javascript:void(0);"
                                    class="text-decoration-underline read-all-notification">clear all</a>
                            </div>
                        </div>
                        <ul class="noti-body">
                            @php
                                use Carbon\Carbon;
                                $currentUser = Auth::user();
                                $newLabelDisplayed = false;
                                $earlierLabelDisplayed = false;
                            @endphp

                            @forelse($notifications as $notification)
                                @php
                                    $notificationTime = Carbon::parse($notification->created_at);
                                    $currentTime = Carbon::now();
                                    $timeDifference = $currentTime->diffInMinutes($notificationTime);

                                    $timePassed = '';
                                    if ($timeDifference < 60) {
                                        $timePassed = $timeDifference . ' min';
                                    } else {
                                        $hours = floor($timeDifference / 60);
                                        $minutes = $timeDifference % 60;
                                        $timePassed = $hours . ' hours ' . $minutes . ' min';
                                    }
                                $isNew = $timeDifference < 30; @endphp @if ($isNew && !$newLabelDisplayed)
                                    <li class="n-title">
                                        <p class="m-b-0">NEW</p>
                                    </li>
                                    @php $newLabelDisplayed = true; @endphp
                                @elseif(!$isNew && !$earlierLabelDisplayed)
                                    <li class="n-title">
                                        <p class="m-b-0">EARLIER</p>
                                    </li>
                                    @php $earlierLabelDisplayed = true; @endphp
                                @endif

                                <li class="notification">
                                    <a href="{{ route('notifications.read', base64_encode($notification->id)) }}">
                                        <div class="media">
                                            <img class="img-radius"
                                                src="{{ asset('storage/profile_pics/' . Auth()->User()->profile_pic) }}"
                                                alt="Generic placeholder image">
                                            <div class="media-body">
                                                <p><strong>{{ $notification->title }}</strong><span
                                                        class="n-time text-muted"><i
                                                            class="icon feather icon-clock m-r-10"></i>{{ $timePassed }}</span>
                                                </p>
                                                <p>{{ $notification->message ?? '' }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li class="notification">
                                    <div class="media">
                                        <div class="media-body">
                                            <p>No notifications found.</p>
                                        </div>
                                    </div>
                                </li>
                            @endforelse
                        </ul>

                        <div class="noti-footer">
                            <a href="{{ route('notifications.list') }}">show all</a>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="dropdown drp-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="feather icon-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            <img src="{{ asset('storage/profile_pics/' . Auth()->User()->profile_pic) }}" alt="Profile"
                                class="img-radius" alt="User-Profile-Image">
                            <span>{{ Auth()->User()->name }}</span>
                            <a href="{{ route('logout') }}" class="dud-logout" title="Logout"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="feather icon-log-out"></i>
                            </a>

                        </div>
                        <ul class="pro-body">
                            <!-- <li><a href="" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li> -->
                            <!-- <li><a href="email_inbox.html" class="dropdown-item"><i class="feather icon-mail"></i> My Messages</a></li> -->
                            <li><a href="{{ route('logout') }}" class="dropdown-item"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                        class="feather icon-lock"></i> Lock Screen</a></li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>
=======
<div class="navbar-custom">
    <div class="topbar">
        <div class="topbar-menu d-flex align-items-center gap-lg-2 gap-1">

            <!-- Brand Logo -->
            <div class="logo-box">
                <!-- Brand Logo Light -->
                <a href="/" class="logo-light">
                    <img src="{{ asset('assets/theme/images/logo-light.png')}}" alt="logo" class="logo-lg" height="22">
                    <img src="{{ asset('assets/theme/images/logo-sm.png')}}" alt="small logo" class="logo-sm" height="22">
                </a>

                <!-- Brand Logo Dark -->
                <a href="/" class="logo-dark">
                    <img src="{{ asset('assets/theme/images/logo-dark.png')}}" alt="dark logo" class="logo-lg" height="22">
                    <img src="{{ asset('assets/theme/images/logo-sm.png')}}" alt="small logo" class="logo-sm" height="22">
                </a>
            </div>

            <!-- Sidebar Menu Toggle Button -->
            <button class="button-toggle-menu">
                <i class="mdi mdi-menu"></i>
            </button>
        </div>

        <ul class="topbar-menu d-flex align-items-center gap-4">

            <li class="d-none d-md-inline-block">
                <a class="nav-link" href="" data-bs-toggle="fullscreen">
                    <i class="mdi mdi-fullscreen font-size-24"></i>
                </a>
            </li>

            <li class="dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="mdi mdi-magnify font-size-24"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-animated dropdown-menu-end dropdown-lg p-0">
                    <form class="p-3">
                        <input type="search" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                    </form>
                </div>
            </li>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="mdi mdi-bell font-size-24"></i>
                    <span class="badge bg-danger rounded-circle noti-icon-badge notification-count-badge">{{ $notifications->count()}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                    <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0 font-size-16 fw-semibold"> Notification</h6>
                            </div>
                            <div class="col-auto">
                                <a href="javascript:void(0);" class="text-dark text-decoration-underline read-all-notification">
                                    <small>Clear All</small>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="px-1 notify-content" style="max-height: 300px;" data-simplebar>
                        @foreach ($notifications as $notification)
                            <a href="{{ route('notifications.read', base64_encode($notification->id))}}" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                                <div class="card-body">
                                    {{-- <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span> --}}
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 text-truncate ms-2">
                                            <h5 class="noti-item-title fw-semibold font-size-14">{{ $notification->title}}</h5>
                                            <small class="noti-item-subtitle text-muted">{{ $notification->message }}</small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- All-->
                    <a href="{{ route('notifications.list') }}" class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
                        View All
                    </a>

                </div>
            </li>

            <li class="nav-link" id="theme-mode">
                <i class="bx bx-moon font-size-24"></i>
            </li>

            <li class="dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ Auth::user()->profile_pic ? asset('storage/profile_pics/'. Auth::user()->profile_pic )  : asset('storage/profile_pics/default.jpg')}}" alt="user-image" class="rounded-circle">
                    <span class="ms-1 d-none d-md-inline-block">
                        {{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="{{ route('users.profile') }}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>My Account</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </div>
            </li>

        </ul>
    </div>
</div>
>>>>>>> f822cf6 (updation in the)
