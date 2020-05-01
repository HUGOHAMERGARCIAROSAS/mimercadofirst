<button type="button">
    <img src="{{ asset('assets/frutasencasa/shop.png') }}"
         width="39" height="39" alt="cart">
    <span class="badge badge-green">{{ Cart::content()->count() }}</span>
</button>

<div class="cart-floating-box" id="cart-floating-box-fixed">
    @if (Cart::count() > 0)
        <div class="cart-items">
            @foreach(Cart::content() as $row)
                <div class="cart-float-single-item d-flex" style="display: none;">
                    <span class="remove-item">
                        <button onclick="removeProductToShoppingCart('{{$row->rowId}}')">
                            <i class="fa fa-times"></i>
                        </button>
                    </span>

                    <div class="cart-float-single-item-image">
                        <a href="#">
                            <img src="{{ assetImage($row->model->image) }}"
                                 class="img-fluid" alt="">
                        </a>
                    </div>
                    <div class="cart-float-single-item-desc">
                        <p class="product-title">
                            {{ str_limit($row->model->name, 15) }}
                            x {{ $row->model->productUnitMeasure->abrv }}
                        </p>
                        <p class="price">
                            <span class="count">{{ $row->qty }} x</span>
                            {{ priceInSole($row->model->final) }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="cart-calculation">
            <div class="calculation-details">
                <p class="total">Subtotal <span>{{ priceInSole(Cart::subtotal()) }}</span></p>
            </div>
            <div class="floating-cart-btn text-center">
                <a href="{{ route('web.cart.index') }}" class="btn-block">
                    <i class="fa fa-shopping-cart"></i> VER CARRITO
                </a>
            </div>
        </div>
    @else
        <div class="sale-single-product-content text-center">
            <h4 class="product-description">
                Tu carrito está vacío
            </h4>
        </div>
    @endif
</div>