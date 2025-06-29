<div class="sidebar-menu" style="margin-top: -30px">
    <ul class="menu">

        <div class="card">

            <li class="sidebar-title">Menu</li>
            <li class="sidebar-item {{ request()->is('/') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class='sidebar-link'>
                    <i class="bi bi-house-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('laporan-bantuan-hukum') ? 'active' : '' }}"
                title="Laporan Bantuan Hukum">
                <a href="{{ route('schedule') }}" class='sidebar-link'>
                    <i class="bi bi-bank2"></i>
                    <span>Bantuan Hukum</span>
                </a>
            </li>
            {{-- <li class="sidebar-item {{ request()->is('laporan-aksi-ham') ? 'active' : '' }}" title="Laporan Aksi Ham">
         <a href="{{ route('ranham.home') }}" class='sidebar-link'>
             <i class="bi bi-card-checklist"></i>
             <span>Kami Peduli</span>
         </a>
     </li> --}}
            {{-- <li class="sidebar-item {{ request()->is('ecorrection') ? 'active' : '' }}">
      <a href="{{ route('ecorrection') }}" class='sidebar-link'>
          <i class="bi bi-clipboard-check-fill"></i>
          <span>E-Corection</span>
      </a>
    </li> --}}
            <livewire:custom-menu-dashboard />

    </ul>
</div>
