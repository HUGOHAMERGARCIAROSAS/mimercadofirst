<div class="cart-summary-wrap">
    <h4>Subtotal a Pagar</h4>
    <p>Subtotal 1 <span>{{ priceInSole($cartSubTotal) }}</span></p>
    @if(session()->has('coupon'))
        <p>Descuento <span>{{ priceInSole(session()->get('coupon')['discount']) }}</span></p>
    @endif
    <h2>Subtotal 2 <span>{{ priceInSole($cartTotal) }}</span></h2>
</div>
<div class="cart-summary-button" style="float: right;">
{{--    <a href="{{ route('web.checkout.test') }}" class="buying-btn" style="float: left">MAIL</a>--}}
    <a href="{{ url('/') }}" class="buying-btn" style="float: left">SEGUIR COMPRANDO</a>

    <a href="{{ route('web.checkout.index') }}" class="checkout-btn" style="float: right; margin-left: 10px;">
        FINALIZAR COMPRA
    </a>
</div>