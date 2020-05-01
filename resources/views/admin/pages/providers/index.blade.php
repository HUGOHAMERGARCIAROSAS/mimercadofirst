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
        <div class="col-lg-2 col-md-4 col-sm-12 text-right">
            <a href="{{ route('admin.providers.asignar') }}" class="btn btn-secondary btn-lg ml-15">
                <i class="fa fa-plus-square"></i> Asignar Productos
            </a>
        </div>
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
    
        <div class="card">
            <div class="body">
                @include('flash::message')
                <div class="table-responsive">
                    @component('admin.components.content_datatable')
                        @slot('datatable_header')
                            <tr>
                                <th>#</th>
                                <th>codigo</th>
                                <th>nombre</th>
                                <th>email</th>
                                <th>Ultimo Acceso</th>
                                <th>Asignar</th>
                            </tr>
                        @endslot
                        @slot('datatable_body')
                            <tbody>
                            @foreach($providers as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->codigo_proveedor }}</td>
                                    <td>{{ $item->nombres }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->last_login }}</td>
                                    <td> <a href="{{route('admin.provider.ver',$item->id)}}"
                                                title="Editar" class="btn btn-warning">
                                                 <i class="fa fa-edit"></i></a>
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
    
        
@endsection