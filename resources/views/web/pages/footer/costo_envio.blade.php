@extends('web.pages.footer.layout')

@section('styles')
    <style>
        .myaccount-table table td, .myaccount-table .table td {
            padding: 0 10px !important;
        }
    </style>
@endsection

@section('footerTitle')
    Tienda Online
@endsection

@section('footerTitleActive')
    Costos de envío
@endsection

@section('web.footer.content')
    <h3 class="post-title-2">Costos de envío</h3>

    <p class="pl-15">
        Hacemos todos los esfuerzos para que el costo que pagues sea el más bajo, y será de acuerdo a la distancia entre
        tu dirección de entrega y nuestra tienda.
    </p>
    <p class="pl-15">
        A continuación nuestras tarifas por zona de entrega, considerando que el costo es para una capacidad de la
        maletera (de un auto sedan estándar), todo lo que quepa adecuadamente en ella en peso o volumen.
    </p>
    <p class="pl-15">
        Si tu zona no está en la lista, por favor llámanos o escríbenos al whatsapp para coordinar el costo
        directamente.
    </p>

    <div class="myaccount-table table-responsive text-center">
        <table class="table table-bordered">
            <thead class="thead-light">
            <tr>
                <th width="50%">URBANIZACIÓN</th>
                <th>TARIFARIO</th>
            </tr>
            </thead>

            <tbody>
            @foreach($shippingCost as $item)
                <tr>
                    <td>{{ $item->urbanization }}</td>
                    <td>{{ priceInSole($item->cost) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection