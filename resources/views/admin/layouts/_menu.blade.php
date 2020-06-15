<div id="left-sidebar" class="sidebar">
    <div class="sidebar-scroll">
        <div class="user-account">
            <img src="{{ asset('admin/pyrus/images/alumno01.jpg') }}" class="rounded-circle user-photo"
                 alt="User Profile Picture">
            <div class="dropdown">
                <span>Bienvenido,</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown">
                    @if (Auth::user()->role == 'admin')
                        <strong>{{ Auth::user()->propietario }}</strong>
                    @endif
                    @if (Auth::user()->role == 'provider')
                        <strong>{{ Auth::user()->razon_social }}</strong>
                    @endif
                    
                    <i class="wi wi-wind-north"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-right account">
                    <li>
                        <a href="{{ url('/') }}" target="_blank" style="font-size: 13px">
                            <i class="fa fa-desktop"></i>
                            MiMercado
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            <i class="icon-power"></i>
                            Salir
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#menu">Menú</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#question"><i
                            class="icon-question"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content p-l-0 p-r-0">
            <div class="tab-pane active" id="menu">
                <nav id="left-sidebar-nav" class="sidebar-nav">
                    <ul id="main-menu" class="metismenu">
                    @if(auth()->user()->role == 'admin')
                        <li>
                            <a href="#" class="has-arrow"><i class="icon-tag"></i>
                                <span>Tienda</span></a>
                            <ul>
                                
                                <li class="{{ ! Route::is('slider.index') ?: 'active' }}">
                                    <a href="{{ route('slider.index') }}">Slider</a></li>
                                <li class="{{ ! Route::is('shipping-cost.index') ?: 'active' }}">
                                    <a href="{{ route('shipping-cost.index') }}">Costo de Envio</a>
                                </li>

                                <li class="{{ !Route::is('admin.users.index') ?: 'active' }}">
                                    <a href="{{ route('admin.users.index') }}">Usuarios</a>
                                </li>
                                <!--
                                <li class="{{ !Route::is('categories.index') ?: 'active' }}">
                                    <a href="{{ route('categories.index') }}">Categoría</a>
                                </li>-->
                            </ul>
                        </li>

                       

                        <li class="{{ ! Route::is('admin.order.index') ?: 'active' }}">
                            <a href="{{ route('admin.order.index') }}"><i class="icon-basket-loaded"></i>
                                Pedidos
                            </a>
                        </li>
                        <!--
                        <li class="{{ !Route::is('tips.index') ?: 'active'}}">
                            <a href="{{ route('tips.index') }}"><i class="icon-home"></i>
                                Tips y Recetas
                            </a>
                        </li>-->

                      
                        <!--
                        <li class="{{ !Route::is('store-image.index') ?: 'active' }}">
                            <a href="{{ route('store-image.index') }}"><i class="icon-home"></i>
                                Ventas Mayoristas
                            </a>
                        </li>-->
                        <!--
                        <li>
                            <a href="{{ route('banners.index') }}"><i class="icon-home"></i>
                                Banner
                            </a>
                        </li>-->
                        <!--
                        <li class="{{ ! Route::is('comments.index') ?: 'active' }}">
                            <a href="{{ route('comments.index') }}"><i class="icon-bubbles"></i>
                                Testimonios
                            </a>
                        </li>-->
                        <li class="{{ ! Route::is('categories_prov.index') ?: 'active' }}">
                            <a href="{{ route('categories_prov.index') }}"><i class="icon-bubbles"></i>
                                Categorias
                            </a>
                        </li>
                        <li class="{{ ! Route::is('admin.providers.index') ?: 'active' }}">
                            <a href="{{ route('admin.providers.index') }}"><i class="icon-user"></i>
                                Proveedores
                            </a>
                        </li>
                        <!--
                        <li class="{{ !Route::is('admin.subscriber.index') ?: 'active' }}">
                            <a href="{{ route('admin.subscriber.index') }}"><i class="icon icon-user-follow"></i>
                                Suscriptores
                            </a>
                        </li>-->

                        {{--<li class="#">--}}
                            {{--<a href="#" class="has-arrow"><i class="icon-grid"></i>--}}
                                {{--<span>Administración</span></a>--}}
                            {{--<ul>--}}
                                {{--<li><a href="{{ route('admin.users.Web') }}">Usuarios Web</a></li>--}}
                                {{--<li><a href="#">Todos los Usuarios</a></li>--}}
                                {{--<li><a href="{{ route('admin.users.rol') }}">Roles</a></li>--}}
                                {{--<li><a href="#">Tu Perfil</a></li>--}}
                                {{--<li><a href="#">Nuevo Usuario</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}

                        {{--<li class="{{ !Route::is('admin.import.index') ?: 'active' }}">--}}
                            {{--<a href="{{ route('admin.import.index') }}"><i class="icon icon-home"></i>--}}
                                {{--Importar--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        @endif
                        @if(auth()->user()->role == 'provider')
                        <li class="{{ !Route::is('recipes.index') ?: 'active'}}">
                            <a href="{{ route('recipes.index') }}"><i class="icon-home"></i>
                                Promociones
                            </a>
                        </li>
                        <li class="{{ ! Route::is('coupons.index') ?: 'active' }}">
                            <a href="{{ route('coupons.index') }}"><i class="icon-tag"></i>Cupones</a></li>
                        <li class="{{ ! Route::is('admin.providers.productos') ?: 'active' }}">
                            <a href="{{ route('products.index') }}"><i class="icon-screen-tablet"></i>
                                Productos</a>
                        </li>
                        <li class="{{ !Route::is('categories.index') ?: 'active' }}">
                            <a href="{{ route('categories.index') }}"><i class="icon-bubbles"></i>Categoría</a>
                        </li>
                        <li class="{{ ! Route::is('admin.providers.pedidos') ?: 'active' }}">
                            <a href="{{ route('admin.providers.pedidos') }}"><i class="icon-basket-loaded"></i>
                                Pedidos
                            </a>
                        </li>
                        @endif
                    </ul>
                    
                </nav>
            </div>
            
            <div class="tab-pane p-l-15 p-r-15" id="question">
                <ul class="right_chat list-unstyled">
                    <li class="menu-heading" style="font-weight: 600; padding-bottom: 10px;">Soporte Técnico</li>

                    <li class="online">
                        <a href="javascript:void(0);">
                            <div class="media">
                                <img class="media-object " src="{{ asset('admin/pyrus/images/ICON01.png') }}" alt="">
                                <div class="media-body">
                                    <span class="name">Pyrus Studio</span>
                                    <span class="message"><a href="https://www.pyrusstudio.com/" target="_blank">www.pyrusstudio.com</a></span>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li class="online" style="padding-bottom: 20px;">
                        <div class="body" style="padding-left: 50px;">
                            Escribenos: <br>
                            info@pyrusstudio.com <br>
                            pyrusstudio@hotmail.com <br>
                            pyrusstudio@outlook.com <br>
                        </div>
                    </li>

                    <li class="online" style="padding-bottom: 20px;">
                        <div class="body" style="padding-left: 50px;">
                            Llamanos: <br>
                            968637864 <br>
                        </div>
                    </li>

                    <li class="online">
                        <a href="javascript:void(0);">
                            <div class="media">
                                <img class="media-object " src="{{ asset('admin/pyrus/images/ICON02.png') }}" alt="">
                                <div class="media-body">
                                    <span class="name">Pyrus HD</span>
                                    <span class="message"><a href="https://pyrushd.com/"
                                                             target="_blank">www.pyrushd.com</a></span>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li class="online" style="padding-bottom: 20px;">
                        <div class="body" style="padding-left: 50px;">
                            Escribenos: <br>
                            soporte@pyrushd.com <br>
                            pyrushd@hotmail.com <br>
                        </div>
                    </li>

                    <li class="online" style="padding-bottom: 20px;">
                        <div class="body" style="padding-left: 50px;">
                            Llamanos: <br>
                            995374822 <br>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>