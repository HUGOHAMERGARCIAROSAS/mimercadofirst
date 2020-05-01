@extends('web.layouts.web')
@section('title', 'Valida Usuario |')

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

    <div class="page-content mb-50">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6 mr-auto ml-auto">
                    <form action="{{ route('client.complete-profile') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="login-form">
                            <h4 class="login-title mb-2">VALIDACIÓN DE INFORMACIÓN</h4>
                            <h5 class="mb-30">Hola,
                                <span style="font-weight: bold;">{{auth()->user()->name}}</span>. Para el uso de la
                                plataforma MiMercado.delivery, necesitamos la siguiente información.
                            </h5>
                            <div class="row">
                                <div class="col-md-12 col-12 mb-10">
                                    <label>Nombre completo *</label>
                                    <input class="mb-0" type="text"
                                           name="name"
                                           value="{{ auth()->user()->name }}"
                                           required>
                                </div>
                                <div class="col-md-12 mb-10">
                                    <label for="phone">Teléfono *</label>
                                    <input class="mb-0" id="phone" type="text"
                                           name="phone"
                                           value="{{ old('phone') }}"
                                           oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                           required>
                                </div>
                                <div class="col-md-12 mb-10">
                                    <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                        <input class="form-check-input" type="checkbox" name="acepto" id="acepto">
                                        @include('web.pages.auth._label_terminos_condiciones')
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="register-button btn-block mt-0" style="width: 100%;">
                                        COMPLETAR
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
