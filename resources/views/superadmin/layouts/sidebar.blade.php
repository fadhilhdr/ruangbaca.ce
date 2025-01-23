<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route('superadmin.dashboard') }}" class="brand-link">
            <span class="brand-text fw-light">Superadmin RBC</span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('superadmin.dashboard') }}" class="nav-link">
                        <i class="bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <div class="divider"></div>
                <li class="nav-header">MASTER DATA</li>
                <li class="nav-item has-treeview {{ request()->is('superadmin/students*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('superadmin/students*') ? 'active' : '' }}">
                        <i class="bi bi-person"></i>
                        <p>
                            Mahasiswa
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('superadmin.students.index') }}"
                                class="nav-link {{ request()->routeIs('superadmin.students.index') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Indeks Mahasiswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('superadmin.students.create') }}"
                                class="nav-link {{ request()->routeIs('superadmin.students.create') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Tambah Mahasiswa</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Lecturer data --}}
                <li class="nav-item {{ request()->is('superadmin/employees*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('superadmin/employees*') ? 'active' : '' }}">
                        <i class="bi bi-person-badge"></i>
                        <p>
                            Pegawai
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('superadmin.employees.index') }}"
                                class="nav-link {{ request()->routeIs('superadmin.employees.index') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Index</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('superadmin.employees.create') }}"
                                class="nav-link {{ request()->routeIs('superadmin.employees.create') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Insert Data</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- User data --}}
                <li class="nav-item {{ request()->is('superadmin/users*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('superadmin/employees*') ? 'active' : '' }}">
                        <i class="bi bi-person-badge"></i>
                        <p>
                            Pengguna
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('superadmin.users.index') }}"
                                class="nav-link {{ request()->routeIs('superadmin.users.index') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Index</p>
                            </a>
                        </li>

                    </ul>
                </li>
                {{-- book data --}}
                {{-- <li class="nav-item {{ request()->is('admin/books*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/books*') ? 'active' : '' }}">
                        <i class="bi bi-book"></i>
                        <p>
                            Buku
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.books.index') }}"
                                class="nav-link {{ request()->routeIs('admin.books.index') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Indeks Buku</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.books.create') }}"
                                class="nav-link {{ request()->routeIs('admin.books.create') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Tambah Buku</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                {{-- <li class="nav-item {{ request()->is('admin/document*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/document*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-text-fill"></i>
                        <p>
                            Dokumen
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.document.index') }}"
                                class="nav-link {{ request()->routeIs('admin.document.index') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Indeks Dokumen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.document.create') }}"
                                class="nav-link {{ request()->routeIs('admin.document.create') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Tambah Dokumen</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.visitor.index') }}" class="nav-link">
                        <i class="bi bi-bar-chart"></i>
                        <p>Pengunjung</p>
                    </a>
                </li> --}}
                <hr>
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.transaction.index') }}" class="nav-link">
                        <i class="bi bi-receipt"></i>
                        <p>Transaksi</p>
                    </a>
                </li> --}}

                {{-- <li class="nav-item">
                    <a href="{{ route('admin.fines.index') }}" class="nav-link">
                        <i class="bi bi-cash-stack"></i>
                        <p>Denda</p>
                    </a>
                </li> --}}

            </ul>
        </nav>
    </div>
</aside>
