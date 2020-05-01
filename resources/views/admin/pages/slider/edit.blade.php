@extends('admin.layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/dropify/css/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/summernote/dist/summernote.css') }}">
@endsection

@section('block-header')
    @component('admin.components.block-header')
        @slot('header_title')Tips @endslot
        @slot('breadcrumb_item')
            <li class="breadcrumb-item">Tips y Tablas Nutricionales</li>
        @endslot
        @slot('breadcrumb_item_active')
            <li class="breadcrumb-item active">Actualizar</li>
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="body">
                @include('flash::message')
                <form method="POST" action="{{ route('slider.update', $slider) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    @include('admin.pages.slider.form')
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('admin/assets/vendor/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('admin/light/assets/js/pages/forms/dropify.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/summernote/dist/summernote.js') }}"></script>
@endsection