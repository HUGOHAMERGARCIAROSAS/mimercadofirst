@extends('admin.layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/dropify/css/dropify.min.css') }}">
@endsection

@section('block-header')
    @component('admin.components.block-header')
        @slot('header_title')Tienda @endslot
        @slot('breadcrumb_item')
            <li class="breadcrumb-item"><a href="{{ route('admin.providers.index') }}">Proveedores</a></li>
        @endslot
        @slot('breadcrumb_item_active')
            <li class="breadcrumb-item active">Registrar</li>
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="body">
                @include('flash::message')
                <form method="POST" action="{{ route('admin.providers.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row clearfix">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Codigo <span class="required">*</span></label>
                                <input type="text" class="form-control"
                                    name="codigo_proveedor"
                                    required
                                >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nombres <span class="required">*</span></label>
                                <input type="text" class="form-control"
                                    name="nombres"
                                    required
                                >
                            </div>
                        </div>
                        <input type="hidden" class="form-control"
                                    name="role"
                                    required value="provider"
                                >
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="description">Apellidos</label>
                                <input type="text" class="form-control"
                                    name="apellidos" id="apellidos" 
                                    max="30" maxlength="30"
                                >
                                <span class="help-block">Cantidad máxima de caracteres: 30</span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Email <span class="required">*</span></label>
                                <input type="email" class="form-control"
                                    name="email"
                                    required
                                >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Password <span class="required">*</span></label>
                                <input type="password" class="form-control"
                                    name="password"
                                    required
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
@endsection

@section('scripts')
    <script src="{{ asset('admin/assets/vendor/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('admin/light/assets/js/pages/forms/dropify.js') }}"></script>
    <script src="{{ asset('admin/pyrus/app.js') }}"></script>
@endsection