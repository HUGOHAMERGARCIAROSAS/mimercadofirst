<a href="{{ $editUrl }}"
   class="btn btn-info btn-sm"
   title="Editar">
    <i class="fa fa-edit"></i>
</a>
<button data-url="{{ $deleteUrl }}"
        data-id="{{ $id }}"
        data-type="delete"
        class="btn btn-danger js-sweetalert btn-sm delete"
        title="Eliminar">
    <i class="fa fa-trash-o"></i>
</button>
