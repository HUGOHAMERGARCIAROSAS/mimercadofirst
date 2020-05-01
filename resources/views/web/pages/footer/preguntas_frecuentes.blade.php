@extends('web.pages.footer.layout')

@section('footerTitle')
    Contáctanos
@endsection

@section('footerTitleActive')
    Preguntas frecuentes
@endsection

@section('web.footer.content')
    <h3 class="post-title-2">Preguntas frecuentes</h3>

    <ol class="pl-35 terminos">
        <li><span class="negrita">¿Qué medios de pago puedo usar cuando compro por la tienda virtual?</span> <br>
            <p>
                Será requisito necesario para la adquisición de productos y servicios ofrecidos
                en este sitio, la aceptación de las presentes condiciones y el registro por parte
                del “usuario”, debiendo éste registrarse con un correo electrónico vigente.
            </p>
        </li>
        <li><span class="negrita">¿El envío a domicilio tiene un costo?</span> <br>
            <p>
                Sí, el costo de envío se calcula de acuerdo a la distancia entre la dirección de
                despacho y nuestra tienda, quedando registrado para tus futuras compras.
            </p>
        </li>
        <li><span class="negrita">¿Cuál es el monto de compra mínimo?</span> <br>
            <p>
                El monto de compra mínimo es de 10 soles.
            </p>
        </li>
        <li><span class="negrita">¿Cuál son los horarios para realizar pedido y de entrega?</span> <br>
            <p>
                Los pedidos los puede realizar las 24 horas. <br>
                El horario de entrega preferentemente el mismo día y serán previa coordinación.
            </p>
        </li>
        <li><span class="negrita">¿Puedo realizar una compra para mis familiares?</span> <br>
            <p>
                Sí. El procedimiento es el mismo, solo nos tienes que indicar la dirección de entrega y
                opcionalmente indicarnos la persona que recibirá el pedido.
            </p>
        </li>

        <li><span class="negrita">¿Puedo recoger mi pedido?</span> <br>
            <p>
                Si. Previa coordinación puedes recogerlo completamente en Las Begonias 359. Urb. California.
                Se aplican costos por envío.
            </p>
        </li>

        <li><span class="negrita">Es mi primera vez comprando online. ¿cómo hago?</span> <br>
            <p>
                El proceso es muy sencillo, primero debes revisar las zonas de reparto disponibles
                y empieza a comprar: <br>
                1) Selecciona tus productos y agrégalos al carrito, <br>
                2) Completa tus datos y la dirección de envío, <br>
                3) Elige tu método de entrega y el medio de pago y listo! <br>
            </p>
        </li>

        <li><span class="negrita"> ¿Si no tengo correo puedo comprar en mimercado.delivery?</span> <br>
            <p>
                No. Es necesario tener una cuenta de correo electrónico para poder comprar. Podrías usar la de un
                familiar, pero recuerda que el correo electrónico será tu identificador para todas tus compras.
            </p>
            <p>
                Si no encuentras la respuesta a tu pregunta realiza tu <a href="{{ route('web.contact.index') }}"
                                                                          style="text-decoration: underline;"
                                                                          target="_blank">consulta aquí</a>.
            </p>
        </li>

    </ol>
@endsection