<nav id="sidebar" class="col-md-3 col-lg-2">
    <div class="position-sticky pt-3 sidebar-menu">
        <ul class="nav flex-column">
            <li class="nav-item mb-3">
                <div class="brand text-center">
                    <i class="bi bi-caret-right"></i>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door"></i> <span>Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
                    <i class="bi bi-person"></i> <span>Profile</span>
                </a>
            </li>
            @if (Auth::user()->Jabatan != 'Pegawai')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('verifikasi.index') ? 'active' : '' }}" href="{{ route('verifikasi.index') }}">
                    <i class="bi bi-check-circle"></i> <span>Verif</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="/logout">
                    <i class="bi bi-box-arrow-left"></i> <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
