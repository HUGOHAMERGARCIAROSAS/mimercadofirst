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
                                {{ $title }}
                            </button>
                        </div>

                        <!-- Category Menu -->
                        <nav class="category-menu">
                            <ul>
                                @if(empty($subCategory))
                                    @foreach($category->subCategories as $index => $item)
                                        <li>
                                            <a href="{{ route('web.search.productsInSubCategory', ['slugCategory' => $category->slug, 'slugSubcategory' => $item->slug]) }}"
                                            >{{ $item->name }}</a>
                                        </li>
                                    @endforeach
                                @else
                                    @foreach($subCategory->productSubCategories as $item)
                                        <li>
                                            <a href="{{ route('web.search.productsInProductSubCategory', ['slugCategory' => $category->slug,'slugSubcategory' => $subCategory->slug, 'slugProductSubCategory' => $item->slug]) }}"
                                            >{{ $item->name }}</a>
                                        </li>
                                    @endforeach
                                @endif
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
                                                    {{ $title  }}
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
    <script src="{{ asset('assets/js/shopping_index.js') }}"></script>
@endsection
