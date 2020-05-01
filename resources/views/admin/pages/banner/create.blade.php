@extends('admin.layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/dropify/css/dropify.min.css') }}">
@endsection

@section('block-header')
    @component('admin.components.block-header')
        @slot('header_title')Banner @endslot
        @slot('breadcrumb_item')
            <li class="breadcrumb-item">Listado</li>
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

                <form method="POST" action="{{ route('banners.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Imagen</label>
                                <input type="file" name="image" class="dropify"
                                       data-allowed-file-extensions="jpg png jpeg"
                                       required
                                >
                                <span class="help-block">Dimension de imagen permitido: 370x580</span>
                                <br>
                                <span class="help-block">Tipo de imagen permitido: .png .jpg .jpeg</span>
                            </div>
                        </div>
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary btn-lg">Guardar</button>
                    <a href="{{ route('banners.index') }}" class="btn btn-default btn-lg">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('admin/assets/vendor/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('admin/light/assets/js/pages/forms/dropify.js') }}"></script>
@endsection