@extends('admin.layouts.admin')
@section('css')
    <link href="{{ asset('admin/pyrus/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/pyrus/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/vendor/sweetalert/sweetalert.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css"
      href="https://cdn.datatables.net/fixedheader/3.1.4/css/fixedHeader.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('admin/pyrus/datatables/fixedHeader.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin/pyrus/datatables/fixedColumns.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/toastr/toastr.min.css') }}">
@endsection

@section('block-header')
    @component('admin.components.block-header')
        @slot('header_title')Productos @endslot
        @slot('breadcrumb_item')
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Listado de productos</a></li>
        @endslot
        @slot('breadcrumb_item_active')
            <li class="breadcrumb-item active">Actualizar Categoria</li>
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="col-md-12">
        <form action="{{ route('admin.provider.updateCategory2') }}" method="POST">
            {{ csrf_field() }}
            <div class="col-md-12 col-sm-12 mt-3">
                <label>Proveedores</label>
                <div class="input-group">
                    <select class="custom-select" id="proveedor_id" name="proveedor_id"
                            required>
                        <option value="">Seleccione una Proveedor</option>
                        @foreach($users as $item)
                            <option value="{{ $item->id }}">{{ $item->nombres }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="body">
                        @include('flash::message')
                        <div class="table-responsive">
                            <table id="basic-datatable2" class="table table-striped table-sm">
                                <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Imagen</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Categoria</th>
                                    <th>Sub Categoria 1</th>
                                    <th>Sub Categoria 2</th>
                                    <th>Disponible</th>
                                    <th>Seleccionar</th>
                                </tr>
                                </thead>
                                <tbody id="tbody_products">
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

    <script id="image-template" type="text/x-handlebars-template">
        <a href="@{{image}}"
           data-lightbox="image-1">
            <img src="@{{image}}"
                 width="48" alt="">
        </a>
    </script>
@endsection

@section('scripts')
    <script src="{{ asset('admin/pyrus/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/pyrus/datatables/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin/pyrus/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/pyrus/datatables/datatables.init.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/toastr/toastr.js') }}"></script>
     <script src="{{ asset('admin/pyrus/datatables/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('admin/pyrus/datatables/dataTables.fixedColumns.min.js') }}"></script>
    <script src="{{ asset('admin/pyrus/app.js') }}"></script>
    <script>
        let imageTemplate = Handlebars.compile($("#image-template").html());

        $(document).ready(function () {
            var table = $('#basic-datatable2').DataTable({
                "bDestroy": true,
                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>"
                    }
                }, drawCallback: function () {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                },
                'columnDefs': [{
                    'targets': 8,
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta) {
                        return '<label class="fancy-checkbox"><input type="checkbox" name="id[]" value="' + $('<div/>').text(full.id).html() + '"><span>Asignar</span></label>';
                    }
                }],
                'order': [[1, 'asc']],
                aLengthMenu: [
                    [25, 50, 100, 500],
                    [25, 50, 100, 500]
                ],
                pageLength: 500,
                "language": {
                    "processing": "Procesando datos..."
                },
                processing: true,
                serverSide: true,
                paging: true,
                scrollY: 500,
                scrollX: true,
                deferRender: true,
                scroller: {
                    loadingIndicator: true,
                },
                scrollCollapse: true,
                ajax: '{{ route('admin.product.listProductsCategory') }}',
                columns: [
                    {data: 'orden'},
                    {
                        data: 'image', render: function (data) {
                            return imageTemplate(data);
                        },
                        orderable: false, searchable: false
                    },
                    {
                        data: 'name',
                    },
                    {
                        data: 'price',
                        orderable: false, searchable: false
                    },
                    {
                        data: 'category',
                        orderable: false, searchable: false
                    },
                    {
                        data: 'subcategory',
                        orderable: false, searchable: false
                    },{
                        data: 'productSubcategory',
                        orderable: false, searchable: false
                    },
                    {
                        data: 'disponible',
                        orderable: false, searchable: false
                    },
                ],
            });
        });
    </script>
@endsection