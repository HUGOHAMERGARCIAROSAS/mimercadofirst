@extends('web.layouts.web')
@section('title', 'Promociones | ')

@section('content')
    <div class="breadcrumb-area mb-50">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-container">
                        <ul>
                            <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Inicio</a></li>
                            <li class="active">Promociones</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====  End of breadcrumb area  ======-->


    <!--=============================================
    =            Blog Page Container         =
    =============================================-->

    <div class="blog-page-container mb-50">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <!--=======  blog post container  =======-->
                    <div class="blog-post-container">
                        <div class="row">
                            @foreach($recipes as $recipe)
                                <div class="col-lg-4 col-md-6">
                                    <!--=======  single blog post  =======-->
                                    <div class="single-blog-post mb-35">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="single-blog-post-media mb-20" id="image_tips">
                                                    <div class="image">
                                                        @if ($recipe->image == null)
                                                            <a href="{{ route('web.recipes.detail', $recipe) }}">
                                                                <img src="{{ asset('assets/images/loading.gif') }}"
                                                                     data-src="{{ asset('web/img/recipe/default.jpg') }}"
                                                                     class="img-fluid lazyload"
                                                                     alt="{{ __('web.name') }}">
                                                            </a>
                                                        @else
                                                            <a href="{{ route('web.recipes.detail', $recipe) }}">
                                                                <img src="{{ asset('assets/images/loading.gif') }}"
                                                                     data-src="{{ assetImage($recipe->image)  }}"
                                                                     class="img-fluid lazyload"
                                                                     alt="{{ __('web.name') }}">
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="single-blog-post-content">
                                                    <h3 class="post-title">
                                                        <a href="{{ route('web.recipes.detail', $recipe) }}"
                                                           class="{{ addMarginBottom40($recipe->title) }}">
                                                            {{ limitText38($recipe->title) }}
                                                        </a>
                                                    </h3>
                                                    <div class="post-meta">
                                                        <p><span><i class="fa fa-calendar"></i> Publicado el:
                                                                <a href="javascript:void(0)">{{ $recipe->created_at->format('m-d-Y') }}</a></span>
                                                        </p>
                                                    </div>

                                                    <div class="text-center">
                                                        <a href="{{ route('web.recipes.detail', ['recipe' => $recipe]) }}"
                                                           class="blog-readmore-btn">Ver Más</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @include('web.pagination.default', ['paginator'=> $recipes])
                </div>
            </div>
        </div>
    </div>
@endsection
