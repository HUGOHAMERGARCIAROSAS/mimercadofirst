@extends('web.layouts.web_cart')

@section('title', 'Checkout |')

@section('css')
    <script src="https://checkout.culqi.com/v2"></script>
@endsection

@section('content')
    <div class="breadcrumb-area mb-20">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-container">
                        <ul>
                            <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Inicio</a></li>
                            <li><a href="{{ route('web.cart.index') }}"> Carrito de compras</a></li>
                            <li class="active">Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-section section mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form method="POST" class="checkout-form" id="my_form"
                          action="{{ route('web.checkout.store') }}">
                        {{ csrf_field() }}
                        <div class="row row-40">
                            <div class="col-lg-7">
                                <!-- Billing Address -->
                                <div class="mb-40">
                                    <h4 class="checkout-title">Datos de Envío</h4>

                                    <div class="row">
                                        <div class="col-md-12"><!-- Esta linea era: <div class="col-md-6 col-12"> -->
                                            <div class="form-group row">
                                                <label class="col-md-12 col-3 col-form-label">Nombres*</label>
                                                <div class="col-md-12 col-9">
                                                    <input type="text"
                                                           name="nombres"
                                                           value="{{ $persona->name }}"
                                                           disabled>
                                                </div>
                                            </div>
                                        </div>

                                       <!-- <div class="col-md-6 col-12">
                                            <div class="form-group row">
                                                <label class="col-md-12 col-3 col-form-label">Apellidos*</label>
                                                <div class="col-md-12 col-9">
                                                    <input type="text"
                                                           name="apellidos"
                                                           value="{{ $persona->last_name }}"
                                                           disabled>
                                                </div>
                                            </div>
                                        </div>-->
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group row">
                                                <label class="col-md-12 col-3 col-form-label">Email*</label>
                                                <div class="col-md-12 col-9">
                                                    <input type="email"
                                                           name="email"
                                                           value="{{ $persona->email }}"
                                                           disabled="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group row">
                                                <label class="col-md-12 col-3 col-form-label">Celular*</label>
                                                <div class="col-md-12 col-9">
                                                    <input type="text"
                                                           name="telefono"
                                                           value="{{ $persona->phone }}"
                                                           disabled
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-12 col-3 col-form-label">Dirección*</label>
                                                <div class="col-md-12 col-9">
                                                    <input type="text" name="direccion" required id="direccion">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-12 col-3 col-form-label">Urbanización*</label>
                                                <div class="col-md-12 col-9">
                                                    <select class="nice-select col-xs-6 text-center" name="urbanization"
                                                            id="shipping_cost"
                                                            required>
                                                        <option value="">Seleccione</option>
                                                        @foreach($urbanizations as $item)
                                                            <option value="{{ $item->id }}">{{ $item->urbanization }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="mb-3" ; style="font-size: 13px;"><em>Si no encuentras tu urbanización, llámanos al {{ __('web.phone') }}
                                                            .</em></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="reference" class="col-md-12 col-3 col-form-label">Referencia*</label>
                                                <div class="col-md-12 col-9">
                                                    <input type="text" name="reference" id="reference"
                                                           required
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-10">
                                        <div class="col-12">
                                            <h4 class="checkout-title mb-20 mt-5 container-payment_method">Método de
                                                Pago</h4>

                                            <div class="row">
                                                <div id="mobil_pago" style="width: 100%">
                                                    <div class="col-md-6 text-left" style="float: left;">
                                                        <input type="radio" name="payment_method"
                                                               value="transferencia_Bancaria"
                                                               id="payment_method"
                                                               class="float-left"
                                                               required>
                                                        <label for="payment_method"
                                                               class="float-left font-weight-bold"
                                                               style="margin-left: 3px; font-size: 15px;"
                                                        >
                                                            Transferencia Bancaria
                                                        </label>
                                                    </div>

                                                    <div class="col-md-6" style="float: left;">
                                                        <input type="radio" name="payment_method" value="pago_online"
                                                               id="tarjeta"
                                                               class="float-left"
                                                               required>
                                                        <label for="tarjeta"
                                                               class="float-left font-weight-bold"
                                                               style="margin-left: 3px; font-size: 15px;"
                                                        >
                                                            Tarjeta de Crédito o Débito
                                                        </label>
                                                    </div>
                                                </div>

                                                <div id="mobil_pago_total" style="display: none;">
                                                    <div class="col-md-12" style="padding: 0;">
                                                        <div class="text-center font-weight-bold"
                                                             style="background-color: white; padding: 5px 0; border: 1px solid;">
                                                            <p style="margin-bottom: 0;">TOTAL</p>
                                                            <p>
                                                                S/
                                                                <span id="mobil_pago_total_cart">
                                                                    {{ $cartTotal }}
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="content_bank_transfer hide-important"
                                                 id="content_bank_transfer">
                                                <h4 class="mt-3"><strong>PASO 1:</strong></h4>
                                                <p class="font-weight-bold">Abona el total del monto de tu compra en
                                                    alguna de las siguientes
                                                    cuentas: </p>
                                                @include('web.partials._table_payment_method')
                                                 <div class="row">
                                                    <div class="col-2"><img src="{{ asset('assets/frutasencasa/tarjetas/yape.jpg') }}"
                                                        alt="Yape" style="width: 100%;height:50% "></div>
                                                    <div class="col-8"><h1 style="font-size: 70px;"><strong>948313098</strong> </h1></div>
                                                    <div class="col-2"><img src="{{ asset('assets/frutasencasa/tarjetas/logos.png') }}"
                                                        alt="bancos" style="width: 100%;height:50% " ></div>
                                                  </div>
                                                <h4><strong>PASO 2: &nbsp;</strong>
                                                    <span class="font-weight-bold"
                                                          style="font-size: 14px;color: #666666;">Dar clic en </span>
                                                </h4>
                                                <button type="submit" class="place-order2"
                                                        style="float: none; margin-top: 0;">Finalizar Compra
                                                </button>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="credit_card hide-important" id="credit_card">
                                                <h4 class="mt-3">
                                                    <strong>Pago en Línea</strong>
                                                </h4>
                                                <label class="font-italic" style="font-size: 13px;line-height: 1.5;">
                                                    Los datos son confidenciales y
                                                    por seguridad no los almacenamos en nuestros servidores.</label>

                                                <hr>
                                                <div class="row">
                                                     <?php 
                                                        $tamanio = App\src\Models\Tamanio::find(1);
                                                    ?>
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control"
                                                               placeholder="Escribe el número de tarjeta"
                                                               data-culqi="card[number]"
                                                               id="card[number]"
                                                               name="pagoTarjeta" pattern="^[0-9]+"
                                                               required maxlength="{{$tamanio->nombre}}">
                                                    </div>
                                                    <div class="col-md-4 col-6" style="padding-right: 0;">
                                                        <input type="number" class="form-control"
                                                               placeholder="CVV"
                                                               data-culqi="card[cvv]" id="card[cvv]"
                                                               onkeyup="this.value=this.value.replace(/[^\d]/,'')"
                                                               onKeyPress="if(this.value.length==4) return false;"
                                                               size="4"
                                                               min="0"
                                                               name="pagoCvv" pattern="^[0-9]+"
                                                               required>
                                                    </div>

                                                    <div class="col-md-4 col-3">
                                                        <select class="nice-select checkout-payment"
                                                                name="pagoMmes"
                                                                data-culqi="card[exp_month]" id="card[exp_month]"
                                                                required>
                                                            <option value="01">01</option>
                                                            <option value="02">02</option>
                                                            <option value="03">03</option>
                                                            <option value="04">04</option>
                                                            <option value="05">05</option>
                                                            <option value="06">06</option>
                                                            <option value="07">07</option>
                                                            <option value="08">08</option>
                                                            <option value="09">09</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 col-3" style="padding-left: 0">
                                                        <select class="nice-select checkout-payment"
                                                                name="pagoAno"
                                                                data-culqi="card[exp_year]" id="card[exp_year]"
                                                                required>
                                                            <option value="2020">2020</option>
                                                            <option value="2021">2021</option>
                                                            <option value="2022">2022</option>
                                                            <option value="2023">2023</option>
                                                            <option value="2024">2024</option>
                                                            <option value="2025">2025</option>
                                                            <option value="2026">2026</option>
                                                            <option value="2027">2027</option>
                                                            <option value="2028">2028</option>
                                                            <option value="2029">2029</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 col-6 text-justify text-center"
                                                         style="padding-right: 0">
                                                        <p>Escribe el código de Seguridad (3 o 4 dígitos)</p>
                                                    </div>
                                                    <div class="col-md-8 col-6 text-justify text-center">
                                                        <p>Seleccione <b>Mes</b> y <b>Año</b> de vencimiento de la
                                                            tarjeta</p>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="comment-section mt-10 mb-10 hide-noimportant"
                                                         id="container_culqui_message_error">
                                                        <div class="comment-container">
                                                            <div class="single-comment error">
                                                                <div class="content">
                                                                    <p class="message-errors culqui_message_error"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <h4 class="pt-10 pb-10"><strong>Tarjetas que aceptamos: </strong></h4>
                                                <img src="{{ asset('assets/frutasencasa/logosbancos.png') }}" alt=""
                                                     style="width: 100% !important;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="checkout-title">Total Carrito</h4>
                                        <div class="checkout-cart-total" id="totalCart">
                                            <h4>Productos <span>Total</span></h4>
                                            <ul id="listProducts">
                                                @foreach(Cart::content() as $index => $row)
                                                    <li>{{ str_limit($row->model->name, 24) }} x {{ $row->qty }}
                                                        <span>{{ priceInSole($row->subtotal()) }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <p>Subtotal <span>{{ $cartSubTotal }}</span></p>
                                            <p>Descuento <span>{{ $discount }}</span></p>
                                            <p>Costo de envío <span class="tax">{{ $costOfShipping }}</span></p>
                                            <h4>
                                                Total <span>S/ <span
                                                            id="pagoTotal">{{ $cartTotal }}</span></span>
                                            </h4>
                                        </div>
                                    </div>

                                    <!-- Payment Method -->
                                    <div class="col-12 text-center">
                                        <img src="{{ asset('assets/images/LOGO_SEGURIDAD_2.png') }}" class="img-fluid"
                                             style="margin-top: 20px; margin-bottom: 7px; height: 170px;"
                                             alt="{{ __('web.name') }}, pago seguro">
                                    </div>

                                    <div class="col-12 text-center">
                                        <button type="submit" class="place-order"
                                                id="buyButton"
                                                style="float: none">Finalizar Compra
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" name="pagoEmail"
           data-culqi="card[email]"
           id="card[email]"
           value="{{ $persona->email }}">

@endsection

@section('scripts')
    <script>
        Culqi.publicKey = "pk_live_xxV01evB1z0wu9kL";
        Culqi.init();
    </script>

    <script>
        let cartTotal = $("#pagoTotal").text();
        let totalWithoutDecimals = cartTotal.split('.').join('');
        let valorMetodoDePago = "";

        $("input[name='payment_method']").on('click', function () {
            valorMetodoDePago = $("input[name='payment_method']:checked").val();
            if (valorMetodoDePago === "transferencia_Bancaria") {
                $("#content_bank_transfer").show();
                $("#credit_card").hide();

                requiredNoActiveInCard();
            }

            if (valorMetodoDePago === "pago_online") {
                $("#content_bank_transfer").hide();
                $("#credit_card").show();

                requiredActiveInCard();
            }
        });

        $("#my_form").submit(function (event) {
            event.preventDefault();
            let data = {
                metodoDePago: valorMetodoDePago,
                shipping_cost: $("#shipping_cost").val(),
                direccion: $("#direccion").val(),
                reference: $("input[name='reference']").val(),
            };

            if (valorMetodoDePago === "transferencia_Bancaria") {
                $(".content_bank_transfer").show();
                pagoTransferencia(data);
            }

            if (valorMetodoDePago === "pago_online") {
                Culqi.createToken();
                $('body').loading({
                    message: 'Procesando Compra...'
                });
            }

            return false;
        });

        function culqi() {
            let container_culqui_message_error = $("#container_culqui_message_error");

            if (Culqi.token) {
                let token = Culqi.token.id;
                let email = Culqi.token.email;
                let data = {
                    monto: totalWithoutDecimals,
                    token: token,
                    email: email,
                    metodoDePago: valorMetodoDePago,
                    shipping_cost: $("#shipping_cost").val(),
                    direccion: $("#direccion").val(),
                    reference: $("input[name='reference']").val(),
                };

                $.ajax({
                    url: "{{ route('web.checkout.store') }}",
                    method: 'POST',
                    data: data,
                }).done((response) => {

                    if (response.compraAceptada == true) {
                        window.location.href = "{{ route('web.checkout.confirmation') }}";
                    }

                    if (response.messageErrorCulqui) {
                        if (typeof (response.messageErrorCulqui)) {
                            let obj = JSON.parse(response.messageErrorCulqui);
                            let user_message = obj['user_message'];

                            container_culqui_message_error.show();
                            $(".culqui_message_error").html(user_message);
                        } else {
                            let user_message = response.messageErrorCulqui;
                            container_culqui_message_error.show();
                            $(".culqui_message_error").html(user_message);
                        }

                    }

                    $('body').loading('stop');
                }).fail((error) => {
                    $('body').loading('stop');
                });
            } else {
                container_culqui_message_error.show();
                $(".culqui_message_error").html(Culqi.user_message);
                $('body').loading('stop');
            }
        }

        function initWithMethodPostAndData(data) {
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            let headers = {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
            };

            return init = {
                headers: headers,
                method: 'post',
                credentials: "same-origin",
                body: JSON.stringify(data)
            };
        }

        function pagoTransferencia(data) {
            let loading = $('body').loading({
                message: 'Procesando Compra...'
            });

            fetch("{{ route('web.checkout.storeTransferencia') }}", initWithMethodPostAndData(data))
                .then(response => {
                    return response.json();
                })
                .then((data) => {
                    if (data.compraAceptada === true) {
                        window.location.href = "{{ route('web.checkout.confirmation') }}";
                    }
                    $('body').loading('stop');

                    // console.log(data);
                })
                .catch((error) => {
                    $('body').loading('stop');
                    // console.log(error);
                });
        }

        $("#shipping_cost").on('change', function () {
            let id = $(this).val();

            let data = {
                id: id,
            };

            if (id !== "") {
                $('.checkout-cart-total').loading({
                    message: 'Actualizando...',
                });

                fetch("{{ route('web.checkout.searchUrbanization') }}", initWithMethodPostAndData(data))
                    .then(response => {
                        return response.json();
                    })
                    .then((data) => {
                        let cartTotal = data.cartTotal;
                        $("#mobil_pago_total_cart").html(cartTotal);

                        $(".checkout-cart-total").html(data.viewContainerTotalCart);
                        $('.checkout-cart-total').loading('stop');

                        cartTotal = $("#pagoTotal").text();
                        totalWithoutDecimals = cartTotal.split('.').join('');
                    })
                    .catch((error) => {
                        $('.checkout-cart-total').loading('stop');
                    });
            } else {
                $('.checkout-cart-total').loading({
                    message: 'Seleccione una Urbanización...',
                });
            }
        });


        function requiredActiveInCard() {
            // $("input[name='pagoEmail']").attr("required", true);
            $("input[name='pagoTarjeta']").attr("required", true);
            $("input[name='pagoCvv']").attr("required", true);
            $("input[name='pagoMmes']").attr("required", true);
            $("input[name='pagoAno']").attr("required", true);
        }

        function requiredNoActiveInCard() {
            // $("input[name='pagoEmail']").attr("required", false);
            $("input[name='pagoTarjeta']").attr("required", false);
            $("input[name='pagoCvv']").attr("required", false);
            $("input[name='pagoMmes']").attr("required", false);
            $("input[name='pagoAno']").attr("required", false);
        }

        $(function () {
            let listProductsUL = document.getElementById('listProducts');
            let listProductsHeight = listProductsUL.clientHeight;
            let heightUl = 152;

            if (listProductsHeight >= heightUl) {
                listProductsUL.setAttribute("style", "overflow:auto;height:152px;width:105%");
            }
        });

        function changeMonthInput(value) {
            console.log(value);
        }

        function changeYearInput(value) {
            console.log(value);
        }
    </script>
@endsection
