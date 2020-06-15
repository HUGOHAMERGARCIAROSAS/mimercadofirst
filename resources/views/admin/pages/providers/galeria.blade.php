@extends('admin.layouts.admin')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/dropzone.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/magnific-popup.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <style type="text/css">
		.img-responsive1 {
		    width: 100%;
		    height: 100px;
		    display: inline-block;
		}
	</style>
@endsection
@section('content')
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Galeria de Producto: {{$producto->name}}</h2>
            <div align="right">
                <a class="btn btn-primary" href="#"><i class="fa fa-mail-reply"> ATRAS</i></a>
            </div>       
    <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <form action="{{route('productos.galeria.agregar',$producto->id)}}" method="POST" class="dropzone" id="miDropzone"  >
            {{ csrf_field() }}						
            <div class="fallback">
                <input name="img" type="file" multiple />
            </div>
            
        </form>
        <small>Tamaño (1100 x 760) </small>
        <div class="row m-t-30 el-element-overlay">
            <div class="col-md-12">                    		
                <h4 class="card-title">Galería</h4>
            </div>
            @if( count($galeria) <= 0)
                <div class="col-md-4">
                    <div class="alert alert-warning">No hay imagenes en la galería</div>         			
                </div>
            @else
                @foreach($galeria as $row)
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="el-card-item">
                                <div class="el-card-avatar el-overlay-1"> <img class="img-responsive1" src="{{ asset('./galeria_productos/'.$row->img) }}" alt="user" />
                                    <div class="el-overlay" align="center" style="padding-top: 10px;">                                   
                                            <a class="btn default btn-success image-popup-vertical-fit" href="{{ asset('./galeria_productos/'.$row->img) }}"><i class="fa fa-search"></i></a>
                                            <a class="btn default btn-danger delete" href="" data-id="{{$row->id}}"><i class="fa fa-trash"></i></a>                            
                                    </div>
                                </div>
                                <div class="el-card-content">
                                    <h5 class="box-title">{{ $row->img }}</h5></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dropzone.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
      	/*Inicializamos Magnific Popup*/
          $('.image-popup-vertical-fit').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            mainClass: 'mfp-img-mobile',
            image: {
                verticalFit: true
            },
            gallery: {
                enabled: true
            }			
        });	

        $('.delete').on('click', function(e){
		    	e.preventDefault();
				var id = $(this).data('id');
				var link = '/productos/galeria-delete/';
				swal({
					title: "¿Estás seguro?",   
						text: "¡No podrás recuperar este registro!",   
						type: "warning",   
						showCancelButton: true,   
						confirmButtonColor: "#DD6B55",   
						confirmButtonText: "Sí, eliminarlo!",   
						closeOnConfirm: false 
				},
				function() {
					$.ajax({
						type: "get",
						url: link+id,
						data: {slider_id: id},
						success: function (data) {
									swal("Eliminado!", "El registro ha sido eliminado.", "success");
									location.reload();
									
							}
					});
				});
		    });
    });
    /*Configuracion de Dropzone*/
    Dropzone.options.miDropzone = {
        uploadMultiple: true,
        parallelUploads: 50,
        maxFilesize: 100,
        addRemoveLinks: false,
        dictDefaultMessage: 'Click, para agregar fotos',
        dictRemoveFile: 'Eliminar',
        dictFileTooBig: 'No puede ser más de 16MB',
       // timeout: 10000,
        success: function (file, done) {
          location.reload();
        }
    };
</script>

@endsection