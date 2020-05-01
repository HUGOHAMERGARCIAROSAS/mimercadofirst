@extends('web.layouts.web')
@section('title', 'Tips y Recetas | ')

@section('content')
    <div class="breadcrumb-area mb-50">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-container">
                        <ul>
                            <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Inicio</a></li>
                            <li class="active">Tips y Recetas</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="blog-page-container mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-post-container">
                        <div class="row">
                            @foreach($tips as $tip)
                                <div class="col-lg-4 col-md-6">
                                    <div class="single-blog-post mb-35" style="height: 497px">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="single-blog-post-media mb-20"
                                                     id="image_tips">
                                                    <div class="image">
                                                        @if($tip->image == null)
                                                            <a href="{{ route('web.tips.detail', $tip) }}">
                                                                <img src="{{ asset('assets/images/loading.gif') }}"
                                                                     data-src="{{ asset('web/img/tip-tabla/default.jpg') }}"
                                                                     class="img-fluid lazyload"
                                                                     alt="{{ __('web.name') }}"
                                                                >
                                                            </a>
                                                        @else
                                                            <a href="{{ route('web.tips.detail', $tip) }}">
                                                                <img src="{{ asset('assets/images/loading.gif') }}"
                                                                     data-src="{{ assetImage($tip->image) }}"
                                                                     class="img-fluid lazyload"
                                                                     alt="{{ __('web.name') }}"
                                                                >
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="single-blog-post-content">
                                                    <h3 class="post-title">
                                                        <a href="{{ route('web.tips.detail', $tip) }}"
                                                           class="{{ addMarginBottom40($tip->title) }}">
                                                            {{ limitText38($tip->title) }}
                                                        </a>
                                                    </h3>
                                                    <div class="post-meta">
                                                        <p>
                                                            <span class="separator"></span>
                                                            <span><i class="fa fa-calendar"></i> Publicado el:
                                                                <a href="javascript:void(0)">{{ $tip->created_at->format('d-m-Y') }}</a>
                                                            </span>
                                                        </p>
                                                    </div>

                                                    <div class="text-center">
                                                        <a href="{{ route('web.tips.detail', $tip) }}"
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

                    @include('web.pagination.default', ['paginator'=> $tips])

                </div>
            </div>
        </div>
    </div>
@endsection
