@extends('admin.layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/dropify/css/dropify.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css"/>
@endsection

@section('block-header')
    @component('admin.components.block-header')
        @slot('header_title')Nuevo Slider (Con Producto)@endslot
        @slot('breadcrumb_item')
            <li class="breadcrumb-item"><a href="{{ route('slider.index') }}">Sliders</a></li>
        @endslot
        @slot('breadcrumb_item_active')
            <li class="breadcrumb-item active">Nuevo Slider (Con Producto)</li>
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="col-md-12">
        @include('admin.errors.list_errors')
        <div class="card">
            <div class="body">
                <form method="POST" action="{{ route('slider_product.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @include('admin.pages.slider.product.form')
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('admin/assets/vendor/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('admin/light/assets/js/pages/forms/dropify.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/bootstrap-treeview/bootstrap-treeview.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/jstree/jstree.min.js') }}"></script>

    <script src="{{ asset('admin/light/assets/js/pages/treeview/jstree.js') }}"></script>
    <script src="{{ asset('admin/light/assets/js/pages/treeview/bootstrap-treeview.js') }}"></script>
    <script src="{{ asset('admin/pyrus/app.js') }}"></script>

    <script>
        {{--$(function () {--}}
        {{--$('#jstree').jstree({--}}
        {{--'core': {--}}
        {{--'data': {--}}
        {{--"url": "{{ route('admin.slider.listCategories') }}",--}}
        {{--"dataType": "json",--}}
        {{--"type": "GET",--}}
        {{--"data": function (node) {--}}
        {{--console.log(node);--}}
        {{--return {"id": node.id};--}}
        {{--}--}}
        {{--}--}}
        {{--},--}}
        {{--})--}}
        {{--});--}}
    </script>
@endsection