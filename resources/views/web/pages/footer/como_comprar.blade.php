@extends('web.pages.footer.layout')

@section('footerTitle')
    Nosotros
@endsection

@section('footerTitleActive')
    Cómo Comprar
@endsection

@section('web.footer.content')
    <h3 class="post-title-2">Cómo Comprar</h3>

    <div class="faq-area page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="faq-wrapper">

                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                                aria-expanded="false" aria-controls="collapseOne">
                                            Busca tu producto <span> <i class="fa fa-chevron-down"></i>
												<i class="fa fa-chevron-up"></i> </span>
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                     data-parent="#accordion">
                                    <div class="card-body">
                                        <p>
                                            Te damos las siguientes opciones para que encuentres el producto que buscas.
                                        </p>
                                        <p>
                                            A. Por medio de nuestro buscador: indícanos el producto que necesitas.
                                        </p>
                                        <p>
                                            B. Por medio de nuestro menú: mira las diferentes categorías de productos
                                            que te brindamos.
                                        </p>
                                        <p>
                                            C. Por medio de nuestros banners publicitarios
                                        </p>
                                        <p>
                                            D. Contamos con app´s para Android y IOS.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                                data-target="#collapseTwo" aria-expanded="false"
                                                aria-controls="collapseTwo">
                                            Carrito de compras <span> <i class="fa fa-chevron-down"></i>
												<i class="fa fa-chevron-up"></i> </span>
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                     data-parent="#accordion">
                                    <div class="card-body">
                                        <p>
                                            Si encuentras algún producto que te interese, dale click al botón “Agregar
                                            al carrito” luego puedes continuar buscando otros productos que necesites.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                                data-target="#collapseThree" aria-expanded="false"
                                                aria-controls="collapseThree">
                                            Ver Carrito de Compras <span> <i class="fa fa-chevron-down"></i>
												<i class="fa fa-chevron-up"></i> </span>
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                     data-parent="#accordion">
                                    <div class="card-body">
                                        <p>
                                            Si ya tienes todos los productos
                                            que necesitas, haz clic en el ícono
                                            de Carrito y luego en el botón Ver
                                            Carrito para continuar con la
                                            compra
                                        </p>
                                        <p>
                                            Podrás editar la cantidad de
                                            productos que desees, utilizando
                                            las flechas de (+) o (-). Si deseas
                                            eliminar un producto, solo dale
                                            clic al recuadro en blanco y clic en
                                            el botón Eliminar
                                        </p>
                                        <p>
                                            Finalmente, darle clic al botón
                                            Finalizar Compra, allí se detallará
                                            el costo del flete por la entrega.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFour">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                                data-target="#collapseFour" aria-expanded="false"
                                                aria-controls="collapseFour">
                                            Coordinar tu envío <span> <i class="fa fa-chevron-down"></i>
												<i class="fa fa-chevron-up"></i> </span>
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                     data-parent="#accordion">
                                    <div class="card-body">
                                        <p>
                                            La comunicación es la clave para
                                            el horario de entrega más
                                            adecuado. El lugar de entrega es
                                            el que indicaste al momento que
                                            hiciste tu pedido.
                                        </p>
                                        <p>
                                            Si hay alguna variación, deberás
                                            comunicarlo oportunamente a
                                            nuestras líneas telefónicas antes
                                            del despacho y de ser el caso
                                            asumiendo costos.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFive">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                                data-target="#collapseFive" aria-expanded="false"
                                                aria-controls="collapseFive">
                                            Comprar Ahora<span> <i class="fa fa-chevron-down"></i>
												<i class="fa fa-chevron-up"></i> </span>
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                                     data-parent="#accordion">
                                    <div class="card-body">
                                        <ul style="list-style:unset; padding-left: 17px;">
                                            <li>
                                                Ingresa tu correo electrónico y luego tus datos de identificación.
                                            </li>
                                            <li>
                                                Ingresa tu dirección y opcionalmente indícanos quién recibirá el pedido en
                                                el campo referencias.
                                            </li>
                                            <li>
                                                Para el pago, tienes la opción de: <br>
                                                Pago en línea: con tarjeta de crédito o débito <br>
                                                Pago por transferencia bancaria
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection