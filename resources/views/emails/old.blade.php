<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Correo Compra - MiMercado.delivery</title>
    <style>
        .row {
            margin-left: -24px;
        }

        @media (min-width: 1200px) {
            [class*="span"] {
                float: left;
                min-height: 1px;
                margin-left: 24px;
            }
        }

        .entry-content .page-title {
            margin-top: -4px;
            margin-bottom: 42px;
            padding-bottom: 18px;
            border-bottom: solid 1px #777777;
            padding: 0 0 24px 0;
            margin: 0;
        }

        .product-options-four table {
            margin-bottom: 8px;
            width: 100%;
        }

        thead {
            border-top: solid 1px #777777;
            border-bottom: solid 1px #777777;
            font-family: 'Open Sans Condensed', Arial, sans-serif;
            font-size: 13px;
            letter-spacing: 0.15em;
            text-transform: uppercase;
        }

        .product-options-four table .name {
            text-align: left;
            padding-left: 0;
        }

        thead th {
            padding: 14px 20px;
            padding-left: 0;
        }

        .product-options-four table .name {
            text-align: left;
            padding-left: 0;
        }

        table td {
            font-size: 12px;
            padding: 14px 0;
            border-bottom: solid 1px #e1e1e1;
            vertical-align: top;
        }

        .span8 {
            width: 648px;
        }
    </style>
</head>
<body>
<div class="site-container">
    <div class="container entry-content">
        <div class="row">
            <div class="span12">
                <h3 class="page-title">Información de la compra | MiMercado.delivery</h3>
                <h4>El pedido se realizó en la fecha: {{ $order->created_at->format('d-m-Y') }}</h4>
                <h4>El pedido se enviará a la siguiente dirección: {{ $order->address }}</h4>
                <h4>Ubicado en la urbanización de {{ $order->shippingCost->urbanization }}.</h4>
                <h4>El método de pago es: {{ $order->payment_method }}</h4>
                <hr>
                <div class="row product-viev">
                    <div class="span8 product-caption">
                        <div class="row product-options-four">
                            <div class="span8">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="name" colspan="4">Productos</th>
                                    </tr>
                                    <tr>
                                        <th class="name">Nombre</th>
                                        <th class="name">Precio</th>
                                        <th class="name">Cantidad</th>
                                        <th class="name">SubTotal</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(Cart::content() as $row)
                                        <tr class="text-center">
                                            <td> {{ $row->model->name }}</td>
                                            <td class="price"> {{ $row->model->price }}</td>
                                            <td class="price"> {{ $row->qty }}</td>
                                            <td class="price"> {{ $row->subtotal() }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="price text-rightext-right" colspan="3">TOTAL: </td>
                                        <td class="price text-center">{{ Cart::subtotal() }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <div class="span8">
                <h4 class="page-title">DATOS DEL CLIENTE</h4>
                <div class="product-viev ">
                    <table>
                        <tbody>
                        <tr>
                            <td class="name"><strong>Nombres y Apellidos</strong></td>
                            <td class="price">{{ $user->name ." " . $user->last_name}}</td>
                        </tr>
                        <tr>
                            <td class="name"><strong>Email</strong></td>
                            <td class="price"> {{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td class="name"><strong>Teléfono</strong></td>
                            <td class="price"> {{ $user->phone }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="span12" style="margin-top: 10px;">
                @if($order->payment_method == \App\src\Models\Order::$PAYMENT_METHOD_BANK_TRANSFER)
                    <h4>
                        EL PEDIDO QUEDARÁ CONFIRMADO UNA VEZ QUE SE VALIDE EL NUMERO DE OPERACIÓN QUE REGISTRASTE.
                    </h4>
                @endif
            </div>

            <hr>

            {{--<div class="container text-center col-12">--}}
                {{--<img src="{{ asset('assets/frutasencasa/logo.png') }}" alt="">--}}
            {{--</div>--}}

        </div>
    </div>
</div>
</body>
</html>

