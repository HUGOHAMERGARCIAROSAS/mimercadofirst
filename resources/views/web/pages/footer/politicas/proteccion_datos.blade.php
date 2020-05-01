@extends('web.pages.footer.layout')

@section('footerTitle')
    Privacidad y Seguridad
@endsection

@section('footerTitleActive')
    Protección de Datos Personales
@endsection

@section('web.footer.title')
    <h3 class="post-title pb-15">
        Protección de Datos Personales
    </h3>
@endsection

@section('web.footer.content')
    <ol class="pl-35 privacy">
        <li>
            <h5>INFORMACIÓN PARA NUESTROS CLIENTES.</h5>
            <p>
                Los datos personales que el Cliente ha facilitado para la compra de los productos en nuestra tienda
                virtual, son utilizados con la finalidad de ejecutar la relación contractual que lo vincula con nosotros
                y forman parte del banco de datos denominado “Clientes” de MiMercado.Delivery.
                <br><br>
                El Cliente puede ejercer sus derechos de acceso, actualización, inclusión, rectificación, supresión y
                oposición, respecto de sus datos personales en los términos previstos en la Ley N° 29733 – Ley de
                Protección de Datos Personales, y su Reglamento aprobado por el Decreto Supremo N° 003-2013-JUS,
                conforme a lo indicado en el acápite siguiente “Información para el Ejercicio de Derechos ARCO”.
            </p>
        </li>
        <li>
            <h5>INFORMACIÓN PARA EL EJERCICIO DE DERECHOS ARCO</h5>
            <p>
                El titular de los datos personales, para ejercer sus derechos de acceso, actualización, inclusión,
                rectificación, supresión y oposición, o cualquier otro que la ley establezca, deberá presentar una
                solicitud escrita en nuestra oficina principal ubicada en Calle Las Begonias 359 Urbanización California
                – Trujillo, conforme al “Formato Modelo para el Ejercicio de Derechos ARCO” en el horario establecido
                para la atención al público. Se podrán establecer otros canales para tramitar estas solicitudes, lo que
                será informado oportunamente por MiMercado.Delivery.
            </p>
        </li>
        <li>
            <h5>FORMATOS MODELO PARA EL EJERCICIO DE DERECHOS ARCO</h5>
            <p>
                En el siguiente enlace puede descargar los Formatos Modelo para el Ejercicio de Derechos ARCO:
            </p>
            <style>
                a:hover {
                    color: #fff;
                }
            </style>
            <a href="{{ asset('assets/DERECHOS_ARCO.zip') }}"
               class="empty-cart-btn">
                <i class="fa fa-file-archive-o"></i>
                DESCARGAR FORMATOS MODELOS
            </a>
        </li>
    </ol>
@endsection