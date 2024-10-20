<header>
    <nav class="navbar navbar-expand navbar-light navbar-top">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-lg-0">
                    <livewire:notification-live/>
                </ul>
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <livewire:profile-card/>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                        style="min-width: 11rem;">
                        <li>
                            <livewire:profile-dropdown-name/>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout.dashboard') }}" method="post">
                                @csrf
                                <button class="dropdown-item" type="submit">
                                    <i class="icon-mid bi bi-box-arrow-left me-2"></i>
                                        Logout
                                </button>
                            </form>

                         </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
