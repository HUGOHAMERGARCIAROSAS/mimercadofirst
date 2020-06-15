@extends('admin.layouts.admin')
@section('css')
    <link href="{{ asset('admin/pyrus/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/pyrus/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/vendor/sweetalert/sweetalert.css') }}" rel="stylesheet"/>
@endsection

@section('block-header')
    @component('admin.components.block-header')
        @slot('header_title')Tienda @endslot
        @slot('breadcrumb_item') @endslot
        @slot('breadcrumb_item_active')
            <li class="breadcrumb-item active">Listado de pedidos</li>
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="body">
                @include('flash::message')
                <div class="table-responsive">
                    @component('admin.components.content_datatable')
                        @slot('datatable_header')
                            <tr>
                                <th>#</th>
                                <th>Usuario</th>
                                <th>Telefono</th>
                                <th>Correo</th>
                                <th>Proveedor</th>
                                <th>Dirección de Envió</th>
                                <th>Zona</th>
                                <th>Medio de Pago</th>
                                <th>Fecha</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        @endslot

                        @slot('datatable_body')
                            <tbody>
                            @foreach($orders as $index => $order)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $order->user->name. ' ' . $order->user->last_name }}</td>
                                    <td>{{ $order->user->phone }}</td>
                                    <td>{{ $order->user->email }}</td>
                                    <td>{{ $order->orderDetail[0]->product->admin->razon_social }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $order->shippingCost->zona }}</td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.order.export', $order) }}"
                                        class="btn btn-success btn-sm">
                                            <i class="fa fa-file-excel-o"></i>
                                        </a>
                                        <a href="{{ route('admin.order.show', $order) }}"
                                           class="btn btn-info btn-sm"
                                           title="Ver">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <button data-url="{{ route('admin.order.destroy', $order) }}"
                                                data-id="{{ $order->id }}"
                                                data-type="delete"
                                                class="btn btn-danger js-sweetalert btn-sm delete"
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