@component('mail::message')
# Detalle de tu compra

@component('mail::panel')
    # Datos del Cliente
    Nombres y Apellidos: {{ $user->name ." " . $user->last_name }}
    Email: {{ $user->email }}
    Teléfono: {{ $user->phone }}
@endcomponent

El pedido se realizó en la fecha: {{ $order->created_at->format('d-m-Y') }} <br>
Dirección de entrega: {{ $order->address }} <br>
Urbanización: {{ $order->shippingCost->urbanization }}. <br>
Referencia: {{ $order->reference }}. <br>
El método de pago es: {{ $order->payment_method }} <br>

@component('mail::table')
    | Nombre        | Descripción    | Precio         | Cant.     | Total    |
    | ------------- | :-------------:| :-------------:| :--------:| --------:|
    @foreach(Cart::content() as $row)
        | {{ $row->model->name }} | {{ $row->model->description }} | {{ $row->model->price }} | {{ $row->qty }} | {{ priceInSole($row->subtotal()) }} |
    @endforeach
    | | | | | |
    | SUBTOTAL: | | | {{ priceInSole($subtotal) }} |
    | COSTO DE ENVÍO: | | | {{ priceInSole($shippingCost) }} |
    | DESCUENTO: | | | {{ priceInSole($discount) }} |
    | TOTAL: | | | {{ priceInSole($orderTotal) }} |
@endcomponent

@if($order->payment_method == \App\src\Models\Order::$PAYMENT_METHOD_BANK_TRANSFER)
### Una vez confirmada la transferencia, procederemos con tu despacho. Para ello, te agradeceremos nos envíes un pantallazo de la transferencia realizada por whatsapp al 948313098 o al correo: ventas@mimercado.delivery.
@endif
Cantidades superiores a 1 unidad/kilo/paquete estarán sujetas a disponibilidad. <a href="{{ route('web.footer.terminos') }}" target="_blank">Leer condiciones</a>.

@component('mail::subcopy')
    <div style="text-align: center">
        <img src="{{ asset('assets/images/LOGO_SEGURIDAD.png') }}">
    </div>
@endcomponent

@endcomponent

