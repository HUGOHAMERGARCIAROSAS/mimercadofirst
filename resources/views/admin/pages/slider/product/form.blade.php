<div class="row clearfix">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Nombre <span class="required">*</span></label>
            <input type="text" class="form-control"
                   name="name"
                   value="{{ $sliderProduct->product->name or old('name') }}"
                   required
            >
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <label>Precio <span class="required">*</span></label>
            <input type="text" class="form-control"
                   name="price"
                   value="{{ $sliderProduct->product->price or old('price') }}"
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
                    @if(!empty($sliderProduct->product->image))
                        @if($item->id == $sliderProduct->product->productUnitMeasure->id)
                            <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endif
                    @endif
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
                    onchange="searchSubCategory(this.value, '{{ route('admin.product.searchSubCategory') }}')"
                    required>
                @foreach($categories as $item)
                    @if (!empty($sliderProduct) && ($item->id == $sliderProduct->product->productSubCategory->subCategory->category->id))
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="sub_category_id">Sub Categoría 1<span class="required">*</span></label>
            <select name="sub_category_id" class="form-control" id="sub_category_id"
                    onchange="searchSubCategory2(this.value, '{{ route('admin.product.searchSubCategory2') }}')"
                    required>
                @if (!empty($sliderProduct))
                    <option value="{{$sliderProduct->product->productSubCategory->subCategory->id}}"
                            selected>{{ $sliderProduct->product->productSubCategory->subCategory->name }}</option>
                @else
                    <option value="" selected>Seleccione una Categoria</option>
                @endif
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="product_sub_category_id">Sub Categoría 2<span class="required">*</span></label>
            <select name="product_sub_category_id" class="form-control" id="product_sub_category_id"
                    required>
                @if (!empty($sliderProduct))
                    <option value="{{$sliderProduct->product->productSubCategory->id}}"
                            selected>{{ $sliderProduct->product->productSubCategory->name }}</option>
                @else
                    <option value="" selected>Seleccione una Categoria</option>
                @endif
            </select>
        </div>
    </div>

    <div class="col-lg-12 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Imagen <span class="required">*</span></label>
            <input type="file" name="image" class="dropify"
                   @if(!empty($sliderProduct->product->image))
                   data-default-file="{{ asset('web/'. $sliderProduct->product->image) }}"
                   @endif
                   data-allowed-file-extensions="png"
            >
            <span class="help-block">Dimensión de imagen permitido: 350x350</span>
            <br>
            <span class="help-block">Tipo de imagen permitido: .png</span>
        </div>
    </div>

    <div class="col-lg-12 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Fondo <span class="required">*</span></label>
            <input type="file" name="background" class="dropify"
                   @if(!empty($sliderProduct->background))
                   data-default-file="{{ assetImage($sliderProduct->background) }}"
                   @endif
                   data-allowed-file-extensions="jpg png jpeg">
            <span class="help-block">Dimensión de imagen permitido: 1527x492</span>
            <br>
            <span class="help-block">Tipo de imagen permitido: .png .jpg .jpeg</span>
        </div>
    </div>

</div>

<hr>

<button type="submit" class="btn btn-primary">Guardar</button>
<a href="{{ route('slider.index') }}" class="btn btn-secondary">Cancelar</a>