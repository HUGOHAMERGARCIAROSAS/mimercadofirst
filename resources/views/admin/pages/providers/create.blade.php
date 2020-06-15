@extends('admin.layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/dropify/css/dropify.min.css') }}">
@endsection

@section('block-header')
    @component('admin.components.block-header')
        @slot('header_title')Proveedores @endslot
        @slot('breadcrumb_item')
            <li class="breadcrumb-item"><a href="{{ route('admin.providers.index') }}">Proveedores</a></li>
        @endslot
        @slot('breadcrumb_item_active')
            <li class="breadcrumb-item active">Registrar</li>
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="body">
                @include('flash::message')
                <form method="POST" action="{{ route('admin.providers.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row clearfix">
                        <div class="form-group col-sm-4">
                            <label for="code">Departamento</label>
                            <select id="select_departamento" class="form-control" name="departamento_id" id="">
                                <option value="">Seleccione</option>
                                @foreach ($departamentos as $item)
                                    <option value="{{$item->idDepa}}" @if($item->idDepa == 15) selected @endif>{{$item->departamento}}</option>
                                @endforeach
                            </select>
                           
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="code">Provincia</label>
                            <select id="select_provincia" class="form-control" name="provincia_id" id="">
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
                    <div class="row clearfix">
                        
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>Ruc <span class="required">*</span></label>
                                <input type="text" minlength="10" maxlength="11" class="form-control"
                                    name="ruc"
                                    required
                                >
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Razon Social <span class="required">*</span></label>
                                <input type="text" class="form-control"
                                    name="razon_social"
                                    required
                                >
                            </div>
                        </div>
                        <input type="hidden" class="form-control"
                                    name="role"
                                    required value="provider"
                                >
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="description">Propietario</label>
                                <input type="text" class="form-control"
                                    name="propietario" id="apellidos" 
                                    
                                >
                                
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>DNI <span class="required">*</span></label>
                                <input type="text" minlength="8" maxlength="8" class="form-control"
                                    name="dni"
                                    required
                                >
                            </div>
                        </div>
                       
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Correo <span class="required">*</span></label>
                                <input type="email" minlength="5" class="form-control"
                                    name="correo"
                                    required
                                >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Telefono <span class=""></span></label>
                                <input type="text" minlength="5" class="form-control"
                                    name="telefono"
                                    required
                                >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Categoria <span class="required">*</span></label>
                                <select class="form-control" name="category_id" required id="category">
                                    <option value="">Seleccione</option>
                                    @foreach ($categorias_proveedor as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Sub Categoria <span class="required">*</span></label>
                                <select required name="sub_category_id" class="form-control" id="sub_category">
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                        </div>
                      
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label>Usuario <span class="required">*</span></label>
                                <input type="text" minlength="5" class="form-control"
                                    name="email"
                                    required
                                >
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label>Password <span class="required">*</span></label>
                                <input type="password" minlength="5" class="form-control"
                                    name="pass"
                                    required
                                >
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>Monto extra (%)<span class="required">*</span></label>
                                <input type="number"  step="0.01"  class="form-control"
                                    name="monto_extra"
                                    required
                                >
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Imagen <span class="required">*</span></label>
                                <input type="file" required name="image" class="dropify"
                                       data-allowed-file-extensions="jpg png jpeg"
                                >
                                <span class="help-block">Dimension de imagen permitido: 350x350</span>
                                <br>
                                <span class="help-block">Tipo de imagen permitido: .png .jpg .jpeg</span>
                            </div>
                        </div>
                    </div>

                    <span class="help-block"><em>(<span class="required">*</span>) Elementos requeridos.</em></span>
                    <hr>
                    <button type="submit" class="btn btn-primary btn-lg">Guardar</button>
                    <a href="{{ route('admin.providers.index') }}" class="btn btn-secondary btn-lg m-l-10">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('admin/assets/vendor/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('admin/light/assets/js/pages/forms/dropify.js') }}"></script>
    <script src="{{ asset('admin/pyrus/app.js') }}"></script>
    <script>
        $(function(params) {
            $('#category').on('change', onSelectSubCategoryChange);
    
        });
    
        function onSelectSubCategoryChange(params) {
            var category_id = $(this).val();
            if (!category_id) {
                 $('#sub_category').html('<option value="">Seleccione</option>');
                 return;
            }
            $.get('/categoria/'+category_id+'/buscar',function(data){
                var html_select = '<option value="">Seleccione</option>';
                for (let i = 0; i < data.length; i++)
                   html_select += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
                   $('#sub_category').html(html_select);         
            });
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