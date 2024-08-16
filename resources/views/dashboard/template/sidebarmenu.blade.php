<div class="sidebar-menu" style="margin-top: -30px">
    <ul class="menu">
        @livewire('profile-card')
        <div class="card">
        <li class="sidebar-title">Menu</li>
        <li class="sidebar-item {{ request()->is('/') ? 'active' : '' }}">
            <a wire:navigate  href="{{ route('dashboard') }}" class='sidebar-link'>
                <i class="bi bi-house-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item {{ request()->is('schedule') ? 'active' : '' }}">
            <a wire:navigate href="{{ route('schedule') }}" class='sidebar-link'>
                <i class="bi bi-sticky-fill"></i>
                <span>Bantuan Hukum</span>
            </a>
        </li>

    </ul>
    <div style="padding-left:44px;">
        <form action="{{ route('logout.dashboard') }}" method="post">
            @csrf
            <button class="dropdown-item" type="submit">
                <i class="me-50" data-feather="log-out"></i>
                <span>Logout</span>
        </form>

    </div>
</div>
