@extends('admin.layouts.admin')
@section('css')
<link href="{{ asset('admin/pyrus/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css">
<link href="{{ asset('admin/pyrus/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css">
<link href="{{ asset('admin/assets/vendor/sweetalert/sweetalert.css') }}" rel="stylesheet"/>
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/toastr/toastr.min.css') }}">
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css"
      rel="stylesheet"/>
<link rel="stylesheet" type="text/css"
      href="https://cdn.datatables.net/fixedheader/3.1.4/css/fixedHeader.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('admin/pyrus/datatables/fixedHeader.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin/pyrus/datatables/fixedColumns.dataTables.min.css') }}">
@endsection

@section('styles')
<style>
    .dropdown-toggle::after {
        display: inline-block;
        width: 0;
        height: 0;
        margin-left: .255em;
        vertical-align: .255em;
        content: "";
        border-top: .3em solid !important;
        border-right: none !important;
        border-left: none !important;
    }

    a {
        color: #444;
    }

    .editable-click, a.editable-click, a.editable-click:hover {
        text-decoration: none;
        border-bottom: dashed 1px #444;
    }
</style>
@endsection

@section('block-header')
<div class="block-header">
    <div class="row">
        <div class="col-lg-5 col-md-8 col-sm-12">
            <h2>
                <a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth">
                    <i class="fa fa-arrow-left"></i></a> Productos
            </h2>
        </div>
        <div class="col-lg-7 col-md-4 col-sm-12 text-right">
            <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg ml-15">
                <i class="fa fa-plus-square"></i> Nuevo Producto
            </a>
            <a href="{{ route('categories.index') }}" class="btn btn-info btn-lg ml-15">
                <i class="fa fa-plus-square"></i> Nueva Categoría
            </a>
            <a href="{{ route('admin.product.updateCategory') }}" class="btn btn-warning btn-lg ml-15">
                <i class="fa fa-plus-square"></i> Cambiar por Categorìa
            </a>
            <a href="{{ route('admin.product.exportProduct') }}" class="btn btn-success btn-lg ml-15"
               title="Exportar en Excel">
                <i class="fa fa-file-excel-o"></i>Exportar Productos (excel)
            </a>
            <a href="#importarExcel" data-toggle="modal" class="btn btn-danger btn-lg ml-15"
               title="Importar en Excel">
                <i class="fa fa-file-excel-o"></i>Importar Productos (excel)
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="body">
            @include('flash::message')
            @if (session('status'))
                <div class="alert alert-info">
                    {{ session('status') }}
                </div>
            @endif
            <div class="table-responsive">
                <table id="basic-datatable-products" class="table table-striped table-sm table-bordered">
                    <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Orden</th>
                        <th>Producto</th>
                        <th>Descripción</th>
                        <th class="text-center">Costo</th>
                        <th class="text-center">Porcentaje</th>
                        <th class="text-center">Monto</th>
                        <th class="text-center">Precio Final</th>
                        <th class="text-center">Proveedor</th>
                        <th class="text-center">Unidades</th>
                        <th class="text-center">Escala</th>
                        <th class="text-center">Ofertas</th>
                        <th class="text-center">Disponible</th>              
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody id="tbody_products">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Subir Excel -->
<div class="modal fade" id="importarExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Importar Productos</h5>
            </div>
            <form action="{{route('import-excel')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Archivo excel para importar :</label>
                        <input type="file" name="excel" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerar</button>
                    <button type="submit" class="btn btn-primary">Importar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script id="details-template" type="text/x-handlebars-template">

    <div class="input-group" id="adv-search">
        <div class="input-group-btn">
            <div class="btn-group" role="group">
                <div class="dropdown dropdown-lg">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false" style="background-color: #28a745;color:#fff;"><i
                            class="fa fa-plus-square"></i></button>

                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                        <button class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#editModal-@{{ id }}">
                            <i class="fa fa-plus-square"></i>
                        </button>

                        <a href="@{{editUrl}}"
                           class="btn btn-info btn-sm"
                           title="Editar">
                            <i class="fa fa-edit"></i>
                        </a>

                        <button data-url="@{{deleteUrl}}"
                                data-id="@{{id}}"
                                data-type="delete"
                                class="btn btn-danger js-sweetalert btn-sm delete"
                                title="Eliminar">
                            <i class="fa fa-trash-o"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal-@{{ id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Datos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">ORDEN DEL PRODUCTO: @{{ orden }}</label> <br>
                            <label for="name">Ingresar nuevo orden del producto</label>
                            <input type="number" class="form-control" maxlength="@{{ total }}" max="@{{ total }}"
                                   onchange="changeOrder(this.value, '@{{ id }}', '/admin/products/updateOrder')"
                                   oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                                   min="1" minlength="1" value="@{{ orden }}">
                            <span class="help-block">Rango de valores: 1 - @{{ total }}</span>
                        </div>

                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control"
                                   name="name"
                                   onchange="updateColumn(this.value, '@{{ id }}', 'name')"
                                   value="@{{ name }}"
                            >
                        </div>

                        <div class="form-group">
                            <label for="name">Descripción</label>
                            <input type="text" class="form-control"
                                   name="description"
                                   onchange="updateColumn(this.value, '@{{ id }}', 'description')"
                                   value="@{{ description }}"
                            >
                        </div>
                        <div class="modal-footer">
                            <p>Para guardar los cambios, presionar <strong>ENTER.</strong></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</script>

<script id="product-today-template" type="text/x-handlebars-template">
    <select class="form-control" style="width: 65px;"
            onchange="updateColumn(this.value,'@{{ id }}','product_today')"
            data-id="@{{ id }}">
        @{{#if productToday}}
        <option value="1" selected>SI</option>
        <option value="0">NO</option>
        @{{else}}
        <option value="0" selected>NO</option>
        <option value="1">SI</option>
        @{{/if}}
    </select>
</script>

<script id="product-available-template" type="text/x-handlebars-template">
    <select class="disponible form-control" style="width: 65px;"
            onchange=""
            data-id="@{{ id }}">
        @{{#if disponible}}
        <option value="SI" selected>SI</option>
        <option value="NO">NO</option>
        @{{else}}
        <option value="NO" selected>NO</option>
        <option value="SI">SI</option>
        @{{/if}}
    </select>
</script>

<script id="image-template" type="text/x-handlebars-template">
    <a href="@{{image}}"
       data-lightbox="image-1">
        <img src="@{{image}}"
             width="48" alt="">
    </a>
</script>
<script id="product-orden-template" type="text/x-handlebars-template">
    <input type="text" class="form-control"
           name="orden"
           onchange="updateProductOrden(event, this.value, '@{{ id }}')"
           value="@{{ orden }}"
    >
</script>
<script id="product-price-template" type="text/x-handlebars-template">
    <input type="text" class="form-control"
           name="price"
           onchange="updateProductPrice(event, this.value, '@{{ id }}')"
           value="@{{ price }}"
    >
</script>

<script id="product-porcentaje-template" type="text/x-handlebars-template">
    <input type="text" class="form-control"
           name="porcentaje"
           onchange="updateProductPorcentaje(event, this.value, '@{{ id }}')"
           value="@{{ porcentaje }}"
    >
</script>
<script id="product-monto-template" type="text/x-handlebars-template">
    <input type="text" class="form-control"
           name="monto"
           onchange="updateProductmonto(event, this.value, '@{{ id }}')"
           value="@{{ monto }}"
    >
</script>
<script id="product-final-template" type="text/x-handlebars-template">
    <input type="text" class="form-control"
           name="final"
           onchange="updateProductFinal(event, this.value, '@{{ id }}')"
           value="@{{ final }}"
    >
</script>
<script id="product-provider-template" type="text/x-handlebars-template">
    <input type="text" class="form-control"
           name="provider_id"
           onchange="updateProductProvider(event, this.value, '@{{ id }}')"
           value="@{{ provider_id }}"
    >
</script>

@endsection

@section('scripts')
<script src="{{ asset('admin/pyrus/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/pyrus/datatables/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('admin/pyrus/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/pyrus/datatables/datatables.init.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/toastr/toastr.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js"></script>
<script src="{{ asset('admin/pyrus/datatables/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('admin/pyrus/datatables/dataTables.fixedColumns.min.js') }}"></script>
<script src="{{ asset('admin/pyrus/app.js') }}"></script>
@include('admin.layouts._delete-sweetalert')
<script>
    let template = Handlebars.compile($("#details-template").html());
    let imageTemplate = Handlebars.compile($("#image-template").html());
    let productAvilableTemplate = Handlebars.compile($("#product-available-template").html());
    let productOrdenTemplate = Handlebars.compile($("#product-orden-template").html());
    let productTodayTemplate = Handlebars.compile($("#product-today-template").html());
    let productPriceTemplate = Handlebars.compile($("#product-price-template").html());
    let productPorcentajeTemplate = Handlebars.compile($("#product-porcentaje-template").html());
    let productMontoTemplate = Handlebars.compile($("#product-monto-template").html());
    let productFinalTemplate = Handlebars.compile($("#product-final-template").html());
    let productProviderTemplate = Handlebars.compile($("#product-provider-template").html());

    $(function () {
        jQuery.fn.dataTableExt.pager.numbers_length = 15;
        $('#basic-datatable-products').DataTable({
            "bDestroy": true,
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>"
                },
                "processing": "Procesando datos...",
            }, drawCallback: function () {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            },
            processing: true,
            serverSide: true,
            "ordering": true,
            ajax: '{{ route('admin.product.listProducts') }}',
            'columnDefs': [{
                "targets": [0, 4, 5, 6, 7, 8, 9],
                "className": "text-center",
            }],
            columns: [
                {
                    data: 'image', render: function (data) {
                        return imageTemplate(data);
                    },
                    orderable: true, searchable: true,
                },
                {
                    data: 'orden',
                    orderable: true, searchable: false
                },
               
                {
                    data: 'name',
                    orderable: true, searchable: true,
                },
                {
                    data: 'description',
                    orderable: true, searchable: true,
                },
               
                {
                    data: 'price',
                    orderable: true, searchable: false
                },
                {
                    data: 'porcentaje',
                    orderable: true, searchable: false
                },
                {
                    data: 'monto',
                    orderable: true, searchable: false
                },
                
                
                {
                    data: 'final',
                    orderable: true, searchable: false
                },
                
                {
                    data: 'provider_id',
                    orderable: false, searchable: false
                },
                
                {
                    data: 'product_unit_measure.abrv',
                    orderable: false, searchable: false
                },
                {
                    data: 'product_scale.value',
                    orderable: false, searchable: false
                },
                {
                    data: 'product_today',
                    orderable: true, searchable: false
                },
                {
                    data: 'disponible',
                    orderable: true, searchable: false
                },
                {
                    data: 'actions', render: function (data, type, row, meta) {
                        let o = Object.assign({}, data, row);
                        return template(o);
                    },
                    orderable: false, searchable: false
                },
            ],
            aLengthMenu: [
                [25, 50, 100, 500],
                [25, 50, 100, 500]
            ],
            paging: true,
            scrollY: 500,
            scrollX: true,
            deferRender: true,
            scroller: {
                loadingIndicator: true,
            },
            scrollCollapse: true,
            // fixedHeader: {
            //     header: true,
            //     headerOffset: 60,
            // },
            // scrollX: true,
            pageLength: 500,
            "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                let productId = aData.id;
                let data = {
                    productId: aData.id,
                    orden: aData.orden,
                    name: aData.name,
                    description: aData.description,
                    price: aData.price,
                    product_unit_measure_id: aData.product_unit_measure_id,
                    product_unit_measure_abrv: aData.product_unit_measure.abrv,
                    porcentaje: aData.porcentaje,
                    monto: aData.monto,
                    product_scale_id: aData.product_scale_id,
                    product_scale_value: aData.product_scale.value,
                    product_today: aData.product_today,
                    disponible: aData.disponible,
                    final: parseFloat(aData.price)+parseFloat(aData.price*aData.porcentaje)+parseFloat(aData.monto),
                    provider_id: aData.provider_id,
                };

                // globals
                $.fn.editable.defaults.mode = 'inline';
                $.fn.editable.defaults.pk = productId;
                $.fn.editable.defaults.url = "{{ route('admin.product.updateAjaxProduct') }}";
                $.fn.editable.defaults.ajaxOptions = {
                    type: 'get',
                    dataType: 'json',
                };
                $.fn.editable.defaults.validate = function (value) {
                    if (!value) {
                        return toastr['error']('El campo esta vacio.');
                    }
                };
                $('td:eq(1)', nRow).html('<a class="myeditables-class" href="#">' + data.orden + '</a>');
                $('td:eq(2)', nRow).html('<a class="myeditables-class" href="#">' + data.name + '</a>');
                $('td:eq(3)', nRow).html('<a class="myeditables-class" href="#">' + data.description + '</a>');
                $('td:eq(4)', nRow).html('<a class="myeditables-class" href="#">' + data.price + '</a>');
                $('td:eq(5)', nRow).html('<a class="myeditables-class" href="#">' + data.porcentaje + '</a>');
                $('td:eq(6)', nRow).html('<a class="myeditables-class" href="#">' + data.monto + '</a>');
                $('td:eq(7)', nRow).html('<a class="myeditables-class" href="#">' + data.final + '</a>');
                $('td:eq(8)', nRow).html('<a class="myeditables-class" href="#">' + data.provider_id + '</a>');
                $('td:eq(9)', nRow).html('<a class="myeditables-class" href="#">' + data.product_unit_measure_abrv + '</a>');
                $('td:eq(10)', nRow).html('<a class="myeditables-class" href="#">' + data.product_scale_value + '</a>');
                $('td:eq(11)', nRow).html('<a class="myeditables-class" href="#">' + (data.product_today == 0 ? 'NO' : 'SI') + '</a>');
                $('td:eq(12)', nRow).html('<a class="myeditables-class" href="#">' + data.disponible + '</a>');
                
                $('td:eq(1) a', nRow).editable({
                    type: 'text',
                    name: 'orden',
                    params: function (params) {
                        data['orden'] = params.value;
                        return data;
                    },
                    success: function (response, newValue) {
                        toastr[response.type](response.message);
                    },
                    error: function (error) {
                        let errors = error.responseJSON;
                        $.each(errors.errors, function (key, value) {
                            toastr['error'](value[0]);
                        });
                    }
                });
                $('td:eq(2) a', nRow).editable({
                    type: 'text',
                    name: 'name',
                    params: function (params) {
                        data['name'] = params.value;
                        return data;
                    },
                    success: function (response, newValue) {
                        toastr[response.type](response.message);
                    },
                    error: function (error) {
                        let errors = error.responseJSON;
                        $.each(errors.errors, function (key, value) {
                            toastr['error'](value[0]);
                        });
                    }
                });

                $('td:eq(3) a', nRow).editable({
                    type: 'text',
                    name: 'description',
                    params: function (params) {
                        data['description'] = params.value;
                        return data;
                    },
                    success: function (response, newValue) {
                        toastr[response.type](response.message);
                    },
                    error: function (error) {
                        let errors = error.responseJSON;
                        $.each(errors.errors, function (key, value) {
                            toastr['error'](value[0]);
                        });
                    }
                });

                $('td:eq(4) a', nRow).editable({
                    type: 'text',
                    name: 'price',
                    params: function (params) {
                        data['price'] = params.value;
                        return data;
                    },
                    success: function (response, newValue) {
                        toastr[response.type](response.message);
                    },
                    error: function (error) {
                        let errors = error.responseJSON;
                        $.each(errors.errors, function (key, value) {
                            toastr['error'](value[0]);
                        });
                    }
                });
                $('td:eq(5) a', nRow).editable({
                    type: 'text',
                    name: 'porcentaje',
                    params: function (params) {
                        data['porcentaje'] = params.value;
                        return data;
                    },
                    success: function (response, newValue) {
                        toastr[response.type](response.message);
                    },
                    error: function (error) {
                        let errors = error.responseJSON;
                        $.each(errors.errors, function (key, value) {
                            toastr['error'](value[0]);
                        });
                    }
                });

                $('td:eq(6) a', nRow).editable({
                    type: 'text',
                    name: 'monto',
                    params: function (params) {
                        data['monto'] = params.value;
                        return data;
                    },
                    success: function (response, newValue) {
                        toastr[response.type](response.message);
                    },
                    error: function (error) {
                        let errors = error.responseJSON;
                        $.each(errors.errors, function (key, value) {
                            toastr['error'](value[0]);
                        });
                    }
                });
                $('td:eq(7) a', nRow).editable({
                    type: 'text',
                    name: 'final',
                    params: function (params) {
                        data['final'] = params.value;
                        return data;
                    },
                    success: function (response, newValue) {
                        toastr[response.type](response.message);
                    },
                    error: function (error) {
                        let errors = error.responseJSON;
                        $.each(errors.errors, function (key, value) {
                            toastr['error'](value[0]);
                        });
                    }
                });
                $('td:eq(8) a', nRow).editable({
                    type: 'text',
                    provider_id: 'provider_id',
                    params: function (params) {
                        data['provider_id'] = params.value;
                        return data;
                    },
                    success: function (response, newValue) {
                        toastr[response.type](response.message);
                    },
                    error: function (error) {
                        let errors = error.responseJSON;
                        $.each(errors.errors, function (key, value) {
                            toastr['error'](value[0]);
                        });
                    }
                });

                $('td:eq(9) a', nRow).editable({
                    type: 'select',
                    name: 'product_unit_measure_id',
                    value: data.product_unit_measure_id,
                    source: [
                        {value: 1, text: 'kg'},
                        {value: 2, text: 'unid'},
                        {value: 3, text: 'empaque'},
                    ],
                    params: function (params) {
                        data['product_unit_measure_id'] = params.value;
                        return data;
                    },
                    success: function (response, newValue) {
                        toastr[response.type](response.message);
                    },
                    error: function (error) {
                        let errors = error.responseJSON;
                        $.each(errors.errors, function (key, value) {
                            toastr['error'](value[0]);
                        });
                    }
                });

                $('td:eq(10) a', nRow).editable({
                    type: 'select',
                    name: 'product_scale_id',
                    value: data.product_scale_id,
                    source: [
                        {value: "1", text: '1'},
                        {value: "2", text: '6'},
                        {value: "3", text: '12'},
                        {value: "4", text: '0.25'},
                        {value: "5", text: '0.5'},
                        {value: "6", text: '25'},
                        {value: "7", text: '50'},
                        {value: "8", text: '100'},
                    ],
                    params: function (params) {
                        data['product_scale_id'] = params.value;
                        return data;
                    },
                    success: function (response, newValue) {
                        toastr[response.type](response.message);
                    },
                    error: function (error) {
                        let errors = error.responseJSON;
                        $.each(errors.errors, function (key, value) {
                            toastr['error'](value[0]);
                        });
                    }
                });

                $('td:eq(11) a', nRow).editable({
                    type: 'select',
                    name: 'product_today',
                    value: data.product_today,
                    source: [
                        {value: '1', text: 'SI'},
                        {value: '0', text: 'NO'}
                    ],
                    params: function (params) {
                        data['product_today'] = params.value;
                        return data;
                    },
                    success: function (response, newValue) {
                        toastr[response.type](response.message);
                    },
                    error: function (error) {
                        let errors = error.responseJSON;
                        $.each(errors.errors, function (key, value) {
                            toastr['error'](value[0]);
                        });
                    }
                });

                $('td:eq(12) a', nRow).editable({
                    type: 'select',
                    name: 'disponible',
                    value: data.disponible,
                    source: [
                        {value: 'SI', text: 'SI'},
                        {value: 'NO', text: 'NO'}
                    ],
                    params: function (params) {
                        data['disponible'] = params.value;
                        return data;
                    },
                    success: function (response, newValue) {
                        toastr[response.type](response.message);
                    },
                    error: function (error) {
                        let errors = error.responseJSON;
                        $.each(errors.errors, function (key, value) {
                            toastr['error'](value[0]);
                        });
                    }
                });

               
               

                return nRow;
            },
        });

    });

    $('.delete').on('click', function () {
        let id = $(this).data('id');
        let url = $(this).data('url');

        $.ajax({
            url: '{{ route('admin.product.existProduct') }}',
            method: 'POST',
            data: {productId: id},
        }).done((response) => {
            if (response.exist) {
                swal({
                    title: "¿Estás seguro?",
                    text: "Este producto esta asociado al SLIDER de la página. Si elimina no se mostrará en el SLIDER.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#dc3545",
                    confirmButtonText: "Si, Eliminar",
                    cancelButtonText: "No, Cancelar",
                    closeOnConfirm: false,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true,
                }, function (isConfirm) {
                    if (isConfirm) {
                        setTimeout(function () {
                            eliminar(url);
                        }, 1000);
                    }
                });
            } else {
                swal({
                    title: "¿Estás seguro?",
                    text: "¡No podrás recuperar este registro!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#dc3545",
                    confirmButtonText: "Si, Eliminar",
                    cancelButtonText: "No, Cancelar",
                    closeOnConfirm: false,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true,
                }, function (isConfirm) {
                    if (isConfirm) {
                        setTimeout(function () {
                            eliminar(url);
                        }, 1000);
                    }
                });
            }
        }).fail((error) => {
        });
    });

    function eliminar(url) {
        $.ajax({
            type: 'DELETE',
            url: url,
            success: (result) => {
                if (result.isDeleted) {
                    swal({
                        title: "Eliminado!",
                        text: "El registro ha sido eliminado",
                        type: "success"
                    }, () => {
                        window.location.reload(true);
                    });
                }
            }
        });
    }

    function updateProductPrice(event, price, productId) {
        event.preventDefault();

        let data = {
            'price': price,
            'productId': productId,
        };
        $.ajax({
            url: '{{ route('admin.product.updateProductPrice') }}',
            method: 'POST',
            data: data,
        }).done((response) => {
            if (response) {
                toastr['success']("{{ __('message.product_update_price') }}");
            } else {
                toastr['error']("{{ __('message.product_error_price') }}");
            }
        }).fail((error) => {
            console.log(error);
        });
    }

    function updateProductPorcentaje(event, porcentaje, productId) {
        event.preventDefault();

        let data = {
            'porcentaje': porcentaje,
            'productId': productId,
        };
        $.ajax({
            url: '{{ route('admin.product.updateProductPorcentaje') }}',
            method: 'POST',
            data: data,
        }).done((response) => {
            if (response) {
                toastr['success']("{{ __('message.product_update_porcentaje') }}");
            } else {
                toastr['error']("{{ __('message.product_error_porcentaje') }}");
            }
        }).fail((error) => {
            console.log(error);
        });
    }
    function updateProductMonto(event, monto, productId) {
        event.preventDefault();

        let data = {
            'monto': monto,
            'productId': productId,
        };
        $.ajax({
            url: '{{ route('admin.product.updateProductMonto') }}',
            method: 'POST',
            data: data,
        }).done((response) => {
            if (response) {
                toastr['success']("{{ __('message.product_update_monto') }}");
            } else {
                toastr['error']("{{ __('message.product_error_monto') }}");
            }
        }).fail((error) => {
            console.log(error);
        });
    }

    function updateColumn(value, productId, column) {
        let data = {
            value: value,
            column: column,
            productId: productId,
        };

        update(data);
    }

    function update(data) {
        return $.ajax({
            url: '{{ route('admin.product.updateInIndex') }}',
            method: 'POST',
            data: data,
        }).done((response) => {
            toastr[response.type](response.message);
        }).fail((error) => {
            console.log(error);
        });
    }

</script>
@endsection