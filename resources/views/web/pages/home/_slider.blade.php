<div class="hero-slider-container mb-15" style="margin-top: -1px;">
    <!--=======  Slider area  =======-->

    <div class="hero-slider-two">
        @foreach($sliders as $item)
            @if ($item->is_advertising)
                <div class="hero-slider-item mobil_slider img_slider_desktop"
                     style="width: 100%;padding: 0 !important;">
                    <a href="javascript:void(0)" tabindex="0" style="display: unset;"
                       data-mobile="{{ assetImage($item->sliderAdvertising->image_mobile) }}"
                       data-desktop="{{ assetImage($item->sliderAdvertising->image_desktop) }}"
                    >
                        <img src="{{ assetImage($item->sliderAdvertising->image_desktop) }}"
                             class="img-fluid"
                             id="img_slider_advertising_{{$item->sliderAdvertising->id}}"
                             style="width: 100%; height: 100%;">
                    </a>
                </div>
            @else
                <div class="hero-slider-item"
                     style="background-image: url({{ assetImage($item->sliderProduct->background) }})">
                    <div class="slider-content d-flex flex-column justify-content-center">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="sale-single-product-container">
                                        <!--=======  sale single product  =======-->
                                        <div class="sale-single-product">
                                            <div class="row">
                                                <div class="col-lg-6 mr-auto">
                                                    <!--=======  sale single product image  =======-->
                                                    <div class="image">
                                                        <a href="javascript:void(0)" tabindex="0" style="height: 300px;"
                                                           id="img_slider_product_mobile">
                                                            <img src="{{ assetImage($item->sliderProduct->product->image) }}"
                                                                 class="img-fluid" alt="{{ __('web.name') }}"
                                                                 style="height: 100%; width: auto;">
                                                        </a>
                                                    </div>
                                                    <!--=======  End of sale single product image  =======-->
                                                </div>

                                                <div class="col-lg-5">
                                                    <div class="sale-single-product-content text-center"
                                                         id="slider_info_product"
                                                         style="margin-top: 60px;">

                                                        <div class=""
                                                             style="background-color: white; border-radius: 50px; padding: 20px 0 10px 0;">
                                                            <h2 class="product-title">
                                                                {{ $item->sliderProduct->product->name }}
                                                            </h2>
                                                            <h2 class="price" style="color: red; font-size: 30px">
                                                                Precio {{ $item->sliderProduct->product->calculatePriceByKg($item->sliderProduct->product) }}
                                                                x {{ $item->sliderProduct->product->productUnitMeasure->abrv }}
                                                            </h2>
                                                        </div>

                                                        <div class="product-feature-details mt-20">
                                                            <div class="cart-buttons mb-20">
                                                                <div class="add-to-cart-btn">
                                                                    <a href="javascript:void(0)"
                                                                       class="single-sale-add-to-cart-btn"
                                                                       tabindex="0"
                                                                       onclick="addProductWithQuantifyToShoppingCartSlider('{{ $item->sliderProduct->product->id }}', '{{ $item->sliderProduct->product->productScale->name }}')"
                                                                    >
                                                                        Agregar
                                                                    </a>
                                                                </div>
                                                                <div class=" pro-qty mr-20"
                                                                     style="width: 73px; border: none;">
                                                                    <input type="text"
                                                                           style="border-radius: 50px; width: 120%;"
                                                                           value="{{ $item->sliderProduct->product->productScale->value }}"
                                                                           min="{{ $item->sliderProduct->product->productScale->value }}"
                                                                           step="{{ $item->sliderProduct->product->productScale->value }}"
                                                                           name="qty"
                                                                           class="mod"
                                                                           id="qty_slider_{{ $item->sliderProduct->product->id }}"
                                                                           data-scale="{{ $item->sliderProduct->product->productScale->name }}"
                                                                           oninput="
                                                                       this.value = this.value.replace(/[^0-9.]/g, '');
                                                                       this.value = this.value.replace(/(\..*)\./g, '$1');"
                                                                           readonly
                                                                    >
                                                                    <a href="javascript:void(0)" class="inc qty-btn"
                                                                       style="border-left: none; border-bottom: none; top: 6px; font-size: 23px;">+</a>
                                                                    <a href="javascript:void(0)" class="dec qty-btn"
                                                                       style="border-left: none; height: 27px; font-size: 23px;">-</a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>