<a href="javascript:void(0)" class="open_shopping_cart">
    <div class="cart-icon d-inline-block">
        <span><img src="{{asset('assets/images/shop.png')}}" class="img-fluid"></span>
    </div>
    <div class="cart-info d-inline-block" id="cart-info">
        <p>
            Carrito de compras
            <span>{{ Cart::content()->count() }} items - {{ priceInSole(Cart::subtotal()) }}</span>
        </p>
    </div>
</a>

<div class="cart-floating-box cart-floating-box-remove" {{ isset($cart_box) ?: 'id=cart-floating-box' }} >
    @include('web.layouts._cart_floating_box')
</div>