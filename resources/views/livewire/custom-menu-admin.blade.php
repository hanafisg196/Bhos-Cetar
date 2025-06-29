<div>
    {{-- The whole world belongs to you. --}}
    @if ($checkAccess === true)
    <li class="sidebar-item has-sub {{ request()->is('ecorrection*') ? 'active' : '' }}">
      <a href="#" class='sidebar-link'>
         <i class="bi bi-calendar2-check-fill"></i>
          <span>Ecorrection</span>
          <span class="badge bg-light-danger badge-pill badge-round float-right" style="margin-left: 48px; color: black;">
            {{$allReadCount}}
           </span>
      </a>
      <ul class="submenu">
          <li class="submenu-item {{ request()->is('ecorrection/list/inbox') ? 'active' : '' }}">
              <a href="{{ route('admin.list.ecorrection') }}" class="submenu-link">
                  <span>Kontak Masuk</span>
                  <span class="badge bg-light-danger badge-pill badge-round float-right" style="margin-left: 10px; color: black;">
                  {{$allReadCount}}
                  </span>
              </a>
          </li>
      </ul>
     </li>
     @endif
     @if ($checkAccessUserManager === true)
     <li class="sidebar-item {{ request()->is('admin/user/manager') ? 'active' : '' }}">
      <a href="{{ route('admin.dashboard.user.manager') }}" class='sidebar-link'>
         <i class="bi bi-person-check-fill"></i>
          <span>User Manager</span>
      </a>
  </li>
     @endif
</div>
