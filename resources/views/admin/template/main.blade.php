<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin Bhos-Cetar</title>
    <script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" href="/dist/assets/compiled/jpg/logotanahdatar.png" type="image/x-icon">
    <link rel="stylesheet" href="/dist/assets/extensions/choices.js/public/assets/styles/choices.css">
    <link rel="stylesheet" href="/dist/assets/compiled/css/app.css">
    <link rel="stylesheet" href="/dist/assets/compiled/css/application-email.css">
    <link rel="stylesheet" href="/dist/assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="/dist/assets/extensions/sweetalert2-11.12.4/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"/>
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @livewireStyles
</head>

<body>
    <div id="app">
        <div id="main" class='layout-navbar navbar-fixed'>
         <header>
            @include('admin.template.header')
         </header>
            <div id="sidebar">
                <div class="sidebar-wrapper active">
                  <div class="sidebar-header position-relative p-3">
                     <div class="d-flex justify-content-center">
                         <div class="logo d-flex flex-column align-items-center">
                             <img src="/dist/assets/compiled/jpg/logotanahdatar.png" style="width: 50px; height: 50px;" alt="Logo" class="mb-2">
                             <span style="font-size: 20px;">Bhos-Cetar</span>
                             <span style="font-size: 16px; font-weight: bold;">Admin Panel</span>
                         </div>
                         <div class="sidebar-toggler x">
                             <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                         </div>
                     </div>
                 </div>
                @include('admin.template.sidebarmenu')
            </div>
        </div>
        <div id="main-content">
            @yield('content')
            <livewire:clear-temporary />
        </div>


    </div>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="/dist/assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
    <script src="/dist/assets/extensions/sweetalert2-11.12.4/dist/sweetalert2.all.min.js"></script>
    <script src="/dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/dist/assets/compiled/js/app.js"></script>
    <script src="/dist/assets/static/js/pages/form-element-select.js"></script>
    @include('dashboard.component.sweet-toast')
    @include('dashboard.component.sweet-toast-error')
    @yield('script')
    @livewireScripts

</body>

</html>
