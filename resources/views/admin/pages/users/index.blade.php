@extends('admin.layouts.admin')
@section('css')
    <link href="{{ asset('admin/pyrus/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/pyrus/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('block-header')
    @component('admin.components.block-header')
        @slot('header_title')Usuarios @endslot
        @slot('breadcrumb_item') @endslot
        @slot('breadcrumb_item_active')
            <li class="breadcrumb-item active">Listado de usuarios</li>
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="body">
                @include('flash::message')
                <div class="table-responsive">
                    <table id="basic-datatable" class="table table-striped table-sm c_list">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>E-mail</th>
                            <th class="text-center">Telefono</th>
                            <th class="text-center">DNI</th>
                            <th class="text-center">Fecha de registro</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $index => $person)
                            <tr>
                                <td>{{ $person->name . ' ' . $person->last_name }}</td>
                                <td>{{ $person->email }}</td>
                                <td class="text-center">{{ $person->phone }}</td>
                                <td class="text-center">{{ $person->document }}</td>
                                <td class="text-center">{{ $person->created_at->format('d-m-Y') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
@endsection