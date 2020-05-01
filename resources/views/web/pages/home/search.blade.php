@extends('web.layouts.web')

@section('content')
    <div class="breadcrumb-area mb-20">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-container">
                        <ul>
                            <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Inicio</a></li>
                            <li class="active">Búsqueda: {{ $name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (count($products) > 0 )
        <div class="slider tab-slider mb-35">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-slider-wrapper">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="featured-tab"
                                       data-toggle="tab" href="#featured" role="tab" aria-selected="true" style="font-size: 1em;">
                                        Productos Encontrados
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
    @else
        <div class="container" id="containerCart">
            <div class="row pt-100 pb-100">
                <div class="col text-center">
                    <h3 class="negrita">No encontramos resultados para tu búsqueda</h3>
                    <a href="{{ url('/') }}" class="single-sale-add-to-cart-btn mt-30">Ver Productos</a>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
@endsection
