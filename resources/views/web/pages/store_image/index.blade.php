@extends('web.layouts.web')
@section('title', 'Ventas Mayoristas | ')

@section('content')
    <div class="breadcrumb-area mb-20">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-container">
                        <ul>
                            <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Inicio</a></li>
                            <li class="active">Ventas Mayoristas</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="gallery-type-post mb-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-blog-post-media">
                        <div class="store-images">
                            @foreach($images as $item)
                                <div class="shop-page-banner">
                                    <img src="{{ assetImage($item->image) }}"
                                         alt="{{ $item->slug }}"
                                         class="img-fluid lazyload">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
