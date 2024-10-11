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
        <li class="sidebar-item {{ request()->is('laporan-bantuan-hukum') ? 'active' : '' }}" title="Laporan Bantuan Hukum">
            <a href="{{ route('schedule') }}" class='sidebar-link'>
               <i class="bi bi-bank2"></i>
                <span>Bantuan Hukum</span>
            </a>
        </li>
        <livewire:rule-managament-live/>

    </ul>
</div>
