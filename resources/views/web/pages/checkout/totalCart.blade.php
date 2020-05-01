<h4>Productos <span>Total</span></h4>
<ul>
    @foreach(Cart::content() as $row)
        <li>{{ str_limit($row->model->name, 24) }} x {{ $row->qty }}
            <span>S/ {{ $row->subtotal() }}</span></li>
    @endforeach
</ul>

<p>Subtotal <span>{{ $cartSubTotal }}</span></p>
<p>Descuento <span>{{ $discount }}</span></p>
<p>Costo de envío <span>{{ $costOfShipping }}</span></p>
<h4>
    Total <span>S/ <span id="pagoTotal">{{ $cartTotal }}</span></span>
</h4>
