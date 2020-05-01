@extends('web.layouts.web')

@section('content')
    <div class="hero-slider-with-category-container mt-60 mb-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <!--=======  slider left category  =======-->

                    <div class="hero-side-category">
                        <!-- Category Toggle Wrap -->
                        <div class="category-toggle-wrap">
                            <!-- Category Toggle -->
                            <button class="category-toggle"><span class="arrow_carrot-right_alt2 mr-2"></span>
                                {{ $subcategory->name }}
                            </button>
                        </div>

                        <!-- Category Menu -->
                        <nav class="category-menu">
                            <ul>
                                @foreach($subcategory->subCategory2 as $item)
                                    <li>
                                        <a href="{{ route('web.subcategory2.index', [
                                        'slugCategory' => $category->slug,
                                        'slugSubcategory' => $subcategory->slug,
                                        'slug' => $item->slug]) }}"
                                        >{{ $item->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>

                    <!--=======  End of slider left category  =======-->
                </div>

                <div class="col-lg-9 col-md-12">
                    <div class="slider tab-slider mb-35">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="tab-slider-wrapper">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-item nav-link active" id="featured-tab"
                                                   data-toggle="tab" href="#featured" role="tab" aria-selected="true">
                                                    {{ $subcategory2->name }}
                                                </a>
                                            </div>
                                        </nav>

                                        @if (count($products) == 0)
                                            <h3 class="negrita pt-10">No encontramos resultados para tu búsqueda</h3>
                                        @else
                                            <div class="infinite-scroll">
                                                <div class="shop-product-wrap grid row no-gutters">
                                                    @include('web.pages.home.products_list', ['products' => $products, 'col' => "4"])
                                                </div>
                                                {{ $products->links() }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('web/plugins/jquery.jscroll.min.js') }}"></script>
    <script>
        $('ul.pagination').hide();
        $(function () {
            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                loadingHtml: '<div class="container align-center center-block" style="width: 11%"><div class="loader"></div></div>',
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function () {
                    $('ul.pagination').remove();
                }
            });
        });
    </script>
@endsection
