<div class="cart-items content-cart" style="display: {{ Cart::count() > 0 ? 'block':'none' }} ">
    @include('web.layouts._cart_items')
</div>
<div class="cart-calculation content-cart" style="display: {{ Cart::count() > 0 ? 'block':'none' }} ">
    <div class="calculation-details">
        @include('web.layouts._cart_calculation_details')
    </div>
    <div class="floating-cart-btn text-center">
        <a href="{{ route('web.cart.index') }}" class="btn-block">
            <i class="fa fa-shopping-cart pr-5"></i> Ver Carrito
        </a>
    </div>
    @yield('cart_floating_box_close')
</div>

<div class="cart-calculation text-center empty-cart" style="display: {{ Cart::count() == 0 ? 'block':'none' }}">
    <div class="calculation-details2" style="margin-bottom: 1px solid #ddd;">
        <h4>Tu carrito está vacío</h4>
    </div>
    @yield('cart_floating_box_close_empty')
</div>