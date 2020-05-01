@extends('web.layouts.web_cart')

@section('title', 'Mi carrito |')

@section('content')
    <div class="breadcrumb-area mb-20">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-container">
                        <ul class="">
                            <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Inicio</a></li>
                            <li class="active">Carrito</li>
                        </ul>
                        @if (Auth::check())
                            <div class="pull-right" style="margin-top: -23px;">
                                <a href="{{ route('web.my.account') }}" class="font-weight-bold">Ver Historial</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->has('messageCart'))
        <div class="container mb-20 container-message-in-shopping-cart" id="message_cart">
            <div class="row">
                <div class="col-lg-12 order-1 mb-sm-35 mb-xs-35">
                    <div class="comment-section">
                        <div class="comment-container">
                            <div class="single-comment error">
                                <div class="content">
                                    <p class="message-errors">
                                        {{ $errors->first('messageCart') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($errors->has('messageCoupon'))
        <div class="container mb-20 container-message-in-shopping-cart">
            <div class="row">
                <div class="col-lg-12 order-1 mb-sm-35 mb-xs-35">
                    <div class="comment-section">
                        <div class="comment-container">
                            <div class="single-comment error">
                                <div class="content">
                                    <p class="message-errors">
                                        {{ $errors->first('messageCoupon') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (session('messageCoupon'))
        <div class="container mb-20 container-message-in-shopping-cart">
            <div class="row">
                <div class="col-lg-12 order-1 mb-sm-35 mb-xs-35">
                    <div class="comment-section">
                        <div class="comment-container">
                            <div class="single-comment success">
                                <div class="content">
                                    <p class="message-success">
                                        {{ session('messageCoupon') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="page-section section mb-50">
        <div class="container" id="containerCart">
            @include('web.pages.cart.containerCart')
        </div>
    </div>

    <div class="modal fade remove-cart-product" id="overlay-remove-cart" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="{{ route('web.cart.remove.allProduct') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-body overlay__message text-center">
                        Si continuas se borrarán todos los productos del carrito.
                    </div>
                    <div class="modal-footer">
                        <div class="container text-center" style="padding: 0">
                            <button type="submit" class="blog-readmore-btn">ACEPTAR</button>
                            <button type="button" class="blog-readmore-btn-danger" data-dismiss="modal">CANCELAR
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <input type="hidden" name="{{\App\src\Models\CartRule::$MINIMUM_PURCHASE}}}" id="cart_rule_purchase">
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/shopping_cart.js') }}"></script>
@endsection