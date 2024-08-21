<div class="sidebar-left">
    <div class="sidebar">
        <div class="sidebar-content email-app-sidebar d-flex">
            <!-- sidebar close icon -->
            <span class="sidebar-close-icon">
                <i class="bi bi-x"></i>
            </span>
            <!-- sidebar close icon -->
            <div class="email-app-menu">
                <div class="card">
                    <div class="card-body py-4 px-4">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img src="/assets/compiled/png/user.png" alt="Face 1">
                            </div>
                            <div class="ms-3 name">
                                <h5 class="font-bold">Admin</h5>
                                <h6 class="text-muted mb-0">Administrator <i class="fas fa-user-shield"></i></h6>
                            </div>
                            <div style="padding-left: 50px;">
                                <form action="{{route('logout.admin')}}" method="post">
                                    @csrf
                                <button  class="dropdown-item" type="submit">
                                </form>
                                <i class="me-50" data-feather="power"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sidebar-menu-list ps">
                    <!-- sidebar menu -->
                    <div class="list-group list-group-messages">
                        <!-- Dashboard Menu -->
                        <a wire:navigate href="{{ url('/admin') }}"
                           class="list-group-item pt-0 {{ request()->is('admin') ? 'active' : '' }}"
                           id="dashboard-menu">
                            <div class="fonticon-wrap d-inline me-3">
                                <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                    <use xlink:href="{{ asset('/assets/static/images/bootstrap-icons.svg#house-fill') }}" />
                                </svg>
                            </div>
                            Dashboard
                        </a>
                        <!-- Menus -->
                        <a href="#" class="list-group-item pt-0 {{ request()->is('inbox*') ? 'active' : '' }}" id="menus-dropdown" data-bs-toggle="collapse" data-bs-target="#menus-submenu" aria-expanded="false" aria-controls="menus-submenu">
                            <div class="fonticon-wrap d-inline me-3">
                                <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                    <use xlink:href="{{ asset('/assets/static/images/bootstrap-icons.svg#grid-fill') }}" />
                                </svg>
                            </div>
                            Bhos-Cetar
                            <i class="bi bi-chevron-down float-right mt-50"></i>
                        </a>
                        <!-- Sub-menus -->
                        <div class="collapse" id="menus-submenu">
                            <a wire:navigate href="{{ route('admin.inbox') }}" class="list-group-item ps-5 pt-0 {{ request()->is('inbox/list') ? 'active' : '' }}">
                                <div class="fonticon-wrap d-inline me-1">
                                    <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                        <use xlink:href="{{ asset('/assets/static/images/bootstrap-icons.svg#envelope') }}" />
                                    </svg>
                                </div>
                                Kontak Masuk
                                <span class="badge bg-light-danger badge-pill badge-round float-right mt-50">
                                    <livewire:inbox-counter-live/>
                                </span>
                            </a>
                            <a wire:navigate href="{{ url('#') }}" class="list-group-item ps-5 pt-0 {{ request()->is('submenu2') ? 'active' : '' }}">
                                Sub Menu 2
                            </a>
                            <a wire:navigate href="{{ url('#') }}" class="list-group-item ps-5 pt-0 {{ request()->is('submenu3') ? 'active' : '' }}">
                                Sub Menu 3
                            </a>
                        </div>
                    </div>
                    <!-- sidebar menu end-->
                </div>

            </div>
        </div>

    </div>
</div>
