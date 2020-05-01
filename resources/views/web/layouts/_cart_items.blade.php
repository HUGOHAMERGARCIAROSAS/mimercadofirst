@foreach(Cart::content() as $row)
    <div class="cart-float-single-item d-flex">
        <span class="remove-item">
            <button onclick="removeProductToShoppingCart({{json_encode($row)}})">
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
                {{ str_limit($row->model->name, 15) }} x {{ $row->model->productUnitMeasure->abrv }}
            </p>
            <p class="price"><span class="count">{{ $row->qty }} x</span>
                {{ priceInSole($row->model->final) }}</p>
        </div>
    </div>
@endforeach