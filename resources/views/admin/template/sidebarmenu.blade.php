<div class="sidebar-menu" style="margin-top: -50px">
    <ul class="menu">
    <div class="card">
         <li class="sidebar-title">Menu
            <li class="sidebar-item {{ request()->is('admin') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class='sidebar-link'>
                    <i class="bi bi-house-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item has-sub {{ request()->is('inbox*') ? 'active' : '' }}">
                <a href="#" class='sidebar-link'>
                  <i class="bi bi-bank"></i>
                    <span>Bantuan Hukum</span>
                    <span class="badge bg-light-danger badge-pill badge-round float-right" style="margin-left: 10px; color: black;">
                     <livewire:lbh-count-on-sidebar/>
                    </span>
                </a>
                <ul class="submenu">
                    <li class="submenu-item {{ request()->is('inbox/list/bantuan-hukum') ? 'active' : '' }}">
                        <a href="{{ route('admin.list.lbh') }}" class="submenu-link">
                            <span>Kontak Masuk</span>
                            <span class="badge bg-light-danger badge-pill badge-round float-right" style="margin-left: 10px; color: black;">
                              <livewire:lbh-count-on-sidebar/>
                             </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item has-sub {{ request()->is('list*') ? 'active' : '' }}">
               <a href="#" class='sidebar-link'>
                  <i class="bi bi-book-fill"></i>
                   <span>Kami Peduli</span>
                   <span class="badge bg-light-danger badge-pill badge-round float-right" style="margin-left: 43px; color: black;">
                     <livewire:lah-count-on-sidebar/>
                    </span>
               </a>
               <ul class="submenu">
                   <li class="submenu-item {{ request()->is('list/aksi-ham/inbox') ? 'active' : '' }}">
                       <a href="{{ route('admin.list.lah') }}" class="submenu-link">
                        <span>Kontak Masuk</span>
                           <span class="badge bg-light-danger badge-pill badge-round float-right" style="margin-left: 10px; color: black;">
                              <livewire:lah-count-on-sidebar/>
                           </span>
                       </a>
                   </li>
               </ul>
           </li>
           <livewire:custom-menu-admin/>
           <li class="sidebar-item">
            <a href="{{ route('dashboard') }}" class='sidebar-link'>
               <i class="bi bi-house-up-fill"></i>
                <span>Bhos Cetar</span>
            </a>
        </li>
         </li>
      </div>
    </ul>
</div>
