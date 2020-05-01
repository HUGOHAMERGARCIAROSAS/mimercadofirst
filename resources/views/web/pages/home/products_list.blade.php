@foreach($products as $item)
    <div class="col-xl-{{$col}} col-lg-{{$col}} col-md-6 col-sm-6 col-12">
        <div class="gf-product shop-grid-view-product"
             id="shop_grid_view_product_{{$item->id}}" style="height: 460px">
            <div class="image" style="height: 235px; width: 100%; display: flex;">
                <div style="display: table-cell;vertical-align: middle; width: 100%;">
                    <img src="{{ asset('assets/images/loading.gif') }}"
                         data-src="{{ assetImage($item->image) }}"
                         class="img-fluid lazyload"
                         alt="{{$item->slug}}" style="height: 100%; width: auto;">
                </div>

                <div class="product-hover-icons">
                    <button class="review"
                            data-id="{{$item->id}}"
                            data-tooltip="Vista Rápida"
                            data-toggle="modal"
                            data-target="#quick_view_modal_container_{{ $item->id }}"
                    >
                        <i class="icon_search"></i>
                    </button>
                </div>
            </div>

            <div class="product-content">
                <div class="product-categories">
                    x {{ $item->productUnitMeasure->abrv }}
                </div>
                <h3 class="product-title" title="{{ $item->name }}">
                    <span>{{ $item->name }}</span>
                </h3>
                <div class="product-categories @if (!$item->description) pt-25 @endif">
                    {{ $item->description }}
                </div>
                <div class="price-box">
                    <span class="discounted-price">{{ $item->calculatePriceByKg($item) }}</span>
                </div>

                @foreach(Cart::content() as $row)
                    @if ($item->id == $row->id)
                        <div class="badge badge-success badge-outlined message-add-product"
                             style="padding: 5px; margin: 7px 0 0 0;"
                             id="badge_success_confirmation_{{$item->id}}">
                            <i class="fa fa-check"></i> Agregado al carrito
                        </div>
                    @endif
                @endforeach

                <div class="badge badge-success badge-outlined message-add-product"
                     style="display: none; padding: 5px; margin: 7px 0 0 0;"
                     id="badge_success_confirmation_{{$item->id}}">
                    <i class="fa fa-check"></i> Agregado al carrito
                </div>
            </div>

            <div class="product-feature-details mt-10">
                <div class="cart-buttons mb-10">
                    <div class="pro-qty mb-xs-10">
                        <input type="text"
                               value="{{ $item->productScale->value }}"
                               min="{{ $item->productScale->value }}"
                               step="{{ $item->productScale->value }}"
                               name="qty_{{$item->id}}"
                               id="qty_{{$item->id}}"
                               data-scale="{{ $item->productScale->name }}"
                                @include('web.pages.home.validate_only_quantify')
                        >

                        <a href="javascript:void(0)" class="inc qty-btn" id="inc">+</a>
                        <a href="javascript:void(0)" class="dec qty-btn" id="dec">-</a>

                    </div>
                    <div class="add-to-cart-btn">
                        <button type="button"
                                onclick="addProductWithQuantifyToShoppingCart('{{$item->id}}', '{{ $item->productScale->name }}')">
                            <i class="fa fa-shopping-cart"></i> AGREGAR
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade quick-view-modal-container"
         id="quick_view_modal_container_{{ $item->id }}"
         tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="background-color: #f4f4f4">
                <div class="modal-body" style="padding-bottom: 0; padding-top: 0">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close"
                            style="position: absolute; top: 10px; right: 10px">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-xs-12"
                             style="background-color: #fff; position: unset">
                            <div class="product-image-slider">
                                <div class="tab-content product-large-image-list"
                                     id="myTabContent">
                                    <div class="tab-pane fade show active"
                                         id="single-slide1" role="tabpanel"
                                         aria-labelledby="single-slide-tab-1">
                                        <!--Single Product Image Start-->
                                        <div class="single-product-img img-full"
                                             style="padding-top: 70px; padding-bottom: 70px">
                                            <img src="{{ assetImage($item->image) }}"
                                                 alt="{{$item->slug}}"
                                                 class="img-fluid">
                                        </div>
                                        <!--Single Product Image End-->
                                    </div>
                                </div>
                                <!--Modal Content End-->
                                <!--Modal Tab Menu Start-->
                                <div class="product-small-image-list">
                                    <div class="nav small-image-slider" role="tablist">
                                    </div>
                                </div>
                                <!--Modal Tab Menu End-->
                            </div>
                            <!-- end of product quickview image gallery -->
                        </div>
                        <div class="col-lg-7 col-md-6 col-xs-12 pt-50"
                             style="position: unset">
                            <div class="product-feature-details">
                                <h2 class="product-title mb-15 negrita pb-15"> {{ $item->name }}</h2>

                                <div class="product-description mb-20">
                                    @if (!empty($item->description))
                                        <p class="" style="border-bottom: none; padding-bottom: 10px;">
                                            {{ $item->description }}
                                        </p>
                                    @endif

                                    <h2 class="product-price mb-15">
                                        <span class="discounted-price"> Precio
                                            <span class="negrita">{{ $item->calculatePriceByKg($item) }}</span></span>
                                        <span class="discounted-price negrita"> x {{ $item->productUnitMeasure->abrv }}</span>
                                    </h2>

                                    <div class="cart-buttons">
                                        <div class="pro-qty mr-10">
                                            <input type="text"
                                                   value="{{ $item->productScale->value }}"
                                                   min="{{ $item->productScale->value }}"
                                                   step="{{ $item->productScale->value }}"
                                                   id="qty_modal_{{$item->id}}"
                                                   name="qty"
                                                   oninput="
                                                       this.value = this.value.replace(/[^0-9.]/g, '');
                                                       this.value = this.value.replace(/(\..*)\./g, '$1');"
                                                   style="background-color: #f4f4f4"
                                                   data-scale="{{ $item->productScale->name }}"
                                                    @include('web.pages.home.validate_only_quantify')
                                            >

                                            <a href="javascript:void(0);" class="inc qty-btn">+</a>
                                            <a href="javascript:void(0);" class="dec qty-btn">-</a>

                                        </div>
                                        <div class="add-to-cart-btn">
                                            <button type="button"
                                                    onclick="addProductWithQuantifyToShoppingCartModal('{{$item->id}}', '{{ $item->productScale->name }}')">
                                                <i class="fa fa-shopping-cart"></i>
                                                AGREGAR AL CARRITO
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end of product quick view description -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach