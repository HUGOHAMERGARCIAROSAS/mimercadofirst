
@foreach($subcategories as $index => $item)
    <tr>
        <td>
            {{ $index+1 }}
        </td>
        <td>
            <input type="text" class="form-control"
                   name="name"
                   onchange="updateColumn(this.value, '{{ $item->id }}', 'name', '{{ route('admin.subcategory.updateInTable') }}')"
                   value="{{ $item->name }}"
            >
        </td>
        <td align="center">
            <img src="{{asset('movil/img/subcategoria/'.$item->imagen)}}" width="10%" alt="">
        </td>
        <td>
            <button
                    data-toggle="modal"
                    data-target="#exampleModal_update_{{$item->id}}"
                    data-type="edit"
                    class="btn btn-info btn-sm"
                    title="Editar">
                <i class="fa fa-edit"></i>
            </button>

            <div class="modal fade" id="exampleModal_update_{{$item->id}}" tabindex="-1"
                role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered" role="document">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Actualizar Categoria</h5>
                           <button type="button" class="close" data-dismiss="modal"
                                   aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                           </button>
                       </div>
                       <form action="{{ route('subcategories-1.update', $item->id) }}"
                             method="post" enctype="multipart/form-data">
                           {{  csrf_field() }}
                           {{  method_field('PUT') }}
                           <div class="modal-body">
                               <div class="form-group">
                                   <label for="name">Nombre</label>
                                   <input id="name" type="text" class="form-control"
                                          value="{{ $item->name }}"
                                          name="name"
                                          required>
                               </div>
                               <div class="form-group">
                                   <label>Imagen </label>
                                   <input type="file" name="image" class="dropify"
                                          
                                          data-allowed-file-extensions="jpg png jpeg"
                                   >
                                   <span class="help-block">Dimension de imagen permitido: 181x181</span>
                                   <br>
                                   <span class="help-block">Tipo de imagen permitido: .png .jpg .jpeg</span>
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

            <button
                    data-url="{{ route('subcategories-1.destroy', $item->id) }}"
                    data-type="delete"
                    class="btn btn-danger js-sweetalert btn-sm"
                    title="Eliminar">
                <i class="fa fa-trash-o"></i>
            </button>
        </td>
    </tr>
@endforeach
