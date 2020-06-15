@extends('admin.layouts.admin')

@section('block-header')
    @component('admin.components.block-header')
        @slot('header_title')Tienda @endslot
        @slot('breadcrumb_item')
            <li class="breadcrumb-item">Pedido</li>
        @endslot
        @slot('breadcrumb_item_active')
            <li class="breadcrumb-item active">Descripción del pedido</li>
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card invoice1">
            <div class="body">
                <div class="invoice-top clearfix">
                    <div class="logo">
                        <img src="{{ asset('assets/frutasencasa/user01.jpg') }}" alt="user"
                             class="rounded-circle img-fluid">
                    </div>
                    <div class="info">
                        <h6>{{ $order->user->name. ' ' . $order->user->last_name }}</h6>
                        <p>
                            {{ $order->user->email }} <br>
                            Telefono: {{ $order->user->phone }} <br>
                            DNI: {{ $order->user->document }}
                        </p>
                        <h6>Dirección de Envío</h6>
                        <p>
                            {{ $order->address }} <br>
                            Urbanizacion: {{ $order->shippingCost->urbanization }} <br>
                            Referencia: {{ $order->reference }}
                        </p>
                        @if($order->payment_method=="Pago Online")
                        <h6>Método de pago</h6>
                        <p>
                            {{ $order->payment_method }} <br>
                        </p>
                        <h3>Datos de la Transaccion</h3>
                        <h6>Marca</h6>
                        <p>
                            {{ $marca }} <br>
                        </p>
                        <h6>Tarjeta</h6>
                        <p>
                            {{ $tarjeta }} <br>
                        </p>
                        <h6>Estado</h6>
                        <p>
                            {{ $estado }} <br>
                        </p>
                        <h6>Fecha y Hora</h6>
                        <p>
                            {{ $order->created_at }} <br>
                        </p>
                        
                        @endif
                    </div>
                    <div class="title">
                        <h4>Pedido #{{ $order->id }}</h4>
                        <p>
                            Fecha: {{ $order->created_at->format('d-m-Y') }}<br>
                        </p>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th style="width: 80px;">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->orderDetail as $index => $detail)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $detail->product->name }}</td>
                                <td>{{ priceInSole($detail->product->final) }}</td>
                                <td>{{ $detail->quantify }}</td>
                                <td>{{ priceInSole($detail->calculateSubtotal($detail)) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="row clearfix">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6 text-right">
                        <p class="m-b-0"><b>Sub-total:</b> {{ priceInSole($subtotal) }}</p>
                        <p class="m-b-0">Descuento: {{ priceInSole($discount) }}</p>
                        <p class="m-b-0">Costo de Envío: {{ priceInSole($shippingCost) }}</p>
                        <h3 class="m-b-0 m-t-10">Total {{ priceInSole($totalOrder) }}</h3>
                    </div>
                    <div class="hidden-print col-md-12 text-right">
                        <hr>
                        <a href="{{ route('admin.order.index') }}" class="btn btn-primary">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
