@extends('web.pages.footer.layout')

@section('footerTitle')
    Tienda Online
@endsection

@section('footerTitleActive')
    Medios de Pago
@endsection

@section('web.footer.content')
    <h3 class="post-title-2">Medios de Pago</h3>

    <p class="pl-15">
        En mimercado.delivery puedes pagar con cualquiera de los siguientes medios de pago.
    </p>

    <p class="pl-15">
        Pago con Tarjetas de Crédito.
    </p>

    <p class="pl-15">
        Transferencia bancaria.
    </p>

    @include('web.partials._table_payment_method')
@endsection