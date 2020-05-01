<div class="row clearfix">
    <div class="col-lg-12">
        <div class="form-group">
            <label>Titulo</label>
            <input type="text" class="form-control"
                   name="title"
                   value="{{ $tip->title or old('title') }}"
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
            >{{  $tip->description or old('description') }}</textarea>
        </div>
    </div>

    <div class="col-lg-12 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Imagen</label>
            <input type="file" name="image" class="dropify"
                   @if(!empty($tip->image))
                   data-default-file="{{ assetImage($tip->image) }}"
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
<a href="{{ route('tips.index') }}" class="btn btn-default btn-lg">Cancelar</a>