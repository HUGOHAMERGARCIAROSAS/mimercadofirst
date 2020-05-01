<div class="row clearfix">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Nombre <span class="required">*</span></label>
            <input type="text" class="form-control"
                   name="name"
                   value="{{ $slider->product->name or old('name') }}"
                   required
            >
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <label>Precio <span class="required">*</span></label>
            <input type="text" class="form-control"
                   name="price"
                   value="{{ $slider->product->price or old('price') }}"
                   required
            >
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Unidades <span class="required">*</span></label>
            <select name="product_unit_measure_id" class="form-control"
                    required>
                @foreach($productUnitMeasure as $item)
                    {{--@if(!empty($product->image))--}}
                        {{--@if($item->id == $product->productUnitMeasure->id)--}}
                            {{--<option value="{{ $item->id }}" selected>{{ $item->name }}</option>--}}
                        {{--@else--}}
                            {{--<option value="{{ $item->id }}">{{ $item->name }}</option>--}}
                        {{--@endif--}}
                    {{--@endif--}}
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="scale">Cantidad, Escala <span class="required">*</span></label>
            <select name="product_scale_id" class="form-control" id="scale"
                    required>
                @foreach($productScale as $item)
                    <option value="{{ $item->id }}">{{ $item->value }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="category">Categoria <span class="required">*</span></label>
            <select name="category_id" class="form-control" id="category"
                    required>
                @foreach($categories as $item)
                    @if (!empty($product) && $item->id == $product->category_id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-12 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Imagen <span class="required">*</span></label>
            <input type="file" name="image" class="dropify"
                   @if(!empty($slider->product->image))
                   data-default-file="{{ asset('web/'. $slider->product->image) }}"
                   @endif
                   data-allowed-file-extensions="jpg png jpeg"
            >
            <span class="help-block">Dimension de imagen permitido: 350x350</span>
            <br>
            <span class="help-block">Tipo de imagen permitido: .png</span>
        </div>
    </div>

    <div class="col-lg-12 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Fondo</label>
            <input type="file" name="background" class="dropify"
                   @if(!empty($slider->background))
                   data-default-file="{{ asset('web/'. $slider->background) }}"
                   @endif
                   data-allowed-file-extensions="jpg png jpeg">
            <span class="help-block">Dimension de imagen permitido: 1520x494</span>
            <br>
            <span class="help-block">Tipo de imagen permitido: .png .jpg .jpeg</span>
        </div>
    </div>

</div>

<hr>

<button type="submit" class="btn btn-primary">Guardar</button>
<a href="{{ route('slider.index') }}" class="btn btn-secondary">Cancelar</a>