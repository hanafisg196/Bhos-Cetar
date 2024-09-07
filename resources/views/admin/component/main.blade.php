<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - BHOS Ce-Tar</title>
   @livewireStyles
    <link rel="icon" href="/dist/assets/compiled/png/logotanahdatar.png" type="image/x-icon">
    <link rel="stylesheet" href="/dist/assets/compiled/css/application-email.css">
    <link rel="stylesheet" href="/dist/assets/compiled/css/app.css">
    <link rel="stylesheet" href="/dist/assets/compiled/css/iconly.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>
<body>
    <div class="page-heading email-application overflow-hidden">
        <section class="section content-area-wrapper">
            @include('admin.component.sidebarmenu')
            <div class="content-right" style="background: white;">
                <div class="content-overlay">
                </div>
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
    <script src="/dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/dist/assets/compiled/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/dist/assets/static/js/pages/dashboard.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
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
