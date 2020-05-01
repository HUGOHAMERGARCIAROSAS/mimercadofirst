@extends('web.pages.footer.layout')

@section('web.footer.title')
    <h3 class="post-title pb-15">
        ¿Qué es MiMercado.delivery?
    </h3>
@endsection

@section('footerTitle')
    Nosotros
@endsection

@section('footerTitleActive')
    ¿Qué es MiMercado.delivery?
@endsection

@section('web.footer.content')
    <div class="single-blog-post-media mb-xs-20">
        <div class="image">
            <img src="{{ asset('web/img/design80.png') }}" class="img-fluid" alt="">
        </div>
    </div>

    <div class="post-content mb-40">
        <p>
            Es la primera empresa online con operación activa en Trujillo que desarrolla una exitosa estrategia inicial
            de entrega de frutas y productos de primera necesidad y de la mejor calidad, hasta donde nos indiques.
        </p>
    </div>
@endsection