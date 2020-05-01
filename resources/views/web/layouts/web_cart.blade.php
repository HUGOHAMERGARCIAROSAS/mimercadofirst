<!DOCTYPE html>
<html class="no-js" lang="es">
<head>
    <meta name="language" content="es-PE"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#ffdd59">
    <meta name="description"
          content="Encuentra los mejores productos y paga 100% seguro. MiMercado.delivery lo que quieras a tu casa. Frutas, Abarrotes y todo el mercado a ¡Preciazos! Comprando desde la comodidad de tu hogar. Llámanos al 948319098. Aceptamos todas las tarjetas de crédito. Llegamos a todo Trujillo. Es el primer portal de compras delivery 100% eco lovers, no usamos bolsas o plástico.">
    <meta name="keywords"
          content="Mimercado.delivery, delivery en Trujillo, frutas en casa, frutas en Trujillo, compras en Trujillo, precios bajos, portal de compras, frutas delivery, mercado en Trujillo, Trujillo frutas, delivery, fruits store, store Trujillo, abarrotes, chocolates, bebidas, manzanas, uvas, fresas, papayas, atunes, aceite, cerveza, tragos, frutas, la Hermelinda, mercado la Hermelinda, la Hermelinda delivery, fast delivery, delivery en Trujillo, precios bajos, mercado a tu casa, abarrotes delivery, frutas de calidad, verduras de calidad, pago seguro, aceptamos tarjetas, visa, mastercard, compra on line, pagos on line, delivery on line, Delivery de frutas en Trujillo, portal de compras, mercado on line en Trujillo, abarrotes delivery, frutas de calidad, pago seguro, visa, MasterCard, compra on line, Precios bajos, bebidas, frutas, mercado a tu casa, delivery seguro, pagos on line, Fruit store, Delivery confiable, delivery confiable de frutas, vida sana, vegetarianos, vegetarianos Trujillo, vegano, compras mayoristas, juguería, frutería Trujillo, frutería, frutas frescas, jugos naturales, ensalada de frutas, frutas selectas, las mejores frutas, abarrotes a tu casa, eco lovers, no bolsas de plástico, entrega de frutas, reparto de frutas, reparto a domicilio, comida de mascotas, fruit Store, abarrotes en casa.">
    <meta name="author" content="MiMercado.delivery">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title') .:. Mi Mercado Delivery .:. </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/iconcart.ico') }}">
    <!-- CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/elegent.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/helper.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/font-rubik.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('files/mprogress.css') }}" rel="stylesheet">
    <link href="{{ asset('files/jquery.loading.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    @yield('css')
    @yield('styles')
    
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-140046733-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-140046733-1');
    </script>
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '342411359807175');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1"
             src="https://www.facebook.com/tr?id=342411359807175&ev=PageView&noscript=1"/>
    </noscript>
</head>

<body>
<!--=============================================
=            Header         =
=============================================-->

@include('web.layouts._header', ['cart_box' => 1])

<!--=====  End of Header  ======-->

@yield('content')

<!--=============================================
=            Footer         =
=============================================-->

@include('web.layouts._footer')

<!--=====  End of Footer  ======-->

<!-- scroll to top  -->
<a href="javascript:void(0)" class="scroll-top"></a>
<!-- end of scroll to top -->

<!-- JS -->
<script src="{{ asset('assets/js/vendor/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('files/mprogress.js') }}"></script>
<script src="{{ asset('files/loadingoverlay.js') }}"></script>
<script src="{{ asset('files/jquery.loading.js') }}"></script>
<script src="{{ asset('files/lazysizes.js') }}"></script>
<script src="{{ asset('files/jquery.jscroll.js') }}"></script>
<script src="{{ asset('assets/js/shopping_init.js') }}"></script>
<script src="{{ asset('assets/js/global.js') }}"></script>
@yield('scripts')
</body>
</html>