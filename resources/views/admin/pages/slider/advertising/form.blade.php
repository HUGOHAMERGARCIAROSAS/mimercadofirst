<div class="row clearfix">
    <div class="col-lg-12 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Imagen para Web <span class="required">*</span></label>
            <input type="file" name="image_desktop" class="dropify"
                   @if(!empty($sliderAdvertising->image_desktop))
                   data-default-file="{{ assetImage($sliderAdvertising->image_desktop) }}"
                   @endif
                   data-allowed-file-extensions="jpg png jpeg">
            <span class="help-block">Dimensión de imagen permitido: 1527x492</span>
            <br>
            <span class="help-block">Tipo de imagen permitido: .png .jpg .jpeg</span>
        </div>
    </div>

    <div class="col-lg-12 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Imagen para Móvil <span class="required">*</span></label>
            <input type="file" name="image_mobile" class="dropify"
                   @if(!empty($sliderAdvertising->image_mobile))
                   data-default-file="{{ assetImage($sliderAdvertising->image_mobile) }}"
                   @endif
                   data-allowed-file-extensions="jpg png jpeg"
            >
            <span class="help-block">Dimensión de imagen permitido: 480x255</span>
            <br>
            <span class="help-block">Tipo de imagen permitido: .png .jpg .jpeg</span>
        </div>
    </div>
</div>

<hr>

<button type="submit" class="btn btn-primary">Guardar</button>
<a href="{{ route('slider.index') }}" class="btn btn-secondary">Cancelar</a>