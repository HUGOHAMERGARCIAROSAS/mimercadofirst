<div class="row clearfix">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="user">Usuario</label>
            <input type="text" class="form-control"
                   name="user" id="user"
                   value="{{ $comment->user or old('user') }}"
                   max="20" maxlength="20"
                   required>
            <span class="help-block">Cantidad máxima de caracteres: 20</span>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="comment">Comentario</label>
            <textarea class="form-control"
                      name="comment" id="comment"
                      cols="30" rows="3"
                      maxlength="150"
                      required
            >{{ $comment->comment or old('comment') }}</textarea>
            <span class="help-block">Cantidad máxima de caracteres: 150</span>
        </div>
    </div>

    <div class="col-lg-12 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Imagen</label>
            <input type="file" name="image" class="dropify"
                   @if(!empty($comment->image))
                   data-default-file="{{ assetImage($comment->image) }}"
                   @endif
                   data-allowed-file-extensions="jpg png jpeg">
            <span class="help-block">Dimension de imagen permitido: 160x160</span>
            <br>
            <span class="help-block">Tipo de imagen permitido: .png .jpg .jpeg</span>
        </div>
    </div>
</div>
<br>
<button type="submit" class="btn btn-primary btn-lg">Guardar</button>
<a href="{{ route('comments.index') }}" class="btn btn-default btn-lg">Cancelar</a>