@extends('web.pages.footer.layout')

@section('web.footer.title')
    <h3 class="post-title pb-15">
        Bienvenidos a MiMercado.delivery
    </h3>
@endsection

@section('footerTitle')
    Nosotros
@endsection

@section('footerTitleActive')
    Bienvenidos a MiMercado.delivery
@endsection

@section('web.footer.content')
    <div class="single-blog-post-media mb-xs-20">
        <div class="image">
            <img src="{{ asset('web/img/Logo-MiMercadoDeliveryfinal.jpg') }}" class="img-fluid" alt="Logo MiMercado.delivery">
        </div>
    </div>

    <!--=======  End of Post media  =======-->

    <!--=======  Post content  =======-->

    <div class="post-content mb-40">
        <p>
            MiMercado.delivery somos una empresa online dedicados a la venta al detalle de frutas, abarrotes y productos de consumo masivo en Trujillo de alta calidad y entregarlos donde nuestros clientes lo deseen.
        </p>

        <blockquote>
            <p>
                <span class="negrita">Visión: </span>
                Al 2020, ser el canal de distribución líder para los hogares de nuestra región.
            </p>
        </blockquote>

        <blockquote>
            <p>
                <span class="negrita">Misión: </span>
                Brindamos productos de reconocida calidad y con excelencia en el servicio. Asimismo, mimercado.delivery tiene como objetivo el crecimiento sostenido de sus empresas asociadas y desarrollo profesional de sus colaboradores.
            </p>
        </blockquote>

    </div>
@endsection