@extends('web.layouts.web')

@section('content')
    <div class="breadcrumb-area mb-50">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-container">
                        <ul>
                            <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Inicio</a></li>
                            <li><a href="{{ route('web.recipes.index') }}">Promociones</a></li>
                            <li class="active">Detalle</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="blog-page-container mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-1">
                    <div class="sidebar-area">
                        <div class="sidebar mb-35">
                            <h3 class="sidebar-title">Nuevas Promociones</h3>
                            <div class="block-container">
                                @foreach($lastRecipes as $last)
                                    <div class="single-block d-flex">
                                        <div class="image">
                                            @if ($last->image == null)
                                                <img src="{{ asset('assets/frutasencasa/tips/default.jpg') }}"
                                                     class="img-fluid" alt="{{ __('web.name') }}">
                                            @else
                                                <img src="{{ assetImage($last->image) }}"
                                                     class="img-fluid" alt="{{ __('web.name') }}">
                                            @endif
                                        </div>
                                        <div class="content">
                                            <p><a href="{{ route('web.recipes.detail', ['recipe' => $last]) }}">
                                                    {{ str_limit($last->title, 20) }}</a> <span>{{ $last->date }}</span>
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 order-2 mb-sm-35 mb-xs-35">
                    <div class="blog-single-post-container mb-50">
                        <h3 class="post-title">{{ $recipe->title }}</h3>

                        <div class="post-meta">
                            <p><span><i class="fa fa-calendar"></i> Publicado en: <a
                                            href="javascript:void(0)">{{ $recipe->date }}</a></span></p>
                        </div>

                        <div class="single-blog-post-media mb-xs-20">
                            <div class="image text-center">
                                @if ($recipe->image == null)
                                <img src="{{ asset('assets/frutasencasa/tips/default.jpg') }}" class="img-fluid"
                                     alt="{{ __('web.name') }}">
                                @else
                                    <img src="{{ assetImage($recipe->image) }}" class="img-fluid"
                                         alt="{{ __('web.name') }}">
                                @endif
                            </div>
                        </div>

                        <div class="post-content mb-40">
                            {!! $recipe->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection