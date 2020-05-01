@extends('admin.layouts.admin')
@section('css')
    <link href="{{ asset('admin/pyrus/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/pyrus/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/vendor/sweetalert/sweetalert.css') }}" rel="stylesheet"/>
@endsection

@section('block-header')
    @component('admin.components.block-header')
        @slot('header_title')Promociones @endslot
        @slot('breadcrumb_item')
            <li class="breadcrumb-item">Promociones</li>
        @endslot
        @slot('breadcrumb_item_active')
            <li class="breadcrumb-item active">Listado</li>
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="col-md-12">
        <a href="{{ route('recipes.create') }}" class="btn btn-primary btn-lg">
            <i class="fa fa-plus-square"></i> Nueva Promoción
        </a>
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
                                <th>Imagen</th>
                                <th>Titulo</th>
                                <th>Fecha</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        @endslot

                        @slot('datatable_body')
                            <tbody>
                            @foreach($recipes as $index => $recipe)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>
                                        @component('admin.components.image-table', ['image' => $recipe->image])
                                            @slot('imageByDefault')
                                                {{ assetImage('img/tip-tabla/default.jpg') }}
                                            @endslot
                                        @endcomponent
                                    </td>
                                    <td>{{ $recipe->title }}</td>
                                    <td>{{ $recipe->created_at->format('d-m-Y') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('recipes.edit', $recipe) }}"
                                           class="btn btn-info btn-sm"
                                           title="Editar">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button class="btn btn-danger js-sweetalert btn-sm"
                                                data-url="{{ route('recipes.destroy', $recipe) }}"
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