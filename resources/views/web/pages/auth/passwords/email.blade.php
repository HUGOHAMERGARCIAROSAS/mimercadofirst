@extends('web.layouts.web')
@section('title', 'Restablecer Contraseña |')

@section('content')
    <div class="breadcrumb-area mb-50"></div>

    @if($errors->any())
        <div class="blog-page-container mb-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-8 mr-auto ml-auto">
                        <div class="comment-section">
                            <div class="comment-container">
                                <div class="single-comment error">
                                    <div class="content">
                                        <p class="message-errors" style="padding: 10px;">
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

    @if (session('status'))
        <div class="container mb-20">
            <div class="row">
                <div class="col-lg-6 col-md-8 mr-auto ml-auto">
                    <div class="comment-section">
                        <div class="comment-container">
                            <div class="single-comment success">
                                <div class="content">
                                    <p class="message-success" style="padding: 10px;">
                                        {{ session('status') }}
                                    </p>
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
                <div class="col-lg-6 col-md-8 mr-auto ml-auto">
                    <form action="{{ route('password.email') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="login-form">
                            <h4 class="login-title">Restablecer Contraseña</h4>
                            <div class="row">
                                <div class="col-md-12 mb-20">
                                    <p class="text-justify">
                                        Ingrese tu dirección de correo electrónico que utilizó cuando se registró en
                                        <a href="{{ url('/') }}" class="font-italic">MiMercado.delivery</a>. <br>
                                        Le enviaremos un correo electrónico para restablecer su contraseña.
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Email*</label>
                                    <input class="mb-0" type="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           placeholder="Email">
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="register-button mt-0" style="width: 100%;">Enviar
                                    </button>
                                </div>
                                <div class="offset-6 col-md-6 mt-10 mb-20 text-left text-md-right">
                                    <a href="{{ route('login') }}">¿Conoce su contraseña?</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection