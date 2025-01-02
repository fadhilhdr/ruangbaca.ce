<!--begin::Header-->
<nav class="app-header navbar navbar-expand bg-body"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i
                        class="bi bi-list"></i> </a> </li>
            <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Home</a> </li>
        </ul> <!--end::Start Navbar Links--> <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto"> <!--begin::Navbar Search-->
            <li class="nav-item"> <a class="nav-link" data-widget="navbar-search" href="#" role="button"> <i
                        class="bi bi-search"></i> </a> </li> <!--end::Navbar Search-->
            <!--begin::Notifications Dropdown Menu-->
            <li class="nav-item dropdown"> <a class="nav-link" data-bs-toggle="dropdown" href="#"> <i
                        class="bi bi-bell-fill"></i> <span class="navbar-badge badge text-bg-warning">15</span> </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <span
                        class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"> <i
                            class="bi bi-envelope me-2"></i> 4 new messages
                        <span class="float-end text-secondary fs-7">3 mins</span> </a>
                    <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"> <i
                            class="bi bi-people-fill me-2"></i> 8 friend requests
                        <span class="float-end text-secondary fs-7">12 hours</span> </a>
                    <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"> <i
                            class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                        <span class="float-end text-secondary fs-7">2 days</span> </a>
                    <div class="dropdown-divider"></div> <a href="#" class="dropdown-item dropdown-footer">
                        See All Notifications
                    </a>
                </div>
            </li> <!--end::Notifications Dropdown Menu--> <!--begin::Fullscreen Toggle-->
            <li class="nav-item"> <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i
                        data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i data-lte-icon="minimize"
                        class="bi bi-fullscreen-exit" style="display: none;"></i> </a> </li>
            <!--end::Fullscreen Toggle--> <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle"
                    data-bs-toggle="dropdown">
                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span> </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <!--begin::User Image-->
                    <li class="user-header text-bg-primary">
                        <p>
                            {{ Auth::user()->name }}
                            <small>Member since {{ Auth::user()->created_at }}</small>
                        </p>
                    </li> <!--end::User Image--> <!--begin::Menu Body-->
                    <li class="user-body"> <!--begin::Row-->
                        <div class="row">
                            <div class="col-4 text-center"> <a href="{{ route('profile.edit') }}">Profile</a> </div>
                            <div class="col-4 text-center"> <a href="#"></a> </div>
                            <div class="col-4 text-center">
                                <form id="logout-form" method="POST" action="{{ route('logout') }}"
                                    style="display: none;">
                                    @csrf
                                </form>

                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Sign Out
                                </a>
                            </div>
                        </div> <!--end::Row-->
                    </li> <!--end::Menu Body-->
                </ul>
            </li> <!--end::User Menu Dropdown-->
        </ul> <!--end::End Navbar Links-->
    </div> <!--end::Container-->
</nav> <!--end::Header-->
