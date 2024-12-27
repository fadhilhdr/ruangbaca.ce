<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <!--begin::Brand Image--> <img src="{{ asset('../adminlte/dist/assets/img/AdminLTELogo.png') }}"
                alt="AdminLTE Logo" class="brand-image opacity-75 shadow"> <!--end::Brand Image-->
            <!--begin::Brand Text--> <span class="brand-text fw-light">AdminLTE 4</span> <!--end::Brand Text--> </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Students Data
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{ route('admin.students.index') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Index</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('admin.students.create') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Insert Data</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('admin.students.upload') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Upload Data From Excel</p>
                            </a> </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Lecturers Data
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{ route('admin.lecturers.index') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Index</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('admin.lecturers.create') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Insert Data</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('admin.students.upload') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Upload Data From Excel</p>
                            </a> </li>
                    </ul>
                </li>
            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar-->
