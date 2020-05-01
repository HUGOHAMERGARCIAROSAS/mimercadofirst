@extends('web.pages.footer.layout')

@section('footerTitle')
    Tienda Online
@endsection

@section('footerTitleActive')
    Servicios de Entrega
@endsection

@section('web.footer.content')
    <h3 class="post-title-2">Servicios de Entrega</h3>

    <p class="pl-15">
        Acceso a comprar las 24 horas en nuestra WEB o aplicaciones IOS o Android; y también puedes hacer tus pedidos
        por nuestra línea telefónica dentro de nuestro horario administrativo. Una vez hecha la compra, nos pondremos en
        contacto para programar la entrega. Contamos con el mejor y más seguro servicio de entrega!
    </p>

    <ul class="pl-35" style="list-style:unset;">
        <li><span class="negrita">Envío a domicilio</span> <br>
            Los pedidos se programarán para que los recibas lo más pronto posible, sin embargo por horarios
            operativos, haremos despachos hasta las 6:00 p.m. Los pedidos posteriores a esa hora se programarán para el
            día siguiente. <br><br>
            El costo de envío es según tarifario que encontrarás al
            momento de realizar la compra, puedes revisarlos <a href="{{ route('web.footer.costoenvio') }}" style="text-decoration: underline;" target="_blank">Aquí</a>.
        </li>
    </ul>
@endsection