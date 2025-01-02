<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <img src="{{ asset('../adminlte/dist/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">AdminLTE 4</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <!-- Data -->
                <li
                    class="nav-item {{ request()->is('admin/students*') || request()->is('admin/lecturers*') || request()->is('admin/get-all-books*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ request()->is('admin/students*') || request()->is('admin/lecturers*') || request()->is('admin/get-all-books*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-folder"></i>
                        <p>
                            Data
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- Books Data -->
                        <li class="nav-item {{ request()->is('admin/get-all-books*') ? 'menu-open' : '' }}">
                            <a href="#"
                                class="nav-link {{ request()->is('admin/get-all-books*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-book"></i>
                                <p>
                                    Books Data
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.get-all-books.index') }}"
                                        class="nav-link {{ request()->routeIs('admin.get-all-books.index') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Index</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Insert Data</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Upload Data From Excel</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Students Data -->
                        <li class="nav-item {{ request()->is('admin/students*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('admin/students*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-person"></i>
                                <p>
                                    Students Data
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.students.index') }}"
                                        class="nav-link {{ request()->routeIs('admin.students.index') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Index</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.students.create') }}"
                                        class="nav-link {{ request()->routeIs('admin.students.create') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Insert Data</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.students.upload') }}"
                                        class="nav-link {{ request()->routeIs('admin.students.upload') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Upload Data From Excel</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Lecturers Data -->
                        <li class="nav-item {{ request()->is('admin/lecturers*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('admin/lecturers*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-people"></i>
                                <p>
                                    Lecturers Data
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.lecturers.index') }}"
                                        class="nav-link {{ request()->routeIs('admin.lecturers.index') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Index</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.lecturers.create') }}"
                                        class="nav-link {{ request()->routeIs('admin.lecturers.create') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Insert Data</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.lecturers.upload') }}"
                                        class="nav-link {{ request()->routeIs('admin.lecturers.upload') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Upload Data From Excel</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
