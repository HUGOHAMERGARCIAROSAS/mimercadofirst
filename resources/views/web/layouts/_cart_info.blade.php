<p>
    Carrito de compras
    <span>{{ Cart::content()->count() }} items - {{ priceInSole(Cart::subtotal()) }}</span>
</p>