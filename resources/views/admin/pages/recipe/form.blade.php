<div class="row clearfix">
    <div class="col-lg-10">
        <div class="form-group">
            <label>Titulo</label>
            <input type="text" class="form-control"
                   name="title"
                   value="{{ $recipe->title or old('title') }}"
                   required>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-group">
            <label>Fecha</label>
            <input type="date" class="form-control"
                   name="date"
                   value="{{ $recipe->date or old('date') }}"
                   required>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea id="description" type="text" class="form-control summernote"
                      name="description"
                      rows="5"
                      required
            >{{  $recipe->description or old('description') }}</textarea>
        </div>
    </div>
    <div class="col-lg-12 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Imagen</label>
            <input type="file" name="image" class="dropify"
                   @if(!empty($recipe->image))
                   data-default-file="{{ assetImage($recipe->image) }}"
                   @endif
                   data-allowed-file-extensions="jpg png jpeg">
            <span class="help-block">Dimension de imagen permitido: 1700x810 </span>
            <br>
            <span class="help-block">Tipo de imagen permitido: .png .jpg .jpeg</span>
        </div>
    </div>
</div>
<br>
<button type="submit" class="btn btn-primary btn-lg">Guardar</button>
<a href="{{ route('recipes.index') }}" class="btn btn-default btn-lg">Cancelar</a>