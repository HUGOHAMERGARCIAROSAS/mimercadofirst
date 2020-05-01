@extends('web.layouts.web')

@section('content')
    <div class="breadcrumb-area mb-50">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-container">
                        <ul>
                            <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Inicio</a></li>
                            <li>@yield('footerTitle')</li>
                            <li class="active">@yield('footerTitleActive')</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="blog-page-container mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-2 order-lg-1">
                    <div class="sidebar-area">
                        <div class="sidebar mb-35">
                            <h3 class="sidebar-title">Nosotros</h3>
                            <div class="block-container">
                                <div class="single-block d-flex">
                                    <div class="content">
                                        <p><a href="{{ route('web.footer.welcome') }}">
                                                Bienvenidos a MiMercado.delivery</a></p>
                                    </div>
                                </div>
                                <div class="single-block d-flex">
                                    <div class="content">
                                        <p>
                                            <a href="{{ route('web.footer.mimercado') }}">
                                                ¿Qué es MiMercado.delivery?
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                <div class="single-block d-flex">
                                    <div class="content">
                                        <p><a href="{{ route('web.footer.beneficios') }}">Beneficios</a></p>
                                    </div>
                                </div>
                                <div class="single-block d-flex">
                                    <div class="content">
                                        <p>
                                            <a href="{{ route('web.footer.comocomprar') }}">
                                                Cómo Comprar
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar mb-35">
                            <h3 class="sidebar-title">TIENDA ONLINE</h3>
                            <div class="block-container">
                                <div class="single-block d-flex">
                                    <div class="content">
                                        <p>
                                            <a href="{{ route('web.footer.costoenvio') }}">
                                                Costos de envío
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                <div class="single-block d-flex">
                                    <div class="content">
                                        <p>
                                            <a href="{{ route('web.footer.mediopago') }}">
                                                Medios de Pago
                                            </a>
                                        </p>
                                    </div>
                                </div>

                                <div class="single-block d-flex">
                                    <div class="content">
                                        <p>
                                            <a href="{{ route('web.footer.serviciosentrega') }}">
                                                Servicios de Entrega
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar mb-35">
                            <h3 class="sidebar-title">CONTÁCTANOS</h3>
                            <div class="block-container">
                                <div class="single-block d-flex">
                                    <div class="content">
                                        <p>
                                            <a href="{{ route('web.footer.terminos') }}">
                                                Términos y Condiciones
                                            </a>
                                        </p>
                                    </div>
                                </div>

                                <div class="single-block d-flex">
                                    <div class="content">
                                        <p>
                                            <a href="{{ route('web.footer.preguntasFrecuentes') }}">
                                                Preguntas frecuentes
                                            </a>
                                        </p>
                                    </div>
                                </div>

                                <div class="single-block d-flex">
                                    <div class="content">
                                        <p><a href="{{ route('web.contact.index') }}">Consultas y Sugerencias</a></p>
                                    </div>
                                </div>

                                <div class="single-block d-flex">
                                    <div class="content">
                                        <p>
                                            <a href="{{ route('web.contact.index') }}">
                                                Teléfonos
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar mb-35">
                            <h3 class="sidebar-title">Privacidad y Seguridad</h3>
                            <div class="block-container">
                                <div class="single-block d-flex">
                                    <div class="content">
                                        <p>
                                            <a href="{{ route('web.footer.politicasDePrivacidad') }}">
                                                Políticas de privacidad
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                <div class="single-block d-flex">
                                    <div class="content">
                                        <p>
                                            <a href="{{ route('web.footer.politicasDeCookies') }}">
                                                Políticas de cookies
                                            </a>
                                        </p>
                                    </div>
                                </div>

                                <div class="single-block d-flex">
                                    <div class="content">
                                        <p>
                                            <a href="{{ route('web.footer.protecciónDatosPersonales') }}">
                                                Protección datos personales
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 order-1 order-lg-2 mb-sm-35 mb-xs-35">
                    <div class="blog-single-post-container mb-50">
                        @yield('web.footer.title')

                        @yield('web.footer.content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection