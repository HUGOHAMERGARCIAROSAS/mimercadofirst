@extends('admin.layouts.admin')
@section('css')
    <link href="{{ asset('admin/pyrus/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/pyrus/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('block-header')
    @component('admin.components.block-header')
        @slot('header_title')Suscriptores @endslot
        @slot('breadcrumb_item') @endslot
        @slot('breadcrumb_item_active')
            <li class="breadcrumb-item active">Listado de suscriptores</li>
        @endslot
    @endcomponent
     <a href="{{ route('admin.subscriber.exportSubscribers') }}" class="btn btn-success btn-lg ml-15"
                   title="Exportar en Excel">
                    <i class="fa fa-file-excel-o"></i>
         </a>
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
                                <th>E-Mail</th>
                                <th>Fecha de Subscripción</th>
                            </tr>
                        @endslot
                        @slot('datatable_body')
                            <tbody>
                            @foreach($subscribers as $index => $subscriber)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $subscriber->email }}</td>
                                    <td>{{ $subscriber->created_at->format('d-m-Y') }}</td>
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
@endsection