<nav class="pcoded-navbar menu-light ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div " >
            
            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="{{ asset('assets/theme2/images/user/avatar-2.jpg')}}" alt="User-Profile-Image">
                    <div class="user-details">
                        <div id="more-details">UX Designer <i class="fa fa-caret-down"></i></div>
                    </div>
                </div>
                <div class="collapse" id="nav-user-link">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a href="user-profile.html"><i class="feather icon-user m-r-5"></i>View Profile</a></li>
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
                    <a href="index.html" class="nav-link "><span class="pcoded-micon"><i class="fa fa-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>

                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fa fa-user-tag"></i></span><span class="pcoded-mtext">Roles</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="layout-vertical.html" target="_blank">Add New</a></li>
                        <li><a href="layout-horizontal.html" target="_blank">List</a></li>
                    </ul>
                </li>

                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fa fa-users"></i></span><span class="pcoded-mtext">Users</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="layout-vertical.html" target="_blank">Add New</a></li>
                        <li><a href="layout-horizontal.html" target="_blank">List</a></li>
                    </ul>
                </li>

                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fa fa-building"></i></span><span class="pcoded-mtext">Departments</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="layout-vertical.html" target="_blank">Add New</a></li>
                        <li><a href="layout-horizontal.html" target="_blank">List</a></li>
                    </ul>
                </li>

                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fa fa-folder"></i></span><span class="pcoded-mtext">Projects</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="layout-vertical.html" target="_blank">Add New</a></li>
                        <li><a href="layout-horizontal.html" target="_blank">List</a></li>
                    </ul>
                </li>

                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fa fa-tasks"></i></span><span class="pcoded-mtext">Tasks</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="layout-vertical.html" target="_blank">Add New</a></li>
                        <li><a href="layout-horizontal.html" target="_blank">List</a></li>
                    </ul>
                </li>

                <li class="nav-item pcoded-menu-caption">
                    <label>Pages</label>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-lock"></i></span><span class="pcoded-mtext">Authentication</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="auth-signup.html" target="_blank">Sign up</a></li>
                        <li><a href="auth-signin.html" target="_blank">Sign in</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="sample-page.html" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Sample page</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>