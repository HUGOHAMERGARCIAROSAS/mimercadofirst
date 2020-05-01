@extends('web.layouts._cart_floating_box')

@section('cart_floating_box_close')
    <div class="floating-cart-btn text-center mt-2">
        <a href="javascript:void(0)" class="btn-block close_cart_popup">
            Cerrar
        </a>
    </div>
@endsection

@section('cart_floating_box_close_empty')
    <div class="floating-cart-btn text-center mt-2">
        <a href="javascript:void(0)" class="btn-block close_cart_popup">
            Cerrar
        </a>
    </div>
@endsection