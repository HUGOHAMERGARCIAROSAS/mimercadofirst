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
                    <i class="fa fa-arrow-left"></i></a> Productos Asignados
            </h2>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="body">
            @include('flash::message')
            <form method="POST" action="{{route('admin.provider.update',$usuarios->id)}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT')}}
                <div class="row clearfix">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Codigo <span class="required">*</span></label>
                            <input type="text" class="form-control"
                        name="codigo_proveedor" value="{{$usuarios->codigo_proveedor}}"
                                
                            >
                        </div>
                    </div>
                    <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nombre <span class="required">*</span></label>
                                    <input type="text" class="form-control"
                                        name="nombres" value="{{$usuarios->nombres}}"
                                        
                                    >
                                </div>
                    </div>
                    <div class="col-lg-6">
                            <div class="form-group">
                                <label>Email <span class="required">*</span></label>
                                <input type="text" class="form-control"
                            name="apellidos" value="{{$usuarios->apellidos}}"
                                    
                                >
                            </div>
                        </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Email <span class="required">*</span></label>
                            <input type="email" class="form-control"
                        name="email" value="{{$usuarios->email}}"
                                
                            >
                        </div>
                    </div>
                    
                </div>

                <span class="help-block"><em>(<span class="required">*</span>) Todos los elementos son requeridos.</em></span>
                <hr>
                <button type="submit" class="btn btn-primary btn-lg">Guardar</button>
                <a href="{{ route('admin.providers.index') }}" class="btn btn-secondary btn-lg m-l-10">Cancelar</a>
            </form>
        </div>
    </div>
</div>
    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="body">
                @include('flash::message')
                <div class="table-responsive">
                    @component('admin.components.content_datatable')
                        @slot('datatable_header')
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Disponible</th>
                                <th>Producto Hoy</th>
                            </tr>
                        @endslot
                        @slot('datatable_body')
                            <tbody>
                            @foreach($orders as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{$item->disponible}}</td>
                                    <td>{{$item->product_today}}</td>   
                                </tr>
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