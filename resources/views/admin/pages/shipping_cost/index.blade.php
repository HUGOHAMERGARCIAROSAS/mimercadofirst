@extends('admin.layouts.admin')

@section('css')
    <link href="{{ asset('admin/pyrus/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/pyrus/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/vendor/sweetalert/sweetalert.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/toastr/toastr.min.css') }}">
@endsection

@section('block-header')
    @component('admin.components.block-header')
        @slot('header_title')Tienda @endslot
        @slot('breadcrumb_item')
            <li class="breadcrumb-item">Costo de Envio</li>
        @endslot
        @slot('breadcrumb_item_active')
            <li class="breadcrumb-item active">Listado de costos</li>
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="col-md-12">
        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-plus-square"></i> Nuevo Costo de Envio
        </button>
    </div>

    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="body">
                @include('flash::message')
                <div class="table-responsive">
                    @component('admin.components.content_datatable')
                        @slot('datatable_header')
                            <tr>
                                <th width="50">Orden</th>
                                <th>Ubanización</th>
                                <th width="70">Tarifario</th>
                                <th>Acciones</th>
                            </tr>
                        @endslot

                        @slot('datatable_body')
                            <tbody>
                            @foreach($costs as $index => $item)
                                <tr>
                                    <td>
                                        <select name="order" id="order" class="form-control"
                                                onchange="changeOrder(this.value, {{ $item->id }})">
                                            <option value=""></option>
                                            @for($order = 1; $order <= count($costs); $order++)
                                                @if($item->order == $order)
                                                    <option value="{{ $order }}" selected>{{ $order }}</option>
                                                @else
                                                    <option value="{{ $order }}">{{ $order }}</option>
                                                @endif
                                            @endfor
                                        </select>
                                    </td>
                                    <td>{{ $item->urbanization }}</td>
                                    <td>
                                        <input type="text" class="form-control"
                                               name="cost"
                                               onchange="updateColumn(this.value, '{{ $item->id }}', 'cost', '{{ route('admin.shipping.updateInTable') }}')"
                                               value="{{ $item->cost }}"
                                        >
                                    </td>
                                    <td>
                                        <button class="btn btn-info btn-sm"
                                                data-toggle="modal"
                                                data-target="#modalUpdate"
                                                data-id="{{ $item->id }}"
                                                data-urbanization="{{ $item->urbanization }}"
                                                data-cost="{{ $item->cost }}"
                                                title="Editar">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <button class="btn btn-danger js-sweetalert btn-sm"
                                                data-url="{{ route('shipping-cost.destroy', $item->id) }}"
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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Costo de Envio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('shipping-cost.store') }}" method="post">
                    {{  csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="urbanization">Urbanización</label>
                            <input id="urbanization" type="text" class="form-control"
                                   name="urbanization"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="cost">Costo de Envio</label>
                            <input type="text" class="form-control"
                                   name="cost" id="cost"
                                   required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Actualizar Costo de Envio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_shipping_cost_update"
                      action="{{ route('shipping-cost.update', ['id' => ':ID']) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="urbanization">Urbanización</label>
                            <input id="urbanization" type="text" class="form-control"
                                   name="urbanization"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="cost">Costo de Envio</label>
                            <input type="text" class="form-control"
                                   name="cost" id="cost"
                                   required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
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

    @include('admin.layouts._delete-sweetalert')

    <script>
        $('#modalUpdate').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let id = button.data('id');
            let urbanization = button.data('urbanization');
            let cost = button.data('cost');
            let modal = $(this);
            modal.find(".modal-body input[name='urbanization']").val(urbanization);
            modal.find(".modal-body input[name='cost']").val(cost);

            let form = $('#form_shipping_cost_update');
            let form_url = form.attr('action').replace(':ID', id);
            form.attr('action', form_url);
        });

        function changeOrder(value, id) {
            let data = {
                'position': value,
                'id': id,
            };
            console.log(data);

            $.ajax({
                url: "{{ route('admin.shipping.updateOrder') }}",
                method: 'POST',
                data: data,
            }).done((response) => {
                toastr['success'](response.message);
            }).fail((error) => {
                console.log(error);
            });
        }


        function updateColumn(value, id, column, url) {
            let data = {
                value: value,
                column: column,
                "cost": value,
                id: id,
            };

            update(data, url);
        }
    </script>
@endsection