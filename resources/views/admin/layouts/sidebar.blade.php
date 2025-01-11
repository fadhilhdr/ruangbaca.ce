<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <img src="{{ asset('../adminlte/dist/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">RBC</span>
        </a>
    </div>
    <div class="sidebar-body">

    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item"> <a href="{{ route('admin.dashboard') }}" class="nav-link"> <i
                            class="bi bi-speedometer"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item"> <a href="{{ route('admin.transaction.index') }}" class="nav-link"> <i
                            class="bi bi-receipt"></i>
                        <p>
                            Transaksi
                        </p>
                    </a>
                </li>
                <!-- Students Menu -->
                <li class="nav-item has-treeview {{ request()->is('admin/students*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/students*') ? 'active' : '' }}">
                        <i class="bi bi-person"></i>
                        <p>
                            Students
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

                <!-- Lecturers Menu -->
                <li class="nav-item {{ request()->is('admin/lecturers*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/lecturers*') ? 'active' : '' }}">
                        <i class="bi bi-person-badge"></i>
                        <p>
                            Lecturers
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
                            <a href="#"
                                class="nav-link {{ request()->routeIs('admin.lecturers.upload') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Upload Data From Excel</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Book Menu -->
                <li class="nav-item {{ request()->is('admin/books*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/books*') ? 'active' : '' }}">
                        <i class="bi bi-book"></i>
                        <p>
                            Book
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.books.index') }}"
                                class="nav-link {{ request()->routeIs('admin.books.index') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Index</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.books.create') }}"
                                class="nav-link {{ request()->routeIs('admin.books.create') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Insert</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item"> <a href="{{ route('admin.fines.index') }}" class="nav-link">
                        <i class="bi bi-cash-stack"></i>
                        <p>
                            Denda
                        </p>
                    </a>
                </li>
                <li class="nav-item"> <a href="{{ route('admin.visitor.index') }}" class="nav-link">
                        <i class="bi bi-bar-chart"></i>
                        <p>
                            Visitor
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
