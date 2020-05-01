@foreach($subcategories as $index => $item)
    <tr>
        <td>
            {{ $index+1 }}
        </td>
        <td>
            <input type="text" class="form-control"
                   name="name"
                   onchange="updateColumn(this.value, '{{ $item->id }}', 'name', '{{ route('admin.productsubcategory.updateInTable') }}')"
                   value="{{ $item->name }}"
            >
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
                            <h5 class="modal-title" id="exampleModalLabel">Actualizar Sub Categoría 2</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('subcategories-2.update', $item) }}"
                              method="post">
                            {{  csrf_field() }}
                            {{  method_field('PUT') }}
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="category_id">Categoria</label>
                                    <select name="category_id" id="category_id" class="form-control"
                                            onchange="searchCategoryInModal(this.value)"
                                            required>
                                        @foreach($categories as $category)
                                            @if ($category->existCategory($category, $categoryId))
                                                <option value="{{$category->id}}"
                                                        selected>{{ $category->name }}</option>
                                            @else
                                                <option value="{{$category->id}}">{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="modal_sub_category_id">Sub Categoría 1</label>
                                    <select name="sub_category_id" id="modal_sub_category_id" class="form-control"
                                            required>
                                        @foreach($categories as $category)
                                            @if ($category->existCategory($category, $categoryId))
                                                @foreach($category->subCategories as $subcategory)
                                                    @if ($subcategory->id === $item->sub_category_id)
                                                        <option value="{{$subcategory->id}}" selected>{{ $subcategory->name }}</option>
                                                    @else
                                                        <option value="{{$subcategory->id}}">{{ $subcategory->name }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input id="name" type="text" class="form-control"
                                           value="{{ $item->name }}"
                                           name="name"
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

            <button
                    data-url="{{ route('subcategories-2.destroy', $item->id) }}"
                    data-type="delete"
                    class="btn btn-danger js-sweetalert btn-sm"
                    title="Eliminar">
                <i class="fa fa-trash-o"></i>
            </button>
        </td>
    </tr>
@endforeach
