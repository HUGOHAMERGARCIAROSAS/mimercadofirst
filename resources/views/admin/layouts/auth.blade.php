<!doctype html>
<html lang="es">
<head>
    <title>Iniciar Sesión | MiMercado.delivery</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Desarrollado por www.pyrusstudio.com - www.pyrushd.com">
    <link rel="icon" href="{{ asset('admin/pyrus/images/favicon.ico') }}" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('admin/light/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/light/assets/css/color_skins.css') }}">
</head>

<body class="theme-green">
<!-- WRAPPER -->
<div id="wrapper">
    <div class="vertical-align-wrap">
        <div class="vertical-align-middle auth-main">
            <div class="auth-box">
                <div class="top">
                    <img src="{{ asset('admin/pyrus/images/LOGO.png') }}" alt="PyrusHD">
                </div>
                @yield('content')
            </div>
        </div>
    </div>
</div>
<!-- END WRAPPER -->
</body>
</html>
