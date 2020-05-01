@extends('web.layouts.web')
@section('title', 'Iniciar Sesión |')

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
                    <form action="{{ route('password.request') }}" method="POST">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="login-form">
                            <h4 class="login-title">Restablecer Contraseña</h4>
                            <div class="row">
                                <div class="col-md-12 mb-20">
                                    <p class="text-justify">
                                        A continuación ingrese los datos solicitados para restablecer su contraseña.
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Email*</label>
                                    <input class="form-control mb-0" type="email"
                                           name="email"
                                           value="{{ $email or old('email') }}"
                                           placeholder="Email"
                                           required
                                           autofocus
                                    >
                                </div>
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Nueva Contraseña</label>
                                    <input type="password"
                                           class="form-control mb-0"
                                           placeholder="Nueva Contraseña*"
                                           name="password"
                                           required>
                                </div>
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Confirmar Contraseña</label>
                                    <input type="password"
                                           class="form-control mb-0"
                                           placeholder="Confirmar Contraseña*"
                                           name="password_confirmation"
                                           required>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="register-button mt-0" style="width: 100%;">
                                        RESTABLECER
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection