@extends('web.layouts.web')
@section('title', 'Iniciar Sesión |')

@section('content')
    <div class="breadcrumb-area mb-50"></div>

    @if($errors->any())
        <div class="blog-page-container mb-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mr-auto ml-auto">
                        <div class="comment-section">
                            <div class="comment-container">
                                <div class="single-comment error">
                                    <div class="content">
                                        <p class="message-errors">
                                            @foreach($errors->all() as $error)
                                                {{ $error }} <br>
                                            @endforeach
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="single-product-tab-section mb-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mr-auto ml-auto">
                    <div class="tab-slider-wrapper">
                        <nav>
                            <div class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" data-toggle="tab" href="#signin" role="tab"
                                   aria-selected="true" style="font-size: 1.1em;">Iniciar Sesión</a>
                                <a class="nav-item nav-link" data-toggle="tab" href="#register" role="tab"
                                   aria-selected="false" style="font-size: 1.1em;">Regístrate</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="signin" role="tabpanel"
                                 aria-labelledby="description-tab">
                                <form method="POST" action="{{ route('login') }}">
                                    {{ csrf_field() }}
                                    <div class="login-form"
                                         style="padding: 0; background-color: transparent; box-shadow: none; -webkit-box-shadow: none;">
                                        <div class="row">
                                            <div class="col-md-12 col-12 mb-10">
                                                <label>E-mail</label>
                                                <input class="mb-0 is-invalid" type="email"
                                                       name="email"
                                                       value="{{ old('email') }}"
                                                       placeholder=""
                                                       required>
                                            </div>

                                            <div class="col-12 mb-10">
                                                <label>Contraseña</label>
                                                <input class="mb-0"
                                                       type="password"
                                                       name="password"
                                                       required>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                                    <input class="form-check-input" type="checkbox" name="remember"
                                                           id="remember_me" {{ old('remember') ? 'checked' : '' }}>
                                                    <label for="remember_me">Recuérdame</label>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                                                <a href="{{ route('password.request') }}"> ¿Olvidó su contraseña?</a>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button type="submit"
                                                                class="register-button mt-0 mb-2 btn-block"
                                                                style="width: 100%;">Ingresar
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <p>o ingresa con: </p>
                                                    </div>
                                                </div>

                                                <div class="row pt-10">
                                                    <div class="col-6">
                                                        <a href="{{ route('client.login-with', ['provider' => \App\src\Util\Constants::PROVIDER_GOOGLE_PLUS]) }}"
                                                           class="register-button btn-block mt-0 bg-googleplus"
                                                           style="width: 100%;">
                                                            <i class="fa fa-google-plus"></i>
                                                            Google +
                                                        </a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="{{ route('client.login-with', ['provider' => \App\src\Util\Constants::PROVIDER_FACEBOOK]) }}"
                                                           class="register-button mt-0 btn-block bg-facceok"
                                                           style="width: 100%;">
                                                            <i class="fa fa-facebook-official"></i>
                                                            Facebook
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="features-tab">
                                <form action="{{ route('register.create') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="login-form"
                                         style="padding: 0; background-color: transparent; box-shadow: none; -webkit-box-shadow: none;">
                                        <div class="row">
                                            <div class="col-md-12 mb-10">
                                                <label>Nombre completo*</label>
                                                <input class="mb-0" type="text"
                                                       name="name"
                                                       value="{{ old('name') }}"
                                                       required>
                                            </div>
                                            <div class="col-md-12 mb-10">
                                                <label>E-mail*</label>
                                                <input class="mb-0" type="email"
                                                       placeholder=""
                                                       name="email"
                                                       value="{{ old('email') }}"
                                                       required>
                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <label>Contraseña* (crea una)</label>
                                                <input class="mb-0" type="password"
                                                       name="password"
                                                       required>
                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <label>Teléfono*</label>
                                                <input class="mb-0" type="telefono"
                                                       name="phone"
                                                       value="{{ old('phone') }}"
                                                       oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                                       required>
                                            </div>
                                            
                                            <div class="col-md-12 mb-10">
                                                <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                                    <input class="form-check-input" type="checkbox" name="acepto"
                                                           id="acepto">
                                                    @include('web.pages.auth._label_terminos_condiciones')
                                                </div>
                                            </div>

                                            <div class="col-12 mb-20">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button type="submit" class="register-button mt-0 btn-block"
                                                                style="width: 100%;">Ingresar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <p class="font-italic" style="font-size: 13px;">
                                                    (*) Datos Obligatorios
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection