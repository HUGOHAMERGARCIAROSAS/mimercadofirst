<footer>
    <div class="newsletter-section pt-30 pb-25">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 ">
                    <div class="newsletter-title">
                        <h1>
                            ENTREGAMOS EN TODO TRUJILLO Y SUS ALREDEDORES
                        </h1>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-sm-12 ">
                    <div class="subscription-form-wrapper d-flex flex-wrap flex-sm-nowrap">
                        <div class="subscription-form">
                            <form class="subscribe-form" action="{{ route('web.subscriber.store') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="email" autocomplete="off"
                                       name="email"
                                       placeholder="Ingresa tu e-mail"
                                       required>
                                <button type="submit"> SUSCRIBIR</button>
                            </form>

                            <div class="mailchimp-alerts">
                                @if ($errors->has('email'))
                                    <div class="mailchimp-error">
                                        <span class="badge badge-danger">
                                            {{ $errors->first('email') }}
                                        </span>
                                    </div>
                                @endif

                                @if(session()->has('messageSubscriber'))
                                    <div class="mailchimp-success">
                                        <span class="badge badge-success">
                                            {{ session()->get('messageSubscriber') }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="social-contact-section pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 order-2 order-md-2 order-sm-2 order-lg-1">
                    <div class="social-media-section">
                        <h2>Disponible en:</h2>
                            <img src="assets/images/logo01.png">
                            <a href=""></a>
                            <a href=""></a>
                            <img src="assets/images/logo02.png">
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 order-1 order-md-1 order-sm-1 order-lg-2  mb-sm-50 mb-xs-50">
                    <!--=======  contact summery  =======-->

                    <div class="contact-summery">
                        <h2>Contáctanos</h2>

                        <!--=======  contact segments  =======-->

                        <div class="contact-segments d-flex justify-content-between flex-wrap flex-lg-nowrap">
                            <!--=======  single contact  =======-->

                            <div class="single-contact d-flex mb-xs-20">
                                <div class="icon">
                                    <span class="icon_pin_alt"></span>
                                </div>
                                <div class="contact-info">
                                    <p>Dirección: <span>
                                            <a href="https://www.google.com/maps/@-8.0903942,-79.0247861,18.07z"
                                               target="_blank">Trujillo – Perú
                                            </a></span>
                                    </p>
                                </div>
                            </div>

                            <!--=======  End of single contact  =======-->
                            <!--=======  single contact  =======-->

                            <div class="single-contact d-flex mb-xs-20">
                                <div class="icon">
                                    <i class="fa fa-whatsapp"></i>
                                </div>
                                <a href="https://api.whatsapp.com/send?phone=51948313098&text=%20" target="_blank"><div class="contact-info">
                                    <p>Delivery: <span>{{ __('web.phone') }}</span></p>
                                </div></a>
                            </div>

                            <!--=======  End of single contact  =======-->
                            <!--=======  single contact  =======-->

                            <div class="single-contact d-flex">
                                <div class="icon">
                                    <span class="icon_mail_alt"></span>
                                </div>
                                <div class="contact-info">
                                    <a
                                                    href="{{ route('web.contact.index') }}"><p>Email: <span>ventas@mimercado.delivery</span>
                                    </p></a>
                                </div>
                            </div>

                            <!--=======  End of single contact  =======-->
                        </div>

                        <!--=======  End of contact segments  =======-->


                    </div>

                    <!--=======  End of contact summery  =======-->

                </div>
            </div>
        </div>
    </div>

    <!--=======  End of social contact section  =======-->

    <!--=======  footer navigation  =======-->

    <div class="footer-navigation-section pt-40 pb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-xs-30">
                    <!--=======  single navigation section  =======-->

                    <div class="single-navigation-section">
                        <a href="{{ url('/') }}" class="text-center">
                            <img src="{{ asset('assets/frutasencasa/logofooter.png') }}" class="img-fluid" alt="">
                            <img src="{{ asset('assets/images/LOGO_SEGURIDAD.png') }}" class="img-fluid pt-5" alt="">
                        </a>
                    </div>

                    <!--=======  End of single navigation section  =======-->
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-xs-30">
                    <!--=======  single navigation section  =======-->

                    <div class="single-navigation-section">
                        <h3 class="nav-section-title">Nosotros</h3>
                        <ul>
                            <li><a href="{{ route('web.footer.welcome') }}">Bienvenidos a mimercado.delivery</a></li>
                            <li><a href="{{ route('web.footer.mimercado') }}">¿Qué es mimercado.delivery?</a></li>
                            <li><a href="{{ route('web.footer.beneficios') }}">Beneficios</a></li>
                            <li><a href="{{ route('web.footer.comocomprar') }}">Cómo Comprar</a></li>
                            <li><a href="{{ route('web.footer.welcome') }}">Quienes Somos</a></li>
                        </ul>
                    </div>

                    <!--=======  End of single navigation section  =======-->
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-xs-30">
                    <!--=======  single navigation section  =======-->

                    <div class="single-navigation-section">
                        <h3 class="nav-section-title">Tienda Online</h3>
                        <ul>

                            <li><a href="{{ route('web.footer.costoenvio') }}">Costos de Envío</a></li>
                            <li><a href="{{ route('web.footer.mediopago') }}">Medios de Pago</a></li>
                            <li><a href="{{ route('web.footer.serviciosentrega') }}">Servicios de Entrega</a></li>

                        </ul>
                    </div>

                    <!--=======  End of single navigation section  =======-->
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <!--=======  single navigation section  =======-->

                    <div class="single-navigation-section">
                        <h3 class="nav-section-title">Contáctanos</h3>
                        <ul>
                            <li><a href="{{ route('web.footer.terminos') }}">Términos y Condiciones</a></li>
                            <li><a href="{{ route('web.footer.politicasDePrivacidad') }}">Políticas de privacidad</a></li>
                            <li><a href="{{ route('web.footer.preguntasFrecuentes') }}">Preguntas Frecuentes</a></li>
                            <li><a href="{{ route('web.contact.index') }}">Consultas y Sugerencias</a></li>
                            <li><a href="{{ asset('web/img/design12.png') }}" class="popup-link">Teléfonos</a></li>
                        </ul>
                    </div>

                    <!--=======  End of single navigation section  =======-->
                </div>
            </div>
        </div>
    </div>

    <!--=======  End of footer navigation  =======-->


    <!--=======  copyright section  =======-->

    <div class="copyright-section pt-35 pb-10 text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="color-white">PAGA CON: </p>
                </div>
            </div>

            <div class="row pt-15">
                <div class="col-lg-12">
                    <ul class="ul-horizontal">
                        <li><img src="{{ asset('assets/frutasencasa/tarjetas/visa.png') }}" alt="visa"></li>
                        <li><img src="{{ asset('assets/frutasencasa/tarjetas/mc.png') }}" alt="visa"></li>
                        <li><img src="{{ asset('assets/frutasencasa/tarjetas/diners.png') }}" alt="visa"></li>
                        <li><img src="{{ asset('assets/frutasencasa/tarjetas/amex.png') }}" alt="visa"></li>
                        <li><img src="{{ asset('assets/frutasencasa/tarjetas/up.png') }}" alt="visa"></li>
                        <li><img src="{{ asset('assets/frutasencasa/tarjetas/ripley.png') }}" alt="visa"></li>
                        <li><img src="{{ asset('assets/frutasencasa/tarjetas/cmr.png') }}" alt="visa"></li>
                        <li><img src="{{ asset('assets/frutasencasa/tarjetas/oh.png') }}" alt="visa"></li>
                        <li><img src="{{ asset('assets/frutasencasa/tarjetas/cencosud.png') }}" alt="visa"></li>
                        <li><img src="{{ asset('assets/frutasencasa/tarjetas/presta.png') }}" alt="visa"></li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <ul class="ul-horizontal">
                        <li><img src="{{ asset('assets/frutasencasa/tarjetas/bcp.png') }}" alt="visa"></li>
                        <li><img src="{{ asset('assets/frutasencasa/tarjetas/bbva.png') }}" alt="visa"></li>
                        <li><img src="{{ asset('assets/frutasencasa/tarjetas/interbank.png') }}" alt="visa"></li>
                        <li><img src="{{ asset('assets/frutasencasa/tarjetas/scotiabank.png') }}" alt="visa"></li>
                        <li><img src="{{ asset('assets/frutasencasa/tarjetas/banbif.png') }}" alt="visa"></li>
                        <li><img src="{{ asset('assets/frutasencasa/tarjetas/westerunion.png') }}" alt="visa"></li>
                        <li><img src="{{ asset('assets/frutasencasa/tarjetas/kasnet.png') }}" alt="visa"></li>
                        <li><img src="{{ asset('assets/frutasencasa/tarjetas/fullcarga.png') }}" alt="visa"></li>
                        <li><img src="{{ asset('assets/frutasencasa/tarjetas/agentedigital.png') }}" alt="visa"></li>
                        <li><img src="{{ asset('assets/frutasencasa/tarjetas/moneygram.png') }}" alt="visa"></li>
                        <li><img src="{{ asset('assets/frutasencasa/tarjetas/caja-arequipa.png') }}" alt="visa"></li>
                    </ul>
                </div>
            </div>

            <div class="row align-items-md-center align-items-sm-center pt-40">
                <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12 text-center">
                    <div class="copyright-segment">
                        <p class="copyright-text" style="font-size: 14px">
                            &copy; 2018 <a href="{{ url('/') }}">MiMercado.delivery</a> Todos los derechos reservados.
                            Desarrollado por <a href="http://www.pyrusstudio.com/web/" target="_blank">Pyrus Studio</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=======  End of copyright section  =======-->
</footer>