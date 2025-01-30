<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <img src="{{ asset('../adminlte/dist/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">RBC</span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <div class="divider"></div>
                <li class="nav-header">MASTER DATA</li>

                <li class="nav-item has-treeview {{ request()->is('admin/students*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/students*') ? 'active' : '' }}">
                        <i class="bi bi-person"></i>
                        <p>
                            Mahasiswa
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.students.index') }}"
                                class="nav-link {{ request()->routeIs('admin.students.index') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Indeks Mahasiswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.students.create') }}"
                                class="nav-link {{ request()->routeIs('admin.students.create') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Tambah Mahasiswa</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- book data --}}
                <li class="nav-item {{ request()->is('admin/books*') ? 'menu-open' : '' }}">
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
                </li>
                <li class="nav-item {{ request()->is('admin/document*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/document*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-text-fill"></i>
                        <p>
                            Dokumen TA
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
                </li>

                <li class="nav-item {{ request()->is('admin/capstones*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/capstones*') ? 'active' : '' }}">
                        <i class="bi bi-archive"></i>
                        <p>
                            Dokumen Capstone
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.capstones.index') }}"
                                class="nav-link {{ request()->routeIs('admin.capstones.index') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Indeks Capstone</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.capstones.create') }}"
                                class="nav-link {{ request()->routeIs('admin.capstones.create') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Tambah Capstone</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.visitor.index') }}" class="nav-link">
                        <i class="bi bi-bar-chart"></i>
                        <p>Pengunjung</p>
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a href="{{ route('admin.transaction.index') }}" class="nav-link">
                        <i class="bi bi-receipt"></i>
                        <p>Transaksi</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.fines.index') }}" class="nav-link">
                        <i class="bi bi-cash-stack"></i>
                        <p>Denda</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
