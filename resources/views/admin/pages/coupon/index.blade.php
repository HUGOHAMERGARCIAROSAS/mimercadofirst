@extends('admin.layouts.admin')

@section('css')
    <link href="{{ asset('admin/pyrus/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/pyrus/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/vendor/sweetalert/sweetalert.css') }}" rel="stylesheet"/>
@endsection

@section('block-header')
    @component('admin.components.block-header')
        @slot('header_title')Tienda @endslot
        @slot('breadcrumb_item')
            <li class="breadcrumb-item">Cupones</li>
        @endslot
        @slot('breadcrumb_item_active')
            <li class="breadcrumb-item active">Listado de cupones</li>
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="col-md-12">
        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-plus-square"></i> Crear Cupones
        </button>
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
                                <th>#</th>
                                <th>Código</th>
                                <th>Descuento</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        @endslot

                        @slot('datatable_body')
                            <tbody>
                            @foreach($coupons as $index => $item)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ priceInSole($item->discount) }}</td>
                                    <td>
                                        @if ($item->state == \App\src\Models\Coupon::ESTADO_UTILIZADO)
                                            <span class="badge badge-danger">{{ "CUPÓN UTILIZADO" }}</span>
                                        @else
                                            <span class="badge badge-success">{{ "CUPÓN SIN UTLIZAR" }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <button
                                                data-url="{{ route('coupons.destroy', $item->id) }}"
                                                data-type="delete"
                                                class="btn btn-danger js-sweetalert btn-sm"
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Cupón</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('coupons.store') }}" method="post">
                    {{  csrf_field() }}
                    <div class="modal-body">
                        <?php $proveedor_id = auth()->user()->id; ?>
                        <input type="hidden" class="form-control"
                        name="proveedor_id"
                        required value="{{$proveedor_id}}"
                        >  
                        <div class="form-group">
                            <label for="code">Código</label>
                            <input id="code" type="text" class="form-control"
                                   name="code"
                                   max="20"
                                   maxlength="20"
                                   required>
                            <span class="help-block">Cantidad máxima de caracteres: 20</span> <br>
                            <span class="help-block">El cupón generado es único.</span>
                        </div>
                        <div class="form-group">
                            <button type="button"
                                    onclick="generateCode()"
                                    class="btn btn-success">Generar Código
                            </button>
                        </div>
                        <div class="form-group">
                            <label for="discount">Descuento</label>
                            <input type="text" class="form-control"
                                   name="discount" id="discount"
                                   required>
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
    @include('admin.layouts._delete-sweetalert')
    <script>
        function generateCode() {
            let randomNumber = Math.floor((Math.random() * 100) + 100);
            let randomLetter = Math.random().toString(36).substr(2, 2);
            let code = randomLetter.concat(randomNumber);
            $("input[name='code']").val(code);
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