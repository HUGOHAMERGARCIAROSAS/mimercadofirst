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
    <div class="col-md-12">
        <a href="{{ route('admin.users.rol.create') }}" class="btn btn-primary btn-lg">
            <i class="fa fa-plus-square"></i> Nuevo Rol
        </a>
    </div>

    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="body">
                @include('flash::message')
                <div class="table-responsive">
                    <table id="basic-datatable" class="table table-striped table-sm c_list">
                        <thead>
                        <tr>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--@foreach($roles as $index => $item)--}}
                            {{--<tr>--}}
                                {{--<td>{{ $item->name }}</td>--}}
                                {{--<td></td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}
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