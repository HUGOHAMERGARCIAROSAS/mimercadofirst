@extends('web.layouts.web')
@section('title', 'Contáctenos | ')

@section('content')
    <div class="breadcrumb-area mb-50">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-container">
                        <ul>
                            <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Inicio</a></li>
                            <li class="active">Contacto</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 mb-xs-35">
                    <!--=======  contact page side content  =======-->

                    <div class="contact-page-side-content">
                        <h3 class="contact-page-title" style="text-align: center;">Contáctanos</h3>


                        <div class="singleNuevo-contact-block">
                            <img src="assets\images\icons\Sin título-1.png" alt="">
                        </div>

                        <!--=======  End of single contact block  =======-->

                        <!--=======  single contact block  =======-->

                        <div class="singleNuevo-contact-block">
                            <a href="tel:+51 948 313 098"><img src="assets\images\icons\icon-01.png" alt=""></a>
                            <h4>Llámanos</h4>
                        </div>

                        <!--=======  End of single contact block  =======-->
                        <!--=======  single contact block  =======-->

                        <div class="singleNuevo-contact-block">
                            <a href="https://api.whatsapp.com/send?phone=51948313098&text=%20" target="_blank"><img src="assets\images\icons\icon-02.png" alt=""></a>
                            <h4>Escríbenos</h4>
                        </div>

                        <!--=======  End of single contact block  =======-->
                        <!--=======  single contact block  =======-->

                        <div class="singleNuevo-contact-block">
                            <img src="assets\images\icons\icon-03.png" alt="">
                            <p>ventas@mimercado.delivery</p>
                        </div>

                        <!--=======  End of single contact block  =======-->
                    </div>

                    <!--=======  End of contact page side content  =======-->

                </div>
                <div class="col-lg-9 col-md-8 pl-100 pl-xs-15">
                    <!--=======  contact form content  =======-->

                    <div class="contact-form-content">
                        <h3 class="contact-page-title">Tu opinión es muy importante para nosotros.</h3>

                        <div class="contact-form">
                            <form action="{{ route('web.contact.index') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tipo de consulta <span class="required">*</span></label>
                                            <select name="request_type" >
                                                <option value="Consulta">Consultas</option>
                                                <option value="Felicitaciones">Felicitaciones</option>
                                                <option value="Sugerencias">Sugerencias</option>
                                                <option value="Reclamo">Reclamo</option>
                                                <option value="Otro">Otro</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nombres y Apellidos <span class="required">*</span></label>
                                            <input type="text" name="name" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>N° de documento<span class="required">*</span></label>
                                            <input type="text" name="documento" required="">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>E-mail <span class="required">*</span></label>
                                            <input type="email" name="email" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Teléfono <span class="required">*</span></label>
                                            <input type="text" name="phone" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Comentarios <span class="required">*</span></label>
                                    <textarea name="comment" required></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="g-recaptcha" data-sitekey="6LcqJboUAAAAAGxzYOVfyLINWMtRi7zl8A4Aiv85" required></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="submit" value="submit" class="contact-form-btn" name="submit" style="float:right; margin-right: 80px;">
                                                ENVIAR
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        @if (session()->has('message'))
                            <div class="container mb-20">
                                <div class="row">
                                    <div class="col-lg-12 order-1 mb-sm-35 mb-xs-35">
                                        <div class="comment-section">
                                            <div class="comment-container">
                                                <div class="single-comment success">
                                                    <div class="content">
                                                        <p class="message-success">
                                                            {{ session('message') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>

                    <!--=======  End of contact form content =======-->
                </div>
            </div>
        </div>
    </div>

@endsection