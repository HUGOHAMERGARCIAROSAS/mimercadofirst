@extends('admin.layouts.admin')

@section('block-header')
    @component('admin.components.block-header')
        @slot('header_title')Dashboard @endslot
        @slot('breadcrumb_item')@endslot
        @slot('breadcrumb_item_active')
            <li class="breadcrumb-item active">Dashboard</li>
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="col-lg-12 col-md-12">
        <img src="https://pyrushd.com/System/images/image_pyrushd_admins.jpg" alt="" class="img-responsive" style="width: 100%">
    </div>
@endsection