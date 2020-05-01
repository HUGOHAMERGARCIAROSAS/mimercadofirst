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

    a {
        color: #444;
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
    </div>
</div>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="body">
            @include('flash::message')
            <div class="table-responsive">
                <table id="basic-datatable-productss" class="table table-striped table-sm table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Descripción</th>
                        <th class="text-center">Precio</th>
                        <th class="text-center">Unidades</th>
                        <th class="text-center">Escala</th>
                        <th class="text-center">Ofertas</th>
                        <th class="text-center">Disponible</th>
                    </tr>
                    </thead>
                    <tbody id="tbody_products">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script id="details-template" type="text/x-handlebars-template">
    

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

<script id="product-price-template" type="text/x-handlebars-template">
    <input type="text" class="form-control"
           name="price"
           onchange="updateProductPrice(event, this.value, '@{{ id }}')"
           value="@{{ price }}"
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
    let productTodayTemplate = Handlebars.compile($("#product-today-template").html());
    let productPriceTemplate = Handlebars.compile($("#product-price-template").html());

    $(function () {
        $('#basic-datatable-productss').DataTable({
            "Destroy": true,
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
            ajax: '{{ route('admin.producto.listProducts') }}',
            'columnDefs': [{
                "targets": [0, 4, 5, 6, 7, 8],
                "className": "text-center",
            }],
            columns: [
                {data: 'orden'},
                {
                    data: 'image', render: function (data) {
                        return imageTemplate(data);
                    },
                    orderable: false, searchable: true,
                },
                {
                    data: 'name',
                },
                {
                    data: 'description',
                    orderable: false, searchable: false,
                },
               
                {
                    data: 'price',
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
                    name: aData.name,
                    description: aData.description,
                    price: aData.price,
                    product_unit_measure_id: aData.product_unit_measure_id,
                    product_unit_measure_abrv: aData.product_unit_measure.abrv,
                    product_scale_id: aData.product_scale_id,
                    product_scale_value: aData.product_scale.value,
                    product_today: aData.product_today,
                    disponible: aData.disponible,
                };

                // globals
                $.fn.editable.defaults.mode = 'inline';
                $.fn.editable.defaults.pk = productId;
                $.fn.editable.defaults.url = "{{ route('admin.producto.updateAjaxProduct') }}";
                $.fn.editable.defaults.ajaxOptions = {
                    type: 'get',
                    dataType: 'json',
                };
                $.fn.editable.defaults.validate = function (value) {
                    if (!value) {
                        return toastr['error']('El campo esta vacio.');
                    }
                };

                $('td:eq(2)', nRow).html('<a class="myeditables-class" href="#">' + data.name + '</a>');
                $('td:eq(3)', nRow).html('<a class="myeditables-class" href="#">' + data.description + '</a>');
                $('td:eq(4)', nRow).html('<a class="myeditables-class" href="#">' + data.price + '</a>');
                $('td:eq(5)', nRow).html('<a class="myeditables-class" href="#">' + data.product_unit_measure_abrv + '</a>');
                $('td:eq(6)', nRow).html('<a class="myeditables-class" href="#">' + data.product_scale_value + '</a>');
                $('td:eq(7)', nRow).html('<a class="myeditables-class" href="#">' + (data.product_today == 0 ? 'NO' : 'SI') + '</a>');
                $('td:eq(8)', nRow).html('<a class="myeditables-class" href="#">' + data.disponible + '</a>');
             

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
               
                $('td:eq(8) a', nRow).editable({
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