@extends('web.layouts.web')

@section('content')
    @include('web.pages.home._slider')

    @include('web.pages.home._banner')

    <div class="slider tab-slider mb-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-slider-wrapper">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="featured-tab"
                                   data-toggle="tab" href="#featured" role="tab" aria-selected="true">
                                    FRUTAS
                                </a>
                            </div>
                        </nav>
                        <div class="infinite-scroll">
                            <div class="shop-product-wrap grid row no-gutters">
                                @include('web.pages.home.products_list', ['products' => $products, 'col' => "3"])
                            </div>
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('web.pages.home._comentario')
@endsection

@section('scripts')
    <script>
        $(function () {
            $.ajax({
                url: '{{ route('web.home.listSliders') }}',
                method: 'POST',
            }).done((response) => {
                let sliders = response.sliders;
                sliders.forEach(function (currentValue, index, array) {
                    if (currentValue.slider_advertising) {
                        let id = currentValue.slider_advertising.id;
                        let imgMobile = currentValue.slider_advertising.image_mobile;

                        let movilScreen = 767;
                        if (screen.width <= movilScreen) {
                            document.getElementById("img_slider_advertising_" + id).src = "web/" + imgMobile;
                        }
                    }
                });
            }).fail((error) => {
                console.log(error);
            });
        });
    </script>
@endsection
