<div class="sidebar-menu" style="margin-top: -30px">
    <ul class="menu">

        <div class="card">
        <li class="sidebar-title">Menu</li>
        <li class="sidebar-item {{ request()->is('/') ? 'active' : '' }}">
            <a  href="{{ route('dashboard') }}" class='sidebar-link'>
                <i class="bi bi-house-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li  class="sidebar-item {{ request()->is('bantuan') ? 'active' : '' }}">
            <a    href="{{ route('schedule') }}" class='sidebar-link'>
                <i class="bi bi-sticky-fill"></i>
                <span>Bantuan Hukum</span>
            </a>
        </li>
        <li class="sidebar-item {{ request()->is('laporan-ham') ? 'active' : '' }}">
            <a  href="{{route('ranham.home')}}" class='sidebar-link'>
                <i class="bi bi-file-earmark-arrow-up-fill"></i>
                <span>Laporan Aksi Ham</span>
            </a>
        </li>

    </ul>

</div>
