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