<<<<<<< HEAD
<nav class="pcoded-navbar menu-light ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div ">

            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="{{ asset('storage/profile_pics/'.Auth()->User()->profile_pic) }}" alt="Profile">
                    <div class="user-details">
                        <div id="more-details">{{filter_company_id(Auth()->User()->roles->toArray()[0]['name']) ?? 'Guest'}} <i class="fa fa-caret-down"></i></div>
                    </div>

                </div>
                <div class="collapse" id="nav-user-link d-none">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a href="#!"><i class="feather icon-user m-r-5"></i>View Profile</a></li>
                        <li class="list-group-item"><a href="#!"><i class="feather icon-settings m-r-5"></i>Settings</a></li>

                        <li class="list-group-item">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="feather icon-log-out m-r-5"></i>Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>

                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link "><span class="pcoded-micon"><i class="fa fa-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>

                @can('view-roles')
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fa fa-user-tag"></i></span><span class="pcoded-mtext">Roles</span></a>
                    <ul class="pcoded-submenu">
                        @can('create-roles')
                        <li><a href="{{ route('roles.create') }}">Add New</a></li>
                        @endcan
                        <li><a href="{{ route('roles.index') }}">List</a></li>
                    </ul>
                </li>
                @endcan

                @can('view-users')
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fa fa-users"></i></span><span class="pcoded-mtext">Users</span></a>
                    <ul class="pcoded-submenu">
                        @can('create-users')
                        <li><a href="{{ route('users.create') }}">Add New</a></li>
                        @endcan
                        <li><a href="{{ route('users.list') }}">List</a></li>
                    </ul>
                </li>
                @endcan

                @can('view-companies')
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fa fa-user-tag"></i></span><span class="pcoded-mtext">Companies</span></a>
                    <ul class="pcoded-submenu">
                        @can('create-companies')
                        <li><a href="{{ route('companies.create') }}">Add New</a></li>
                        @endcan
                        <li><a href="{{ route('companies.list') }}">List</a></li>
                    </ul>
                </li>
                @endcan

                @can('view-jd-tasks')
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fa fa-folder"></i></span><span class="pcoded-mtext">JD Tasks</span></a>
                        <ul class="pcoded-submenu">
                            @can('create-jd-tasks')
                                <li><a href="{{ route('jd.create') }}">Add New</a></li>
                            @endcan
                            <li><a href="{{ route('jd.list') }}">List</a></li>
                        </ul>
                    </li>
                   
                @endcan

                @can('view-departments')
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fa fa-building"></i></span><span class="pcoded-mtext">Departments</span></a>
                    <ul class="pcoded-submenu">
                        @can('create-departments')
                        <li><a href="{{ route('departments.create') }}">Add New</a></li>
                        @endcan
                        <li><a href="{{ route('departments.list') }}">List</a></li>
                    </ul>
                </li>
                @endcan

                @can('view-projects')
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fa fa-folder"></i></span><span class="pcoded-mtext">Projects</span></a>
                    <ul class="pcoded-submenu">
                        @can('create-projects')
                        <li><a href="{{ route('projects.create') }}">Add New</a></li>
                        @endcan
                        <li><a href="{{ route('projects.list') }}">List</a></li>
                    </ul>
                </li>
                @endcan

                @can('view-tasks')
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fa fa-tasks"></i></span><span class="pcoded-mtext">Tasks</span></a>
                    <ul class="pcoded-submenu">
                        @can('create-tasks')
                        <li><a href="{{ route('tasks.create') }}">Add New</a></li>
                        @endcan
                        <li><a href="{{ route('tasks.list') }}">List</a></li>
                        <li><a href="{{ route('tasks.report') }}">Reports</a></li>
                    </ul>
                </li>
                @endcan

                <li class="nav-item pcoded-menu-caption ">
                    <label>Settings</label>
                </li>
                
                <li class="nav-item pcoded-hasmenu ">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-bell"></i></span><span class="pcoded-mtext">Notifications</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ route('notifications.list') }}">All Notification</a></li>
                        <!-- <li><a href="#">Porile Setting</a></li> -->
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
=======
<div class="main-menu">
    <!-- Brand Logo -->
    <div class="logo-box">
        <!-- Brand Logo Light -->
        <a href="/" class="logo-light">
            <img src="{{ asset('assets/theme/images/logo-light.png')}}" alt="logo" class="logo-lg" height="28">
            <img src="{{ asset('assets/theme/images/logo-sm.png')}}" alt="small logo" class="logo-sm" height="28">
        </a>

        <!-- Brand Logo Dark -->
        <a href="/" class="logo-dark">
            <img src="{{ asset('assets/theme/images/logo-dark.png')}}" alt="dark logo" class="logo-lg" height="28">
            <img src="{{ asset('assets/theme/images/logo-sm.png')}}" alt="small logo" class="logo-sm" height="28">
        </a>
    </div>

    <!--- Menu -->
    <div data-simplebar>
        <ul class="app-menu">

            <li class="menu-title">Menu</li>

            <li class="menu-item">
                <a href="/" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-home-smile"></i></span>
                    <span class="menu-text"> Dashboards </span>
                    {{-- <span class="badge bg-primary rounded ms-auto">01</span> --}}
                </a>
            </li>
            
            @can('view-roles')
                <li class="menu-item">
                    <a href="#menuComponentsRoles" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class="bx bx-user-pin"></i></span>
                        <span class="menu-text"> Roles </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="menuComponentsRoles">
                        <ul class="sub-menu">
                            @can('create-roles')
                                <li class="menu-item">
                                    <a href="{{ route('roles.create') }}" class="menu-link">
                                        <span class="menu-text">Add New</span>
                                    </a>
                                </li>
                            @endcan

                            <li class="menu-item">
                                <a href="{{ route('roles.index') }}" class="menu-link">
                                    <span class="menu-text">List</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endcan

            @can('view-users')
                <li class="menu-item">
                    <a href="#menuComponentsUsers" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class="bx bx-user"></i></span>
                        <span class="menu-text"> Users </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="menuComponentsUsers">
                        <ul class="sub-menu">
                            @can('create-users')
                                <li class="menu-item">
                                    <a href="{{ route('users.create') }}" class="menu-link">
                                        <span class="menu-text">Add New</span>
                                    </a>
                                </li>
                            @endcan

                            <li class="menu-item">
                                <a href="{{ route('users.list') }}" class="menu-link">
                                    <span class="menu-text">List</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endcan

            @can('view-departments')
                <li class="menu-item">
                    <a href="#menuComponentsDepartments" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class="bx bx-buildings"></i></span>
                        <span class="menu-text"> Departments </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="menuComponentsDepartments">
                        <ul class="sub-menu">
                            @can('create-departments')
                                <li class="menu-item">
                                    <a href="{{ route('departments.create') }}" class="menu-link">
                                        <span class="menu-text">Add New</span>
                                    </a>
                                </li>    
                            @endcan
                            
                            <li class="menu-item">
                                <a href="{{ route('departments.list') }}" class="menu-link">
                                    <span class="menu-text">List</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endcan

            @can('view-projects')
                <li class="menu-item">
                    <a href="#menuComponentsProjects" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class="bx bx-folder-open"></i></span>
                        <span class="menu-text"> Projects </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="menuComponentsProjects">
                        <ul class="sub-menu">
                            @can('create-projects')
                                <li class="menu-item">
                                    <a href="{{ route('projects.create') }}" class="menu-link">
                                        <span class="menu-text">Add New</span>
                                    </a>
                                </li>    
                            @endcan
                            
                            <li class="menu-item">
                                <a href="{{ route('projects.list') }}" class="menu-link">
                                    <span class="menu-text">List</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endcan

            @can('view-tasks')
                <li class="menu-item">
                    <a href="#menuComponentsTaks" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class="bx bx-task"></i></span>
                        <span class="menu-text"> Tasks </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="menuComponentsTaks">
                        <ul class="sub-menu">
                            @can('create-tasks')
                                <li class="menu-item">
                                    <a href="{{ route('tasks.create') }}" class="menu-link">
                                        <span class="menu-text">Add New</span>
                                    </a>
                                </li>
                            @endcan
                            <li class="menu-item">
                                <a href="{{ route('tasks.list') }}" class="menu-link">
                                    <span class="menu-text">List</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endcan
            
        </ul>
    </div>
</div>
>>>>>>> f822cf6 (updation in the)
