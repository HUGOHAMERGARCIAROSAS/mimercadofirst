<!doctype html>
<html lang="es">
<head>
    <title>Administrador | MiMercado.delivery</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Desarrollado por www.pyrusstudio.com - www.pyrushd.com">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=11">

    <link rel="icon" href="{{ asset('admin/pyrus/images/favicon.ico') }}" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/2.6.95/css/materialdesignicons.css"
          media="all" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('admin/light/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/light/assets/css/color_skins.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/lightbox.min.css') }}"/>

    @yield('css')
    @yield('styles')
</head>
<body class="theme-green">

<!-- Page Loader -->
<div class="page-loader-wrapper" style=" background: #062d45">
    <div class="loader">
        <div class="m-t-30">
            <img src="{{ asset('admin/pyrus/images/cargando.png')}}"
                 width="48" height="48" alt="PyrusHD"></div>
        <p>Cargando...</p>
    </div>
</div>
<!-- Overlay For Sidebars -->

<div id="wrapper">
    @include('admin.layouts._header')

    @include('admin.layouts._menu')

    <div id="main-content">
        <div class="container-fluid">
            @yield('block-header')
            <div class="row clearfix">
                @yield('content')
            </div>
        </div>
    </div>
</div>

<!-- Javascript -->
<script src="{{ asset('admin/light/assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('admin/light/assets/bundles/vendorscripts.bundle.js') }}"></script>
<script src="{{ asset('admin/light/assets/bundles/mainscripts.bundle.js') }}"></script>
<script src="{{ asset('admin/assets/lightbox.min.js') }}"></script>
<script src="{{ asset('bower_components/handlebars/handlebars.min.js') }}"></script>
<script>
    $(function () {
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $.ajaxSetup({
            headers: {
                'x-csrf-token': token,
            }
        });
    });
</script>
@yield('scripts')
</body>

</html>
