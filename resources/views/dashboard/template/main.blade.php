<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BHOS Ce-Tar</title>
    <link rel="shortcut icon" href="/assets/compiled/png/logotanahdatar.png" type="image/x-icon">
    <link rel="stylesheet" href="/dist/assets/compiled/css/application-email.css">
    <link rel="stylesheet" href="/assets/compiled/css/app.css">
    <link rel="stylesheet" href="/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="/assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="/assets/extensions/choices.js/public/assets/styles/choices.css">
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="/assets/extensions/toastify-js/src/toastify.css">
    @livewireStyles
</head>

<body>
    <script src="/assets/static/js/initTheme.js"></script>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i
                                    class="bi bi-x bi-middle"></i></a>
                        </div>

                    </div>
                </div>
                @include('dashboard.template.sidebarmenu')
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            @yield('content')
            @include('dashboard.template.footer')
            <livewire:clear-temporary />
        </div>
    </div>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js">
    </script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>


    @yield('script')
    <script src="/assets/static/js/components/dark.js"></script>
    <script src="/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/assets/compiled/js/app.js"></script>

    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/trix.umd.min.js"></script>
    <script src="/assets/extensions/tinymce/tinymce.min.js"></script>
    <script src="/assets/static/js/pages/tinymce.js"></script>


    <script src="/assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
    <script src="/assets/static/js/pages/form-element-select.js"></script>

    <script src="/assets/extensions/toastify-js/src/toastify.js"></script>
    <script src="/assets/static/js/pages/toastify.js"></script>

    <script src="https://unpkg.com/sweetalert/sweetalert.min.js"></script>
    @livewireScripts
</body>

</html>
