@extends('admin.layouts.admin')
@section('css')
    <link href="{{ asset('admin/pyrus/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/pyrus/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/vendor/sweetalert/sweetalert.css') }}" rel="stylesheet"/>
@endsection

@section('block-header')
    @component('admin.components.block-header')
        @slot('header_title')Comentarios @endslot
        @slot('breadcrumb_item') @endslot
        @slot('breadcrumb_item_active')
            <li class="breadcrumb-item active">Listado de comentarios</li>
        @endslot
    @endcomponent
@endsection

@section('content')
    @component('admin.components._new-link')
        @slot('url'){{ route('comments.create') }}" @endslot
        @slot('name')Nuevo Comentario @endslot
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
                                <th>Usuario</th>
                                <th>Comentario</th>
                                <th>Acciones</th>
                            </tr>
                        @endslot

                        @slot('datatable_body')
                            <tbody>
                            @foreach($comments as $index => $item)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>
                                        @component('admin.components.image-table', ['image' => $item->image])
                                            @slot('imageByDefault')
                                                {{ assetImage('img/comment/default.jpg') }}
                                            @endslot
                                        @endcomponent
                                    </td>
                                    <td>{{ $item->user }}</td>
                                    <td>{{ $item->comment }}</td>
                                    <td>
                                        <a href="{{ route('comments.edit', $item->id) }}"
                                           class="btn btn-info btn-sm"
                                           title="Editar">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button class="btn btn-danger js-sweetalert btn-sm"
                                                data-url="{{ route('comments.destroy', $item->id) }}"
                                                data-type="delete"
                                                title="Eliminar">
                                            <i class="fa fa-trash-o"></i>
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