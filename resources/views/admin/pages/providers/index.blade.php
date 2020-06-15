@extends('admin.layouts.admin')
@section('css')
    <link href="{{ asset('admin/pyrus/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/pyrus/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/vendor/sweetalert/sweetalert.css') }}" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
 

@endsection

@section('block-header')
<div class="block-header">
    <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12">
            <h2>
                <a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth">
                    <i class="fa fa-arrow-left"></i></a> Proveedores
            </h2>
        </div>
        <!--<div class="col-lg-2 col-md-4 col-sm-12 text-right">
            <a href="#" class="btn btn-secondary btn-lg ml-15">
                <i class="fa fa-plus-square"></i> Asignar Productos
            </a>
        </div>-->
        <div class="col-lg-2 col-md-4 col-sm-12 text-right">
            <a href="{{ route('admin.providers.create') }}" class="btn btn-primary btn-lg ml-15">
                <i class="fa fa-plus-square"></i> Nuevo Proveedor
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
    <div class="col-md-12 mt-3">
        @if (session('mensaje'))
        <div class="alert alert-success">
            {{ session('mensaje') }}
        </div>
    @endif
        <div class="card">
            <div class="body">
                @include('flash::message')
                <div class="table-responsive">
                    @component('admin.components.content_datatable')
                        @slot('datatable_header')
                            <tr>
                                <th>#</th>
                                <th>Logo</th>
                                <th>RUC</th>
                                <th>Razon Social</th>
                                <th>Propietario</th>
                                <th>DNI</th>
                                <th>Correo</th>
                                <th>Usuario</th>
                                <th>Subcategoria</th>
                                <th>Porcentaje (%)</th>
                                <th>Pasarela</th>
                                <th align="center">Distrito</th>
                                <th align="center">Provincia</th>
                                <th align="center">Departamento</th>
                                <!--<th>Ultimo Acceso</th>-->
                                <th>Opciones</th>
                            </tr>
                        @endslot
                        @slot('datatable_body')
                            <tbody>
                            @foreach($providers as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td><img src="{{ asset('logo_proveedor/'. $item->image)}}" width="80"> </td>
                                    <td>{{ $item->ruc }}</td>
                                    <td>{{ $item->razon_social }}</td>
                                    <td>{{ $item->propietario }}</td>
                                    <td>{{$item->dni}}</td>
                                    <td>{{ $item->correo }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->subcategory->name }}</td>
                                    <td>{{ $item->monto_extra }}</td>
                                    <td id="tdvisible-{{$item->id}}">
                                        @if($item->pasarela_active == 1)
                                            <a href="#" class="btn btn-dark update" data-id="{{$item->id}}"
                                               data-estado="1"><span class="label label-dark">Activo</span></a>
                                            {{--<a href="scripts:;" onclick="update_estado({{$articulo->id}},1)"><span class="label label-success">Visible</span></a>--}}
                                        @else
                                            <a href="#" class="btn btn-danger update" data-id="{{$item->id}}"
                                               data-estado="0"><span class="label label-danger">No Activo</span></a>
                                        @endif
                                    </td>
                                    <td align="center">{{ $item->distrito->distrito }}</td>
                                    <td align="center">{{$item->distrito->provincia->provincia}}</td>
                                    <td align="center">{{$item->distrito->provincia->departamento->departamento}}</td>
                                    <!--<td>{{ $item->last_login }}</td>-->
                                    <td><a href="{{route('admin.providers.edit',$item->id)}}"
                                        title="Ver Proveedor" class="btn btn-warning">
                                         <i class="fa fa-edit"></i></a>
                                         <a href="{{route('admin.provider.ver',$item->id)}}"
                                                title="Ver Proveedor" class="btn btn-success">
                                                 <i class="fa fa-eye"></i></a>
                                                 <button data-url="{{ route('admin.provider.destroy', $item) }}"
                                        data-id="{{ $item->id }}"
                                        data-type="delete"
                                        class="btn btn-danger js-sweetalert btn-sm delete"
                                        title="Eliminar">
                                    <i class="fa fa-trash-o"></i>
                                </button></td>
                                </tr>
                            @endforeach
                            </tbody>
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>
    </div>

    <!-- SELECT MULTIPLE
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asignar Productos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{route('admin.providers.guardar')}}" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }}
     
      <select class='mi-selector' name='' multiple='multiple' style="width:300px">
        <option value=''>Seleccionar una Producto</option>
        @foreach($productos as $producto)
        <option value='{{$producto->id}}'>{{$producto->name}}</option>
        @endforeach
      </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>-->
@endsection

@section('scripts')
<script>
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })
    </script>
    <script src="{{ asset('admin/pyrus/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/pyrus/datatables/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin/pyrus/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/pyrus/datatables/datatables.init.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="{{ asset('admin/assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    @include('admin.layouts._delete-sweetalert')
    
    <script>
    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('.mi-selector').select2();
        });
    });
    </script>
    
    <script>
        $(document).on('click', '.update', function (e) {
         e.preventDefault();
         var id = $(this).data('id');
         var estado = $(this).data('estado');
         var link = '/provider/update-visibilidad/';
         if (estado == 1) {
             mensaje = 'desactivar';
         } else {
             mensaje = 'activar';
         }
         swal({
                 title: "¿Estás seguro?",
                 text: "Deseas " + mensaje + " la pasarela de pagos",
                 type: "warning",
                 showCancelButton: true,
                 confirmButtonColor: "#54c54d",
                 confirmButtonText: "Sí, cambiar!",
                 closeOnConfirm: true
             },
             function () {
                 $.ajax({
                     type: "get",
                     url: link + id,
                     success: function (data) {
                         $('#tdvisible-' + id).empty();
                         var visible = '';
                         if (data == 1) {
                             visible = '<a href="#" class="btn btn-dark update" data-id="' + id + '" data-estado="1"><span class="label label-success">Activo</span></a>';
                         } else {
                             visible = '<a href="#" class="btn btn-danger update" data-id="' + id + '" data-estado="0"><span class="label label-danger">No Activo</span></a>'
                         }
                         $('#tdvisible-' + id).html(visible);

                         $.toast({
                             heading: 'Actualizado',
                             text: 'Se cambio el estado de la pasarela',
                             position: 'top-right',
                             loaderBg: '#ff6849',
                             icon: 'warning',
                             hideAfter: 3500,
                             stack: 6
                         });
                     }

                 });
             });
     });
 </script>
        
@endsection