<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - BHOS Ce-Tar</title>
   @livewireStyles
    <link rel="icon" href="/assets/compiled/png/logotanahdatar.png" type="image/x-icon">
    <link rel="stylesheet" href="/assets/compiled/css/application-email.css">
    <link rel="stylesheet" href="/assets/compiled/css/app.css">
    <link rel="stylesheet" href="/assets/compiled/css/app-dark.css">
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div class="page-heading email-application overflow-hidden">
        <section class="section content-area-wrapper">
            @include('admin.component.sidebarmenu')
            <div class="content-right">
                <div class="content-overlay"></div>
                <div class="content-wrapper">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                        @yield('content')
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="/assets/static/js/components/dark.js"></script>
    <script src="/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/assets/compiled/js/app.js"></script>
    <script src="https://unpkg.com/sweetalertsweetalert.min.js"></script>
    <script src="/assets/static/js/pages/dashboard.js"></script>

    <script>
        document.querySelector('.sidebar-toggle').addEventListener('click', () => {
            document.querySelector('.email-app-sidebar').classList.toggle('show')
        })
        document.querySelector('.sidebar-close-icon').addEventListener('click', () => {
            document.querySelector('.email-app-sidebar').classList.remove('show')
        })
        document.querySelector('.compose-btn').addEventListener('click', () => {
            document.querySelector('.compose-new-mail-sidebar').classList.add('show')
        })
        document.querySelector('.email-compose-new-close-btn').addEventListener('click', () => {
            document.querySelector('.compose-new-mail-sidebar').classList.remove('show')
        })
    </script>
  @livewireScripts
</body>

</html>
