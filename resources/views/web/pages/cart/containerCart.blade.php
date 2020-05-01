@if (Cart::count() > 0)
    <div class="row">
        <div class="col-12">

            <div id="cart_table" class="cart-table table-responsive mb-40">
                <table class="table">
                    <thead>
                    <tr>
                        <td class="pro-remove"></td>
                        <td></td>
                        <th class="text-left">Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody id="cartItems">
                    @foreach(Cart::content() as $index => $row)
                        <tr>
                            <td class="pro-remove remove-mobile">
                                <button onclick="removeProductInTable('{{$row->rowId}}')">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </td>
                            <td class="pro-thumbnail">
                                <img src="{{ assetImage($row->model->image) }}"
                                     class="img-fluid"
                                     alt="{{$row->model->name}}">
                            </td>
                            <td class="pro-title text-left">
                                {{ $row->model->name }} x {{ $row->model->productUnitMeasure->abrv }}
                            </td>
                            <td class="pro-price display-inline-mobil"><span>{{ priceInSole($row->model->final) }}</span></td>
                            <td class="pro-quantity display-inline-mobil qty-mobil">
                                <div class="pro-qty">
                                    <input type="text" value="{{ $row->qty }}"
                                           required
                                           min="1"
                                           max="1500"
                                           maxlength="50"
                                           name="qty"
                                           oninput="
                                           this.value = this.value.replace(/[^0-9.]/g, '');
                                           this.value = this.value.replace(/(\..*)\./g, '$1');"
                                           id="qty_table_{{$row->model->id}}"
                                           onkeyup = "updateActual('{{ $row->rowId }}', '{{ $row->model->id }}','{{ $row->model->productScale->name }}')" 
                                    >
                                    <button class="inc qty-btn" id="inc"
                                            onclick="updateIncCart('{{ $row->rowId }}', '{{ $row->model->id }}','{{ $row->model->productScale->name }}')">+
                                    </button>
                                    <button class="dec qty-btn" id="dec"
                                            onclick="updateDecCart('{{ $row->rowId }}', {{ $row->model->id }})">-
                                    </button>
                                </div>
                            </td>
                            <td class="pro-subtotal display-inline-mobil"><span>{{ priceInSole($row->subtotal) }}</span></td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr class="bg-gray">
                        <td colspan="100%" class="text-left">
                            <button type="button" class="empty-cart-btn"
                                    data-toggle="modal"
                                    data-target="#overlay-remove-cart">
                                VACIAR CARRITO
                            </button>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>

            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="discount-coupon">
                        <h4>Cupón de descuento:</h4>

                        <form action="{{ route('web.cart.coupon.store') }}" method="POST">
                            {{ csrf_field() }}
                            @if(!session()->has('coupon'))
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-25">
                                        <input type="text" placeholder="Escribe tu cupón aquí"
                                               name="code">
                                    </div>
                                    <div class="col-md-6 col-12 mb-25">
                                        <input type="submit" value="APLICAR CUPÓN">
                                    </div>
                                </div>
                            @endif
                        </form>

                        <form action="{{ route('web.cart.coupon.destroy') }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            @if(session()->has('coupon'))
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-25">
                                        <p>
                                            Has registrado un cupón al carrito de compras.
                                            <br>
                                            Código: {{ session()->get('coupon')['code'] }}
                                        </p>
                                    </div>
                                    <div class="col-md-6 col-12 mb-25">
                                        <input type="submit" value="REMOVER">
                                    </div>
                                </div>
                            @endif
                        </form>

                    </div>
                </div>

                <div class="col-lg-6 col-12 d-flex">
                    <div class="cart-summary" id="cart_summary">
                        @include('web.pages.cart.cartSummary')
                    </div>
                </div>

            </div>

        </div>
    </div>
@else
    <div class="row pt-100 pb-100">
        <div class="col text-center">
            <h3 class="negrita">Tu carrito está vacío</h3>
            <p>Navega por las categorías en el sitio o busca tu producto para realizar una compra.</p>
            <a href="{{ url('/') }}" class="single-sale-add-to-cart-btn mt-30">Comenzar a comprar</a>
        </div>
    </div>
@endif