@extends('web.layouts.web')

@section('content')
    <div class="breadcrumb-area mb-50">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-container">
                        <ul>
                            <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Inicio</a></li>
                            <li><a href="{{ route('web.tips.index') }}">Tips y Recetas</a></li>
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
                            <h3 class="sidebar-title">Nuevos Tips</h3>
                            <div class="block-container">
                                @foreach($lastTips as $last)
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
                                            <p>
                                                <a href="{{ route('web.tips.detail', ['tip' => $last]) }}">
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
                        <h3 class="post-title">{{ $tip->title }}</h3>

                        <div class="post-meta">
                            <p>
                                <span><i class="fa fa-calendar"></i> Publicado en: {{ $tip->created_at->format('m-d-Y') }}</span>
                            </p>
                        </div>

                        <div class="single-blog-post-media mb-xs-20">
                            <div class="image text-center">
                                @if ($tip->image === null)
                                    <img src="{{ asset('assets/frutasencasa/tips/default.jpg') }}"
                                         class="img-fluid" alt="{{ __('web.name') }}">
                                @else
                                    <img src="{{ assetImage($tip->image) }}"
                                         class="img-fluid" alt="{{ __('web.name') }}">
                                @endif
                            </div>
                        </div>

                        <div class="post-content mb-40">
                            {!! $tip->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection