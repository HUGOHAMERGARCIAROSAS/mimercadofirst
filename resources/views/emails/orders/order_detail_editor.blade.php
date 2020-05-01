<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100%;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100%;
            }
        }

        @media only screen and (min-width: 769px) {
            .list-products table {
                font-size: 11px !important;
            }

            .list-products table th {
                font-size: 11px !important;
            }

            .list-products table td {
                font-size: 11px !important;
            }

            .display-description {
                display: block !important;
            }

            .info-client tr td p {
                font-size: 14px !important;
            }

            .info-order {
                font-size: 14px !important;
            }

            .font-desktop {
                font-size: 14px !important;
            }

            .title {
                width: 30% !important;
            }

            .description {
                /*width: 20% !important;*/
            }

            .price {
                width: 15% !important;
            }

            .quantify {
                width: 10% !important;
            }

            .total {
                width: 15% !important;
            }
        }
    </style>
</head>
<body style="box-sizing: border-box; background-color: #f5f8fa; color: #74787e; height: 100%; hyphens: auto; line-height: 1.4; margin: 0; -moz-hyphens: auto; -ms-word-break: break-all; width: 100% !important; -webkit-hyphens: auto; -webkit-text-size-adjust: none; word-break: break-word;">
<table class="wrapper" width="100%" cellpadding="0" cellspacing="0"
       style="box-sizing: border-box; background-color: #f5f8fa; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
    <tr>
        <td align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
            <table class="content" width="100%" cellpadding="0" cellspacing="0"
                   style="box-sizing: border-box; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                <tr>
                    <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                        <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0"
                               style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 0 auto; padding: 0; text-align: center; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;">
                            <tr>
                                <td class="content-cell" align="center"
                                    style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 30px 0 0 0;">
                                    <a href="{{ url('/') }}"
                                       style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #bbbfc3; font-size: 19px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 #ffffff;">
                                        <img src="{{ asset('assets/frutasencasa/mail_encabezado.png') }}">
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="body" width="100%" cellpadding="0" cellspacing="0"
                        style="box-sizing: border-box; background-color: #f5f8fa; border-bottom: 1px solid #edeff2; border-top: 1px solid #edeff2; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                        <table class="inner-body" align="center" width="600" cellpadding="0" cellspacing="0"
                               style="box-sizing: border-box; background-color: #ffffff; margin: 0 auto; padding: 0; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;">
                            <!-- Body content -->
                            <tr>
                                <td class="content-cell"
                                    style="box-sizing: border-box; padding: 35px; padding-bottom: 20px;">
                                    <h2 style="box-sizing: border-box; color: #2F3133; font-size: 14px; font-weight: bold; margin-top: 0; text-align: left;">
                                        DETALLE DE TU COMPRA
                                    </h2>

                                    <table class="panel info-client" width="100%" cellpadding="0" cellspacing="0"
                                           style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 0 0 21px;">
                                        <tr>
                                            <td class="panel-content"
                                                style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #edeff2; padding: 16px;">
                                                <table width="100%" cellpadding="0" cellspacing="0"
                                                       style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                                                    <tr>
                                                        <td class="panel-item"
                                                            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 0;">
                                                            <h2 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 14px; font-weight: bold; margin-top: 0; text-align: left;">
                                                                DATOS DEL CLIENTE
                                                            </h2>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="panel-item"
                                                            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 0;">
                                                            <p style="box-sizing: border-box; color: #74787e; font-size: 10px; line-height: 1.5em; margin-top: 0; text-align: left; margin-bottom: 0; padding-bottom: 0;">
                                                                Nombres y
                                                                Apellidos: {{ $user->name ." " . $user->last_name }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="panel-item"
                                                            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 0;">
                                                            <p style="box-sizing: border-box; color: #74787e; font-size: 10px; line-height: 1.5em; margin-top: 0; text-align: left; margin-bottom: 0; padding-bottom: 0;">
                                                                Email: {{ $user->email }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="panel-item"
                                                            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 0;">
                                                            <p style="box-sizing: border-box; color: #74787e; font-size: 10px; line-height: 1.5em; margin-top: 0; text-align: left; margin-bottom: 0; padding-bottom: 0;">
                                                                Teléfono: {{ $user->phone }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>

                                    <p class="info-order"
                                       style="box-sizing: border-box; color: #74787e; font-size: 10px; line-height: 1.5em; margin-top: 0; text-align: left;">
                                        {{--El pedido se realizó en la fecha: {{ $order->created_at->format('d-m-Y') }} <br>--}}
                                        Dirección de entrega: {{ $order->address }} <br>
                                        Urbanización: {{ $order->shippingCost->urbanization }}. <br>
                                        Referencia: {{ $order->reference }}. <br>
                                        El método de pago es: {{ $order->payment_method }} <br>
                                    </p>
                                    <h2 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-weight: bold; margin-top: 0; text-align: left;">
                                    </h2>
                                    <div class="table list-products"
                                         style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                                        <table style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 30px auto; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                                            <thead style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                                            <tr>
                                                <th class="title"
                                                    style="border-box; color: #74787e;font-size: 11px; border-bottom: 1px solid #edeff2; padding-bottom: 8px;text-align: left; width: 30%">
                                                    Nombre
                                                </th>
                                                <th style="font-family: Avenir, Helvetica, sans-serif;font-size: 10px; box-sizing: border-box; color: #74787e; border-bottom: 1px solid #edeff2; padding-bottom: 8px;text-align: left; display: none"
                                                    class="description display-description">
                                                    Descripción
                                                </th>
                                                <th class="price"
                                                    style="font-family: Avenir, Helvetica, sans-serif;font-size: 10px; box-sizing: border-box; color: #74787e; border-bottom: 1px solid #edeff2; padding-bottom: 8px; text-align: center; width: 25%">
                                                    Precio
                                                </th>
                                                <th class="quantify"
                                                    style="font-family: Avenir, Helvetica,sans-serif; font-size: 10px; box-sizing: border-box; color: #74787e; border-bottom: 1px solid #edeff2; padding-bottom: 8px; text-align: center;width:20%">
                                                    Cant.
                                                </th>
                                                <th class="total"
                                                    style="font-family: Avenir, Helvetica, sans-serif;font-size: 10px; box-sizing: border-box; color: #74787e; border-bottom: 1px solid #edeff2; padding-bottom: 8px; text-align: right; width: 25%">
                                                    Total
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                                            @foreach(Cart::content() as $row)
                                                <tr>
                                                    <td style="box-sizing: border-box; font-size: 10px; color: #74787e; line-height: 15px; padding: 3px 0;">
                                                        {{ $row->model->name }}
                                                    </td>
                                                    <td style="box-sizing: border-box;font-size: 10px;  color: #74787e; line-height: 15px; padding: 3px 0; display: none;"
                                                        class="display-description">
                                                        {{ $row->model->description }}
                                                    </td>
                                                    <td style="box-sizing: border-box;font-size: 10px;  color: #74787e; line-height: 15px; padding: 3px 0; text-align: center;">
                                                        {{ priceInSole($row->model->price) }}
                                                    </td>
                                                    <td style="box-sizing: border-box;font-size: 10px;  color: #74787e; line-height: 15px; padding: 3px 0; text-align: center;">
                                                        {{ $row->qty }}
                                                    </td>
                                                    <td style="box-sizing: border-box; font-size: 10px; color: #74787e; line-height: 15px; padding: 3px 0; text-align: right;">
                                                        {{ priceInSole($row->subtotal()) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="5"
                                                    style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0 0 0;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"
                                                    style="box-sizing: border-box; font-size: 10px; color: #74787e; line-height: 15px; padding: 2px 0; text-align: left">
                                                    SUBTOTAL
                                                </td>
                                                <td colspan="2"
                                                    style="box-sizing: border-box;font-size: 10px;  color: #74787e; line-height: 15px; padding: 2px 0; text-align: right;">
                                                    {{ priceInSole($subtotal) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"
                                                    style="box-sizing: border-box; font-size: 10px; color: #74787e; line-height: 15px; padding: 2px 0;">
                                                    COSTO DE ENVÍO
                                                </td>
                                                <td colspan="2"
                                                    style="box-sizing: border-box;font-size: 10px;  color: #74787e; line-height: 15px; padding: 2px 0; text-align: right">
                                                    {{ priceInSole($shippingCost) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"
                                                    style="box-sizing: border-box; font-size: 10px; color: #74787e; line-height: 15px; padding: 2px 0;">
                                                    DESCUENTO
                                                </td>
                                                <td colspan="2"
                                                    style="box-sizing: border-box;font-size: 10px;  color: #74787e; line-height: 15px; padding: 2px 0;text-align: right;">
                                                    {{ priceInSole($discount) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"
                                                    style="box-sizing: border-box;font-size: 10px;  color: #74787e; line-height: 15px; padding: 2px 0;">
                                                    TOTAL
                                                </td>
                                                <td colspan="2"
                                                    style="box-sizing: border-box;font-size: 10px;  color: #74787e; line-height: 15px; padding: 2px 0;text-align: right;">
                                                    {{ priceInSole($orderTotal) }}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    @if($order->payment_method == \App\src\Models\Order::$PAYMENT_METHOD_BANK_TRANSFER)
                                        <h2 class="font-desktop"
                                            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 10px; font-weight: bold; margin-top: 0; text-align: justify;">
                                            Una vez confirmada la transferencia, procederemos con tu despacho. Para
                                            ello, te agradeceremos nos envíes un pantallazo de la transferencia
                                            realizada por whatsapp al 948313098 o al correo: ventas@mimercado.delivery.
                                        </h2>
                                    @endif

                                    <p class="font-desktop colored"
                                       style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 10px; line-height: 1.5em; margin-top: 0; text-align: justify;">
                                        Cantidades superiores a 1 unidad/kilo/paquete estarán sujetas a disponibilidad.
                                        <a href="{{ route('web.footer.terminos') }}" target="_blank">Leer
                                            condiciones</a>.
                                    </p>

                                    <table class="subcopy" width="100%" cellpadding="0" cellspacing="0"
                                           style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; border-top: 1px solid #edeff2; margin-top: 25px; padding-top: 25px;">
                                        <tr style="text-align: center;">
                                            <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                                                <img src="{{ asset('assets/images/LOGO_SEGURIDAD.png') }}">
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                        <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0"
                               style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 0 auto; padding: 0; text-align: center; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;">
                            <tr>
                                <td class="content-cell" align="center"
                                    style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 0;">
                                    <a href="{{ url('/') }}"
                                       style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #bbbfc3; font-size: 19px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 #ffffff;text-align: center;">
                                        <img src="{{ asset('assets/frutasencasa/mail_footer.jpg') }}">
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                        <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0"
                               style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 0 auto; padding: 0; text-align: center; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;">
                            <tr>
                                <td class="content-cell" align="center"
                                    style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 20px;">
                                    <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; line-height: 1.5em; margin-top: 0; color: #aeaeae; font-size: 12px; text-align: center;">
                                        © {{ date('Y') }} <a href="{{ url('/') }}">MiMercado.delivery</a>
                                        Todos los derechos reservados.
                                        Desarrollado por <a href="http://www.pyrusstudio.com/web/" target="_blank">Pyrus
                                            Studio</a>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>