@extends('admin.layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/dropify/css/dropify.min.css') }}">
@endsection

@section('block-header')
    @component('admin.components.block-header')
        @slot('header_title')Nuevo Slider (Publicidad) @endslot
        @slot('breadcrumb_item')
            <li class="breadcrumb-item"><a href="{{ route('slider.index') }}">Sliders</a></li>
        @endslot
        @slot('breadcrumb_item_active')
            <li class="breadcrumb-item active">Nuevo Slider (Publicidad)</li>
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="col-md-12">

        @include('admin.errors.list_errors')

        <div class="card">
            <div class="body">

                <form method="POST" action="{{ route('advertising.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @include('admin.pages.slider.advertising.form')
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('admin/assets/vendor/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('admin/light/assets/js/pages/forms/dropify.js') }}"></script>
@endsection