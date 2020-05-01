<header class="fixed-nav-top">
    <!--=======  header top  =======-->

    <div class="header-top pt-10 pb-10 pt-lg-10 pb-lg-10 pt-md-10 pb-md-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 text-center text-sm-left text-lg-right">
                    <!-- currncy language dropdown -->
                    <div class="lang-currency-dropdown" style="color: #000;">
                        <ul>
                            <li>
                                <img src="{{ asset('assets\images\icon-phone.png') }}" class="img-fluid"
                                     alt="{{ __('web.name') }}" style="height: 29px;">
                                Delivery <span class="number negrita" style="font-size: 1.2em;">{{ __('web.phone') }}</span>
                            </li>
                        </ul>
                    </div>
                    <!-- end of currncy language dropdown -->
                </div>
                <div class="col-lg-7 col-md-6 col-sm-6 col-xs-12  text-center text-sm-right">
                    <!-- header top menu -->
                    <div class="header-top-menu">
                        <ul>
                            <li>
                                <a href="{{ route('web.tips.index') }}">TIPS Y RECETAS</a>
                            </li>

                            <li>
                                <a href="{{ route('web.recipes.index') }}">PROMOCIONES</a>
                            </li>

                            <li class="addMarginScroll">
                                <a href="javascript:void(0)" onclick="return openPopUpStoreImage()">VENTAS
                                    MAYORISTAS</a>
                            </li>

                            <li>
                                <a href="{{ route('web.contact.index') }}">CONTÁCTENOS</a>
                            </li>
                        </ul>
                    </div>
                    <!-- end of header top menu -->
                </div>
            </div>
        </div>
    </div>

    <!--=======  End of header top  =======-->

    <!--=======  header bottom  =======-->

    <div class="header-bottom header-bottom-other header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12 col-xs-12 text-lg-left text-md-center text-sm-center">
                    <!-- logo -->
                    <div class="logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('assets/frutasencasa/logo.png') }}" class="img-fluid" alt="">
                        </a>
                    </div>
                    <!-- end of logo -->
                </div>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="menubar-top d-flex justify-content-between align-items-center flex-sm-wrap flex-md-wrap flex-lg-nowrap mt-sm-15">
                        <!-- search bar -->
                        <div class="header-advance-search">
                            <form action="{{ route('web.home.search') }}" method="GET">
                                <input type="text" name="q" placeholder="Busca tu producto aquí">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <!-- end of search bar -->
                        <!-- shopping cart -->
                        <div class="shopping-cart">
                            @include('web.layouts._shoppingCartInHeader')
                        </div>
                    </div>

                    <!--=============================================
                    =            navigation menu         =
                    =============================================-->

                    <!-- navigation section -->
                    <div class="main-menu main-menu-other-homepage main-menu-mobile">
                        <nav>
                            <ul>
                                <li class="active menu-item-has-children">
                                    <a href="{{ route('web.search.productsInCategory',['slugCategory' => \App\src\Models\Category::$CATEGORY_SLUG_FRUTAS]) }}">Frutas</a>
                                    <ul class="mega-menu three-column">
                                        @foreach($categoryFrutas as $item)
                                            <li>
                                                <a href="{{ route('web.search.productsInSubCategory', [
                                                            'slugCategory' => 'frutas',
                                                            'slugSubcategory' => $item->slug]) }}"
                                                >{{ $item->name }}</a>
                                                <ul>
                                                    @foreach($item->productSubCategories as $sub)
                                                        <li class="menu-item-has-children">
                                                            <a href="{{ route('web.search.productsInProductSubCategory', [
                                                                'slugCategory' => 'frutas',
                                                                'slugSubcategory' => $item->slug,
                                                                'slugProductSubCategory' => $sub->slug]) }}"
                                                            >{{ $sub->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="{{ route('web.search.productsInCategory',['slugCategory' => \App\src\Models\Category::$CATEGORY_SLUG_ABARROTES]) }}">Abarrotes</a>
                                    <ul class="mega-menu three-column">
                                        @foreach($categoryAbarrotes as $item)
                                            <li>
                                                <a href="{{ route('web.search.productsInSubCategory', [
                                                            'slugCategory' => 'abarrotes',
                                                            'slugSubcategory' => $item->slug]) }}"
                                                >{{ $item->name }}</a>
                                                <ul>
                                                    @foreach($item->productSubCategories as $sub)
                                                        <li>
                                                            <a href="{{ route('web.search.productsInProductSubCategory', [
                                                                'slugCategory' => 'abarrotes',
                                                                'slugSubcategory' => $item->slug,
                                                                'slugProductSubCategory' => $sub->slug]) }}"
                                                            >{{ $sub->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="menu-item-has-children">
                                    <a href="{{ route('web.search.productsInCategory', ['slugCategory' => \App\src\Models\Category::$CATEGORY_SLUG_BABYS]) }}">Babys - Kids</a>
                                    <ul class="mega-menu three-column">
                                        @foreach($categoryBabys as $item)
                                            <li>
                                                <a href="{{ route('web.search.productsInSubCategory', [
                                                            'slugCategory' => 'babys-kids',
                                                            'slugSubcategory' => $item->slug]) }}"
                                                >{{ $item->name }}</a>
                                                <ul>
                                                    @foreach($item->productSubCategories as $sub)
                                                        <li>
                                                            <a href="{{ route('web.search.productsInProductSubCategory', [
                                                                'slugCategory' => 'babys-kids',
                                                                'slugSubcategory' => $item->slug,
                                                                'slugProductSubCategory' => $sub->slug]) }}"
                                                            >{{ $sub->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="menu-item-has-children">
                                    <a href="{{ route('web.search.productsInCategory', ['slugCategory' => \App\src\Models\Category::$CATEGORY_SLUG_LIMPIEZA]) }}">Limpieza</a>
                                    <ul class="mega-menu three-column">
                                        @foreach($categoryLimpieza as $item)
                                            <li>
                                                <a href="{{ route('web.search.productsInSubCategory', [
                                                    'slugCategory' => 'limpieza',
                                                    'slugSubcategory' => $item->slug]) }}"
                                                >{{ $item->name }}</a>
                                                <ul>
                                                    @foreach($item->productSubCategories as $sub)
                                                        <li class="menu-item-has-children">
                                                            <a href="{{ route('web.search.productsInProductSubCategory', [
                                                                'slugCategory' => 'limpieza',
                                                                'slugSubcategory' => $item->slug,
                                                                'slugProductSubCategory' => $sub->slug]) }}"
                                                            >{{ $sub->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="menu-item-has-children">
                                    <a href="{{ route('web.search.productsInCategory', ['slugCategory' => \App\src\Models\Category::$CATEGORY_SLUG_CUIDADDO_PERSONAL]) }}">Cuidado Personal</a>
                                    <ul class="mega-menu three-column">
                                        @foreach($categoryCuidadoPersonal as $item)
                                            <li>
                                                <a href="{{ route('web.search.productsInSubCategory', [
                                                    'slugCategory' => 'cuidado-personal',
                                                    'slugSubcategory' => $item->slug]) }}"
                                                >{{ $item->name }}</a>
                                                <ul>
                                                    @foreach($item->productSubCategories as $sub)
                                                        <li class="menu-item-has-children">
                                                            <a href="{{ route('web.search.productsInProductSubCategory', [
                                                                'slugCategory' => 'cuidado-personal',
                                                                'slugSubcategory' => $item->slug,
                                                                'slugProductSubCategory' => $sub->slug]) }}"
                                                            >{{ $sub->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="menu-item-has-children">
                                    <a href="{{ route('web.search.productsInCategory', ['slugCategory' => \App\src\Models\Category::$CATEGORY_SLUG_MASCOTAS]) }}">Mascotas</a>
                                    <ul class="mega-menu three-column">
                                        @foreach($categoryMascotas as $item)
                                            <li>
                                                <a href="{{ route('web.search.productsInSubCategory', [
                                                    'slugCategory' => 'mascotas',
                                                    'slugSubcategory' => $item->slug]) }}"
                                                >{{ $item->name }}</a>
                                                @foreach($item->productSubCategories as $sub)
                                                    <ul>
                                                        <li class="menu-item-has-children">
                                                            <a href="{{ route('web.search.productsInSubCategory', [
                                                                'slugCategory' => 'mascotas',
                                                                'slugSubcategory' => $item->slug,
                                                                'slugProductSubCategory' => $sub->slug]) }}"
                                                            >{{ $sub->name }}</a>
                                                        </li>
                                                    </ul>
                                                @endforeach
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="menu-item-has-children">
                                    <a href="{{ route('web.search.productsInCategory', ['slugCategory' => \App\src\Models\Category::$CATEGORY_SLUG_BEBIDAS_LICORES]) }}">Bebidas y Licores</a>
                                    <ul class="mega-menu three-column">
                                        @foreach($categoryLicores as $item)
                                            <li>
                                                <a href="{{ route('web.search.productsInSubCategory', [
                                                    'slugCategory' => 'bebidas-y-licores',
                                                    'slugSubcategory' => $item->slug]) }}"
                                                >{{ $item->name }}</a>
                                                @foreach($item->productSubCategories as $sub)
                                                    <ul>
                                                        <li class="menu-item-has-children">
                                                            <a href="{{ route('web.search.productsInProductSubCategory', [
                                                                'slugCategory' => 'bebidas-y-licores',
                                                                'slugSubcategory' => $item->slug,
                                                                'slugProductSubCategory' => $sub->slug]) }}"
                                                            >{{ $sub->name }}</a>
                                                        </li>
                                                    </ul>
                                                @endforeach
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="menu-item-has-children">
                                    <a href="{{ route('web.search.productsInCategory', ['slugCategory' => \App\src\Models\Category::$CATEGORY_SLUG_OTROS]) }}">Otros</a>
                                    <ul class="mega-menu three-column">
                                        @foreach($categoryOtros as $item)
                                            <li>
                                                <a href="{{ route('web.search.productsInSubCategory', [
                                                    'slugCategory' => 'otros',
                                                    'slugSubcategory' => $item->slug]) }}"
                                                >{{ $item->name }}</a>
                                                @foreach($item->productSubCategories as $sub)
                                                    <ul>
                                                        <li class="menu-item-has-children">
                                                            <a href="{{ route('web.search.productsInProductSubCategory', [
                                                                'slugCategory' => 'otros',
                                                                'slugSubcategory' => $item->slug,
                                                                'slugProductSubCategory' => $sub->slug]) }}"
                                                            >{{ $sub->name }}</a>
                                                        </li>
                                                    </ul>
                                                @endforeach
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>

                            </ul>
                        </nav>
                    </div>
                    <!-- end of navigation section -->
                    <!--=====  End of navigation menu  ======-->
                </div>
                <div class="col-12">
                    <!-- Mobile Menu -->
                    <div class="mobile-menu d-block d-lg-none"></div>
                </div>
            </div>
        </div>

        <!--=============================================
        =            navigation menu         =
        =============================================-->

        <div class="home-other-navigation-menu">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- navigation section -->
                        <div class="main-menu main-menu-other-homepage-remove-mean-bar">
                            <nav>
                                <ul>
                                    <li class="active menu-nav">
                                        <a href="{{ route('web.search.productsInCategory',['slugCategory' => \App\src\Models\Category::$CATEGORY_SLUG_FRUTAS]) }}">Frutas</a>
                                        <ul class="mega-menu mega-menu-nav row">
                                            @foreach($categoryFrutas as $item)
                                                <li class="col-md-2">
                                                    <a href="{{ route('web.search.productsInSubCategory', [
                                                            'slugCategory' => 'frutas',
                                                            'slugSubcategory' => $item->slug]) }}"
                                                    >{{ $item->name }}</a>
                                                    <ul>
                                                        @foreach($item->productSubCategories as $sub)
                                                            <li>
                                                                <a href="{{ route('web.search.productsInProductSubCategory', [
                                                                'slugCategory' => 'frutas',
                                                                'slugSubcategory' => $item->slug,
                                                                'slugProductSubCategory' => $sub->slug]) }}"
                                                                >{{ $sub->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>

                                    <li class="menu-nav">
                                        <a href="{{ route('web.search.productsInCategory',['slugCategory' => \App\src\Models\Category::$CATEGORY_SLUG_ABARROTES]) }}">Abarrotes</a>
                                        <ul class="mega-menu mega-menu-nav row" style="overflow-y: auto; height: 470px">
                                            @foreach($categoryAbarrotes as $item)
                                                <li class="col-md-2">
                                                    <a href="{{ route('web.search.productsInSubCategory', [
                                                            'slugCategory' => 'abarrotes',
                                                            'slugSubcategory' => $item->slug]) }}"
                                                    >{{ $item->name }}</a>
                                                    <ul>
                                                        @foreach($item->productSubCategories as $sub)
                                                            <li>
                                                                <a href="{{ route('web.search.productsInProductSubCategory', [
                                                                'slugCategory' => 'abarrotes',
                                                                'slugSubcategory' => $item->slug,
                                                                'slugProductSubCategory' => $sub->slug]) }}"
                                                                >{{ $sub->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>

                                    <li class="active menu-nav">
                                        <a href="{{ route('web.search.productsInCategory', ['slugCategory' => \App\src\Models\Category::$CATEGORY_SLUG_BABYS]) }}">Babys - Kids</a>
                                        <ul class="mega-menu mega-menu-nav row">
                                            @foreach($categoryBabys as $item)
                                                <li class="col-md-2">
                                                    <a href="{{ route('web.search.productsInSubCategory', [
                                                            'slugCategory' => 'babys-kids',
                                                            'slugSubcategory' => $item->slug]) }}"
                                                    >{{ $item->name }}</a>
                                                    <ul>
                                                        @foreach($item->productSubCategories as $sub)
                                                            <li>
                                                                <a href="{{ route('web.search.productsInProductSubCategory', [
                                                                'slugCategory' => 'babys-kids',
                                                                'slugSubcategory' => $item->slug,
                                                                'slugProductSubCategory' => $sub->slug]) }}"
                                                                >{{ $sub->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>

                                    <li class="menu-nav">
                                        <a href="{{ route('web.search.productsInCategory', ['slugCategory' => \App\src\Models\Category::$CATEGORY_SLUG_LIMPIEZA]) }}">Limpieza</a>
                                        <ul class="mega-menu mega-menu-nav row">
                                            @foreach($categoryLimpieza as $item)
                                                <li class="col-md-2">
                                                    <a href="{{ route('web.search.productsInSubCategory', [
                                                    'slugCategory' => 'limpieza',
                                                    'slugSubcategory' => $item->slug]) }}"
                                                    >{{ $item->name }}</a>
                                                    <ul>
                                                        @foreach($item->productSubCategories as $sub)
                                                            <li>
                                                                <a href="{{ route('web.search.productsInProductSubCategory', [
                                                                'slugCategory' => 'limpieza',
                                                                'slugSubcategory' => $item->slug,
                                                                'slugProductSubCategory' => $sub->slug]) }}"
                                                                >{{ $sub->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>

                                    <li style="position: static;">
                                        <a href="{{ route('web.search.productsInCategory', ['slugCategory' => \App\src\Models\Category::$CATEGORY_SLUG_CUIDADDO_PERSONAL]) }}">Cuidado Personal</a>
                                        <ul class="mega-menu mega-menu-nav row">
                                            @foreach($categoryCuidadoPersonal as $item)
                                                <li class="col-md-2">
                                                    <a href="{{ route('web.search.productsInSubCategory', [
                                                    'slugCategory' => 'cuidado-personal',
                                                    'slugSubcategory' => $item->slug]) }}"
                                                    >{{ $item->name }}</a>
                                                    <ul>
                                                        @foreach($item->productSubCategories as $sub)
                                                            <li>
                                                                <a href="{{ route('web.search.productsInProductSubCategory', [
                                                                'slugCategory' => 'cuidado-personal',
                                                                'slugSubcategory' => $item->slug,
                                                                'slugProductSubCategory' => $sub->slug]) }}"
                                                                >{{ $sub->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>

                                    <li class="menu-nav">
                                        <a href="{{ route('web.search.productsInCategory', ['slugCategory' => \App\src\Models\Category::$CATEGORY_SLUG_MASCOTAS]) }}">Mascotas</a>
                                        <ul class="mega-menu mega-menu-nav row">
                                            @foreach($categoryMascotas as $item)
                                                <li class="col-md-2">
                                                    <a href="{{ route('web.search.productsInSubCategory', [
                                                    'slugCategory' => 'mascotas',
                                                    'slugSubcategory' => $item->slug]) }}"
                                                    >{{ $item->name }}</a>
                                                    <ul>
                                                        @foreach($item->productSubCategories as $sub)
                                                            <li>
                                                                <a href="{{ route('web.search.productsInSubCategory', [
                                                                'slugCategory' => 'mascotas',
                                                                'slugSubcategory' => $item->slug,
                                                                'slugProductSubCategory' => $sub->slug]) }}"
                                                                >{{ $sub->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>

                                    <li class="menu-nav">
                                        <a href="{{ route('web.search.productsInCategory', ['slugCategory' => \App\src\Models\Category::$CATEGORY_SLUG_BEBIDAS_LICORES]) }}">Bebidas y Licores</a>
                                        <ul class="mega-menu mega-menu-nav row">
                                            @foreach($categoryLicores as $item)
                                                <li class="col-md-2">
                                                    <a href="{{ route('web.search.productsInSubCategory', [
                                                    'slugCategory' => 'bebidas-y-licores',
                                                    'slugSubcategory' => $item->slug]) }}"
                                                    >{{ $item->name }}</a>
                                                    <ul>
                                                        @foreach($item->productSubCategories as $sub)
                                                            <li>
                                                                <a href="{{ route('web.search.productsInProductSubCategory', [
                                                                'slugCategory' => 'bebidas-y-licores',
                                                                'slugSubcategory' => $item->slug,
                                                                'slugProductSubCategory' => $sub->slug]) }}"
                                                                >{{ $sub->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>

                                    <li class="menu-nav">
                                        <a href="{{ route('web.search.productsInCategory', ['slugCategory' => \App\src\Models\Category::$CATEGORY_SLUG_OTROS]) }}">Otros</a>
                                        <ul class="mega-menu mega-menu-nav row">
                                            @foreach($categoryOtros as $item)
                                                <li class="col-md-2">
                                                    <a href="{{ route('web.search.productsInSubCategory', [
                                                    'slugCategory' => 'otros',
                                                    'slugSubcategory' => $item->slug]) }}"
                                                    >{{ $item->name }}</a>
                                                    <ul>
                                                        @foreach($item->productSubCategories as $sub)
                                                            <li>
                                                                <a href="{{ route('web.search.productsInProductSubCategory', [
                                                                'slugCategory' => 'otros',
                                                                'slugSubcategory' => $item->slug,
                                                                'slugProductSubCategory' => $sub->slug]) }}"
                                                                >{{ $sub->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>

                                </ul>
                            </nav>
                        </div>
                        <!-- end of navigation section -->
                    </div>
                </div>
            </div>
        </div>

        <!--=====  End of navigation menu  ======-->
    </div>

    <!--=======  End of header bottom  =======-->
</header>
