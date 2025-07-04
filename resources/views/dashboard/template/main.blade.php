<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Bhos Cetar</title>
    <script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" href="/dist/assets/compiled/jpg/logotanahdatar.png" type="image/x-icon">
    <link rel="stylesheet" href="/dist/assets/compiled/css/app.css">
    <link rel="stylesheet" href="/dist/assets/compiled/css/my-custome.css">
    <link rel="stylesheet" href="/dist/assets/compiled/css/application-email.css">
    <link rel="stylesheet" href="/dist/assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="/dist/assets/extensions/sweetalert2-11.12.4/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="/dist/assets/extensions/filepond/dist/filepond.css"  rel="stylesheet">
    <link rel="stylesheet" href="/dist/assets/extensions/filepond/plugin/image-preview/dist/filepond-plugin-image-preview.css" />
    @livewireStyles
</head>

<body>
    <div id="app">
        <div id="main" class='layout-navbar navbar-fixed'>
            <header>
                @include('dashboard.template.header')
            </header>
            <div id="sidebar">
                <div class="sidebar-wrapper active">
                    <div class="sidebar-header position-relative">
                     <div class="d-flex justify-content-center">
                        <div class="logo d-flex flex-column align-items-center">
                            <img src="/dist/assets/compiled/jpg/logotanahdatar.png" style="width: 50px; height: 50px;" alt="Logo" class="mb-2">
                            <span style="font-size: 20px;">Bhos Cetar</span>
                            <span style="font-size: 16px; font-weight: bold;">Sistem Layanan Hukum</span>
                        </div>
                        <div class="sidebar-toggler x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                    </div>
                    @include('dashboard.template.sidebarmenu')
                </div>
            </div>
            <div id="main-content">
                @yield('content')
                @include('dashboard.template.footer')
                <livewire:clear-temporary />
            </div>
        </div>

        <script src="/dist/assets/extensions/filepond/plugin/image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="/dist/assets/extensions/filepond/plugin/validate-size/dist/filepond-plugin-file-validate-size.js"></script>
        <script src="/dist/assets/extensions/filepond/plugin/validate-type/dist/filepond-plugin-file-validate-type.js"></script>
        <script src="/dist/assets/extensions/filepond/dist/filepond.js"></script>
        <script src="/dist/assets/extensions/sweetalert2-11.12.4/dist/sweetalert2.all.min.js"></script>
        <script src="/dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="/dist/assets/compiled/js/app.js"></script>
        <script src="/dist/assets/static/js/pages/form-element-select.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        @include('dashboard.component.sweet-toast')
        @include('dashboard.component.sweet-toast-error')
        @yield('script')
        @livewireScripts

</body>

</html>
