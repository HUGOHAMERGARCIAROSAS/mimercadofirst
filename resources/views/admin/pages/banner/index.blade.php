@extends('admin.layouts.admin')
@section('css')
    <link href="{{ asset('admin/pyrus/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/pyrus/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/vendor/sweetalert/sweetalert.css') }}" rel="stylesheet"/>
@endsection

@section('block-header')
    @component('admin.components.block-header')
        @slot('header_title')Banner @endslot
        @slot('breadcrumb_item') @endslot
        @slot('breadcrumb_item_active')
            <li class="breadcrumb-item active">Listado de banners</li>
        @endslot
    @endcomponent
@endsection

@section('content')
    @component('admin.components._new-link')
        @slot('url'){{ route('banners.create') }}" @endslot
        @slot('name')Nuevo Banner @endslot
    @endcomponent

    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="body">
                @include('flash::message')

                @if ($errors->any())
                    <div class="alert alert-danger alert-important" role="alert" style="padding-bottom: 0">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="table-responsive">
                    @component('admin.components.content_datatable')
                        @slot('datatable_header')
                            <tr>
                                <th>#</th>
                                <th>Imagen</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        @endslot

                        @slot('datatable_body')
                                <tbody>
                                @foreach($banners as $index => $item)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>
                                            <a href="{{ assetImage($item->image) }}"
                                               data-lightbox="image-1">
                                                <img src="{{ assetImage($item->image) }}"
                                                     width="48" alt="">
                                            </a>
                                        </td>
                                        <td>
                                            @if ($item->state_image == \App\src\Util\Constants::ESTADO_BANNER_HABILITADO)
                                                <span class="badge badge-success mb-2">HABILITADO</span>
                                            @else
                                                <span class="badge badge-danger mb-2">INHABILITADO</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->state_image != \App\src\Util\Constants::ESTADO_BANNER_HABILITADO)
                                                <a href="{{ route('banners.edit', ['banner' => $item]) }}"
                                                   class="btn btn-info btn-sm"
                                                   title="Editar">
                                                    <i class="fa fa-edit"></i>
                                                    Habilitar
                                                </a>
                                            @endif

                                            <button
                                               data-url="{{ route('banners.destroy', ['banner' => $item]) }}"
                                               data-type="delete"
                                               class="btn btn-danger js-sweetalert btn-sm"
                                               title="Eliminar">
                                                <i class="fa fa-trash-o"></i>
                                                Eliminar
                                            </button>
                                        </td>
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
    <script src="{{ asset('admin/pyrus/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/pyrus/datatables/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin/pyrus/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/pyrus/datatables/datatables.init.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    @include('admin.layouts._delete-sweetalert')
@endsection