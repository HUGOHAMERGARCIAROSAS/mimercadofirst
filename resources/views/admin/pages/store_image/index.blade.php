@extends('admin.layouts.admin')
@section('css')
    <link href="{{ asset('admin/pyrus/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/pyrus/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/vendor/sweetalert/sweetalert.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/dropify/css/dropify.min.css') }}">
@endsection

@section('block-header')
    @component('admin.components.block-header')
        @slot('header_title')Ventas Mayoristas @endslot
        @slot('breadcrumb_item') @endslot
        @slot('breadcrumb_item_active')
            <li class="breadcrumb-item active">Ventas Mayoristas</li>
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="body">

                @include('flash::message')

                <form method="POST" action="{{ route('store-image.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Nombre <span class="required">*</span></label>
                                <input type="text" class="form-control"
                                       name="name"
                                       value="{{ old('name') }}"
                                       required
                                >
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Imagen Venta Mayorista</label>
                                <input type="file" name="image" class="dropify"
                                       accept="image/*"
                                       data-allowed-file-extensions="jpg png jpeg"
                                       required
                                >
                                {{--<span class="help-block">Dimension de imagen permitido: 370x580</span>--}}
                                <br>
                                <span class="help-block">Tipo de imagen permitido: .png .jpg .jpeg</span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg">Guardar</button>
                    <a href="{{ route('store-image.index') }}" class="ml-3 btn btn-secondary btn-lg">Cancelar</a>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-12 file_manager">
        <div class="card">
            <div class="card-body">
                <div class="row clearfix">
                    @foreach($images as $item)
                        <div class="col-lg-3 col-md-4 col-sm-12">
                            <div class="card">
                                <div class="file">
                                    <a href="javascript:void(0);">
                                        <div class="hover">
                                            <button type="button"
                                                    data-url="{{ route('store-image.destroy', $item) }}"
                                                    data-type="delete"
                                                    class="ml-2 btn btn-icon btn-danger js-sweetalert btn-sm"
                                                    title="Eliminar">
                                                <i class="fa fa-trash"></i>
                                                Eliminar
                                            </button>
                                        </div>
                                        <div class="image">
                                            <img src="{{ assetImage($item->image) }}" alt="img"
                                                 class="img-fluid">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{--<div class="col-md-12">--}}
        {{--<div class="card">--}}
            {{--<div class="body">--}}
                {{--@include('flash::message')--}}

                {{--@if ($errors->any())--}}
                    {{--<div class="alert alert-danger alert-important" role="alert" style="padding-bottom: 0">--}}
                        {{--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>--}}
                        {{--<ul>--}}
                            {{--@foreach ($errors->all() as $error)--}}
                                {{--<li>{{ $error }}</li>--}}
                            {{--@endforeach--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--@endif--}}

                {{--<div class="table-responsive">--}}
                    {{--@component('admin.components.content_datatable')--}}
                        {{--@slot('datatable_header')--}}
                            {{--<tr>--}}
                                {{--<th>#</th>--}}
                                {{--<th>Imagen</th>--}}
                                {{--<th>Estado</th>--}}
                                {{--<th>Acciones</th>--}}
                            {{--</tr>--}}
                        {{--@endslot--}}

                        {{--@slot('datatable_body')--}}
                            {{--<tbody>--}}
                            {{--@foreach($images as $index => $item)--}}
                                {{--<tr>--}}
                                    {{--<td>{{ $index+1 }}</td>--}}
                                    {{--<td>--}}
                                        {{--<a href="{{ assetImage($item->image) }}"--}}
                                           {{--data-lightbox="image-1">--}}
                                            {{--<img src="{{ assetImage($item->image) }}"--}}
                                                 {{--width="48" alt="">--}}
                                        {{--</a>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--@if ($item->state_image == \App\src\Util\Constants::ESTADO_HABILITADO)--}}
                                            {{--<span class="badge badge-success mb-2">HABILITADO</span>--}}
                                        {{--@else--}}
                                            {{--<span class="badge badge-danger mb-2">INHABILITADO</span>--}}
                                        {{--@endif--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--@if ($item->state_image != \App\src\Util\Constants::ESTADO_HABILITADO)--}}
                                            {{--<a href="{{ route('store-image.edit', $item) }}"--}}
                                               {{--class="btn btn-info btn-sm"--}}
                                               {{--title="Editar">--}}
                                                {{--<i class="fa fa-edit"></i>--}}
                                                {{--Habilitar--}}
                                            {{--</a>--}}
                                        {{--@endif--}}

                                        {{--<button--}}
                                                {{--data-url="{{ route('store-image.destroy', $item) }}"--}}
                                                {{--data-type="delete"--}}
                                                {{--class="btn btn-danger js-sweetalert btn-sm"--}}
                                                {{--title="Eliminar">--}}
                                            {{--<i class="fa fa-trash-o"></i>--}}
                                            {{--Eliminar--}}
                                        {{--</button>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                            {{--@endforeach--}}
                            {{--</tbody>--}}
                        {{--@endslot--}}
                    {{--@endcomponent--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection

@section('scripts')
    <script src="{{ asset('admin/pyrus/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/pyrus/datatables/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin/pyrus/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/pyrus/datatables/datatables.init.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('admin/light/assets/js/pages/forms/dropify.js') }}"></script>
    @include('admin.layouts._delete-sweetalert')
@endsection