<div class="row clearfix">

    <div class="col-lg-12">
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Nombre del Rol <span class="required">*</span></label>
            <div class="col-md-9">
                <input type="text" class="form-control"
                       name="name"
                       required
                >
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="description">Permisos</label>
            <div class="col-md-9">
                <label>Seleccione los permisos que este rol debería tener.</label>
                <div class="form-group">
                    @foreach($permissions as $item)
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="permissions[]"
                                   value="{{ $item->name }}"
                                   >
                            <span>{{ $item->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


</div>

<hr>
<button type="submit" class="btn btn-primary btn-lg">Guardar</button>
<a href="{{ route('products.index') }}" class="btn btn-secondary btn-lg">Cancelar</a>