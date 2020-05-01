@extends('admin.layouts.admin')

@section('css')
    <link href="{{ asset('admin/pyrus/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/pyrus/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/vendor/sweetalert/sweetalert.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/toastr/toastr.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/dropify/css/dropify.min.css') }}">
@endsection

@section('block-header')
    @component('admin.components.block-header')
        @slot('header_title')Tienda @endslot
        @slot('breadcrumb_item')
            <li class="breadcrumb-item">Categoría</li>
        @endslot
        @slot('breadcrumb_item_active')
            <li class="breadcrumb-item active">Listado de categorias</li>
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="col-md-12">
        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-plus-square"></i> Nueva Categoría
        </button>

        <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#exampleModal2">
            <i class="fa fa-plus-square"></i> Nueva Sub Categoría 1
        </button>

        <button class="btn btn-success btn-lg ml-2" data-toggle="modal" data-target="#exampleModal3">
            <i class="fa fa-plus-square"></i> Nueva Sub Categoría 2
        </button>
    </div>

    <div class="col-md-12 col-sm-12 mt-3">
        <label for="select_category_id">Categorias</label>
        <div class="input-group">
            <select class="custom-select" name="category_id" id="select_category_id"
                    onchange="searchCategory(this.value)">
                <option value="">Mostrar las Categorias</option>
                @foreach($categories as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 mt-3">
        <label for="select_category_id">Sub Categorias 1</label>
        <div class="input-group">
            <select class="custom-select" name="select_sub_category_id" id="select_sub_category_id"
                    onchange="searchSubCategory(this.value)">
                <option value="">Mostrar Sub Categorias 1</option>
            </select>
        </div>
    </div>

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
                                <th width="50">Orden</th>
                                <th>Nombre</th>
                                <th>Imagen</th>
                                <th>Acciones</th>
                            </tr>
                        @endslot

                        @slot('datatable_body')
                            <tbody id="subcategories">
                            @include('admin.pages.category._tbody_categories')
                            </tbody>
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nueva Categoría</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                    {{  csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input id="name" type="text" class="form-control"
                                   name="name"
                                   required>
                        </div>
                        <div class="form-group">
                            <label>Imagen </label>
                            <input type="file" name="image" class="dropify"
                                   
                                   data-allowed-file-extensions="jpg png jpeg"
                            >
                            <span class="help-block">Dimension de imagen permitido: 181x181</span>
                            <br>
                            <span class="help-block">Tipo de imagen permitido: .png .jpg .jpeg</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nueva Sub Categoría 1</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('subcategories-1.store') }}" method="post" enctype="multipart/form-data">
                    {{  csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category_id">Categoría</label>
                            <select name="category_id" id="category_id" class="form-control"
                                    required>
                                @foreach($categories as $item)
                                    <option value="{{$item->id}}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Sub Categoría 1</label>
                            <input id="name" type="text" class="form-control"
                                   placeholder="Ingresar Nombre"
                                   required
                                   name="name">
                        </div>
                        <div class="col-lg-12 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Imagen </label>
                                <input type="file" name="image" class="dropify"
                                       
                                       data-allowed-file-extensions="jpg png jpeg"
                                >
                                <span class="help-block">Dimension de imagen permitido: 181x181</span>
                                <br>
                                <span class="help-block">Tipo de imagen permitido: .png .jpg .jpeg</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nueva Sub Categoría 2</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('subcategories-2.store') }}" method="post">
                    {{  csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category_id">Categoría</label>
                            <select name="category_id" id="category_id" class="form-control"
                                    onchange="searchCategoryInModal(this.value)"
                                    required>
                                <option value="">Seleccione Categoría</option>
                                @foreach($categories as $item)
                                    <option value="{{$item->id}}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="modal_sub_category_id">Sub Categoría 1</label>
                            <select name="sub_category_id" id="modal_sub_category_id" class="form-control"
                                    required>
                                <option value="">Mostrar Sub Categorias 1</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Sub Categoría 2</label>
                            <input id="name" type="text" class="form-control"
                                   placeholder="Ingresar Nombre"
                                   required
                                   name="name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
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
    <script src="{{ asset('admin/assets/vendor/toastr/toastr.js') }}"></script>
    <script src="{{ asset('admin/pyrus/app.js') }}"></script>

    <script src="{{ asset('admin/assets/vendor/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('admin/light/assets/js/pages/forms/dropify.js') }}"></script>
    @include('admin.layouts._delete-sweetalert')

    <script>
        let _categoryId = 0;

        function searchCategory(categoryId) {
            let dataDatable = $('#basic-datatable');
            dataDatable.DataTable().clear().draw();
            dataDatable.DataTable().destroy();

            let data = {
                'category_id': categoryId,
            };

            _categoryId = categoryId;

            $.ajax({
                url: "{{ route('admin.category.search') }}",
                method: 'POST',
                dataType: "JSON",
                data: data,
            }).done((response) => {
                $("#basic-datatable tbody").html(response.viewSubCategories);

                $('#select_sub_category_id').html(response.viewSelectSubCategories);

                dataDatable.DataTable({
                    language: {
                        paginate: {
                            previous: "<i class='mdi mdi-chevron-left'>",
                            next: "<i class='mdi mdi-chevron-right'>"
                        }
                    }, drawCallback: function () {
                        $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                    },
                    pageLength: 100,
                });
            }).fail((error) => {
                console.log(error);
            });

        }

        function searchSubCategory(subCategoryId) {
            let dataDatable = $('#basic-datatable');
            dataDatable.DataTable().clear().draw();
            dataDatable.DataTable().destroy();

            let data = {
                'sub_category_id': subCategoryId,
                'category_id': _categoryId,
            };

            $.ajax({
                url: "{{ route('admin.category.searchSubCategories') }}",
                method: 'POST',
                dataType: "JSON",
                data: data,
            }).done((response) => {
                console.log(response);

                $("#basic-datatable tbody").html(response.viewSubCategories2);

                dataDatable.DataTable({
                    language: {
                        paginate: {
                            previous: "<i class='mdi mdi-chevron-left'>",
                            next: "<i class='mdi mdi-chevron-right'>"
                        }
                    }, drawCallback: function () {
                        $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                    },
                    pageLength: 100,
                });
            }).fail((error) => {
                console.log(error);
            });

        }

        function searchCategoryInModal(categoryId) {
            let data = {
                'category_id': categoryId,
                'modal': true,
            };

            $.ajax({
                url: "{{ route('admin.category.search') }}",
                method: 'POST',
                dataType: "JSON",
                data: data,
            }).done((response) => {
                $('#modal_sub_category_id').html(response.viewSelectSubCategories);
            }).fail((error) => {
                console.log(error);
            });
        }

    </script>
@endsection