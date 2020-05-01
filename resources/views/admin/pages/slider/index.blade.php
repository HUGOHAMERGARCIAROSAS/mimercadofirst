@extends('admin.layouts.admin')

@section('css')
    <link href="{{ asset('admin/pyrus/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/pyrus/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/vendor/sweetalert/sweetalert.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/toastr/toastr.min.css') }}">
@endsection

@section('block-header')
    @component('admin.components.block-header')
        @slot('header_title')Slider @endslot
        @slot('breadcrumb_item')
            <li class="breadcrumb-item">Sliders</li>
        @endslot
        @slot('breadcrumb_item_active')
            <li class="breadcrumb-item active">Listado de sliders</li>
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="col-md-12">
        <a href="{{ route('advertising.create') }}"
           class="btn btn-primary btn-lg">
            <i class="fa fa-plus-square"></i> Nuevo Slider (Publicidad)
        </a>
        <a href="{{ route('slider_product.create') }}"
           class="btn btn-success btn-lg">
            <i class="fa fa-plus-square"></i> Nuevo Slider (Con Producto)
        </a>
        <a 
           class="btn btn-danger btn-lg" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-plus-square"></i> Pago Online (Cambiar Estado)
        </a>
    </div>
        
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">PAGO ONLINE</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.cambiar',1)}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                            <div class="col s12 m12">
                                    <span style="color: #4C57A7;"> Estado: </span><br>
                                    <select name="nombre" id="" class="form-control">
                                        <option value="">Seleccione estado</option>
                                        <option value="10">Inhabilitar</option>
                                        <option value="16">Habilitar</option>

                                    </select>
                                </div>
                          </div> <br>
                        <div align="center">
                        <button type="submit" class="btn btn-danger">Guardar</button>
                    </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    <div class="col-md-12 mt-3">
        @include('flash::message')
        <div class="card">
            <div class="body">
                <div class="table-responsive">
                    @component('admin.components.content_datatable')
                        @slot('datatable_header')
                            <tr class="text-center">
                                <th>#</th>
                                <th>Fondo Prod. / Imagen Web</th>
                                <th>Imagen Prod. / Imagen Móvil</th>
                                <th>Es Publicidad</th>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th width="5%">Disponible</th>
                                <th width="5%">Acciones</th>
                            </tr>
                        @endslot

                        @slot('datatable_body')
                            <tbody class="text-center">
                            @foreach($sliders as $index => $item)
                                @if ($item->is_advertising)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>
                                            <a href="{{ assetImage($item->sliderAdvertising->image_desktop) }}"
                                               data-lightbox="image-1">
                                                <img src="{{ assetImage($item->sliderAdvertising->image_desktop) }}"
                                                     width="48">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ assetImage($item->sliderAdvertising->image_mobile) }}"
                                               data-lightbox="image-1">
                                                <img src="{{ assetImage($item->sliderAdvertising->image_mobile) }}"
                                                     width="48">
                                            </a>
                                        </td>
                                        <td>SI</td>
                                        <td>No tiene</td>
                                        <td>No tiene</td>
                                        <td>
                                            <select class="form-control"
                                                    data-id="{{$item->id}}"
                                                    onchange="updateAvailable(this.value, '{{ $item->id }}', '{{ route('admin.slider.updateAvailable') }}')">
                                                <option value="1" @if($item->available)selected @endif>SI</option>
                                                <option value="0" @if(!$item->available)selected @endif>NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <a href="{{ route('advertising.edit', $item->sliderAdvertising->id) }}"
                                               class="btn btn-info btn-sm"
                                               title="Editar">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button
                                                    data-url="{{ route('advertising.destroy', $item->sliderAdvertising) }}"
                                                    data-type="delete"
                                                    class="btn btn-danger js-sweetalert btn-sm"
                                                    title="Eliminar">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>
                                            <a href="{{ assetImage($item->sliderProduct->background) }}"
                                               data-lightbox="image-1">
                                                <img src="{{ assetImage($item->sliderProduct->background) }}"
                                                     width="48">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ assetImage($item->sliderProduct->product->image) }}"
                                               data-lightbox="image-1">
                                                <img src="{{ assetImage($item->sliderProduct->product->image) }}"
                                                     width="48">
                                            </a>
                                        </td>
                                        <td>NO</td>
                                        <td>{{ $item->sliderProduct->product->name }}</td>
                                        <td>{{ $item->sliderProduct->product->price }}</td>
                                        <td>
                                            <select class="form-control"
                                                    data-id="{{$item->id}}"
                                                    onchange="updateAvailable(this.value, '{{ $item->id }}', '{{ route('admin.slider.updateAvailable') }}')">
                                                <option value="1" @if($item->available)selected @endif>SI</option>
                                                <option value="0" @if(!$item->available)selected @endif>NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <a href="{{ route('slider_product.edit', $item->sliderProduct) }}"
                                               class="btn btn-info btn-sm"
                                               title="Editar">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button
                                                    data-url="{{ route('slider_product.destroy', $item->sliderProduct) }}"
                                                    data-type="delete"
                                                    class="btn btn-danger js-sweetalert btn-sm"
                                                    title="Eliminar">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('admin/pyrus/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/pyrus/datatables/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin/pyrus/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/pyrus/datatables/datatables.init.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/toastr/toastr.js') }}"></script>
    <script src="{{ asset('admin/pyrus/app.js') }}"></script>
    @include('admin.layouts._delete-sweetalert')
@endsection