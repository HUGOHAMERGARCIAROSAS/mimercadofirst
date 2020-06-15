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
                                <th>Distrito / Provincia / Departamento</th>
                                <th>Zona</th>
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
                                    <td>{{ $item->distrito->distrito }} / {{$item->distrito->provincia->provincia}} / {{$item->distrito->provincia->departamento->departamento}}  </td>
                                    <td>{{$item->zona}}</td>
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
                                                data-zona="{{ $item->zona }}"
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
                        <div class="row clearfix">
                            <div class="form-group col-sm-4">
                                <label for="code">Departamento</label>
                                <select id="select_departamento" class="form-control"  id="">
                                    <option value="">Seleccione</option>
                                    @foreach ($departamentos as $item)
                                        <option value="{{$item->idDepa}}" @if($item->idDepa == 15) selected @endif>{{$item->departamento}}</option>
                                    @endforeach
                                </select>
                               
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="code">Provincia</label>
                                <select id="select_provincia" class="form-control" id="">
                                    @foreach ($provincias as $item)
                                    <option value="{{$item->idProv}}" @if($item->idProv == 127) selected @endif>{{$item->provincia}}</option>
                                    @endforeach
                                </select>         
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="code">Distrito</label>
                               <select id="select_distrito" class="form-control" name="distrito_id" id="">
                                    @foreach ($distritos as $item)
                                    <option value="{{$item->idDist}}" @if($item->idDist == 1292) selected @endif>{{$item->distrito}}</option>
                                    @endforeach
                               </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="zona">Zona</label>
                            <input type="text" class="form-control"
                                   name="zona" id="zona"
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
                            <label for="zona">Zona</label>
                            <input id="zona" type="text" class="form-control"
                                   name="zona"
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
            let zona = button.data('zona');
            let cost = button.data('cost');
            let modal = $(this);
            modal.find(".modal-body input[name='zona']").val(zona);
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
    <script>
        $(function(params) {
            $('#select_departamento').on('change', onSelectDepartamentoChange);
    
        });
    
        function onSelectDepartamentoChange(params) {
            var departamento_id = $(this).val();
            if (!departamento_id) {
                 $('#select_provincia').html('<option value="">Provincia</option>');
                 return;
            }
            $.get('/departamento/'+departamento_id+'/provincia',function(data){
                var html_select = '<option value="">Provincia</option>';
                for (let i = 0; i < data.length; i++)
                   html_select += '<option value="'+data[i].idProv+'">'+data[i].provincia+'</option>';
                   $('#select_provincia').html(html_select);     
                   $('#select_distrito').html('<option value="">Distrito</option>');     
            });
        }

        
        </script>
         <script>
            $(function(params) {
                $('#select_provincia').on('change', onSelectProvinciaChange);
        
            });
        
            function onSelectProvinciaChange(params) {
                var provincia_id = $(this).val();
                if (!provincia_id) {
                     $('#select_distrito').html('<option value="">Distrito</option>');
                     return;
                }
                $.get('/provincia/'+provincia_id+'/distrito',function(data){
                    var html_select = '<option value="">Distrito</option>';
                    for (let i = 0; i < data.length; i++)
                       html_select += '<option value="'+data[i].idDist+'">'+data[i].distrito+'</option>';
                       $('#select_distrito').html(html_select);         
                });
            }
    
            
            </script>
@endsection