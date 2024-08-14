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
                                <img src="/assets/compiled/png/1.png" alt="Face 1">
                            </div>
                            <div class="ms-3 name">
                                <h5 class="font-bold">Admin</h5>
                                <h6 class="text-muted mb-0">Administrator <i class="fas fa-user-shield"></i></h6>
                            </div>
                            <div style="padding-left: 50px;">
                                <form action="/logout" method="post">
                                    @csrf
                                <button class="dropdown-item" type="submit">
                                </form>
                                <i class="me-50" data-feather="power"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sidebar-menu-list ps">
                    <!-- sidebar menu  -->
                    <div class="list-group list-group-messages">
                        <a wire:navigate href="{{ url('/admin') }}"
                            class="list-group-item pt-0 {{ request()->is('admin') ? 'active' : '' }}"
                            id="inbox-menu">
                            <div class="fonticon-wrap d-inline me-3">
                                <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                    <use
                                        xlink:href="{{ asset('assets/static/images/bootstrap-icons.svg#envelope') }}" />
                                </svg>
                            </div>
                            Inbox
                            <span class="badge bg-light-primary badge-pill badge-round float-right mt-50">1</span>
                        </a>
                    </div>
                    <!-- sidebar menu  end-->

                </div>
            </div>
        </div>

    </div>
</div>
