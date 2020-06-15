<div class="row clearfix">

    <div class="col-lg-2">
        <div class="form-group">
            <label>Orden </label>
            <input type="number" min="1" minlength="1" max="{{$totalProducts}}" maxlength="{{$totalProducts}}"
                   class="form-control"
                   oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                   value="{{ $product->orden or $totalProducts}}"
                   required
                   name="orden">
            <span class="help-block">Rango: 1 - {{ $totalProducts }}</span>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label>Nombre <span class="required">*</span></label>
            <input type="text" class="form-control"
                   name="name"
                   value="{{ $product->name or old('name') }}"
                   required
            >
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <label for="description">Descripción</label>
            <input type="text" class="form-control"
                   name="description" id="description"
                   value="{{ $product->description or old('description') }}"
                   max="30" maxlength="30"
            >
            <span class="help-block">Cantidad máxima de caracteres: 30</span>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <label>Precio <span class="required">*</span></label>
            <input type="text" class="form-control"
                   name="price"
                   value="{{ $product->price or old('price') }}"
                   required
            >
        </div>
    </div>
    <input type="hidden" class="form-control"
                   name="monto"
                   value="0"
                   required
            >
            <input type="hidden" class="form-control"
                   name="porcentaje"
                   value="0"
                   required
            >
            <input type="hidden" class="form-control"
                   name="final"
                   value="{{  $product->price or old('price') }}"
                   required
            >
            <input type="hidden" class="form-control"
                   name="provider_id"
                   value="{{  old('provider_id') }}"
                   required
            >

    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Unidades <span class="required">*</span></label>
            <select name="product_unit_measure_id" class="form-control"
                    required>
                @foreach($productUnitMeasure as $item)
                    @if(!empty($product)  && $item->id == $product->productUnitMeasure->id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <input type="hidden" class="form-control"
    name="provider_id"
    required value="{{auth()->user()->id}}"
    >
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="scale">Cantidad, Escala <span class="required">*</span></label>
            <select name="product_scale_id" class="form-control" id="scale"
                    required>
                @foreach($productScale as $item)
                    <option value="{{ $item->id }}" {{ (!empty($product) && $item->id == $product->product_scale_id)? 'selected': '' }}>{{ $item->value }}</option>
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
                <option value="" selected>Seleccione</option> <!--Agregue esta linea-->
                @foreach($categories as $item)
                    @if (!empty($product) && ($item->id == $product->category->id))
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
  <!-- DETALLE DEL PRODUCTO -->
    <div class="col-lg-3">
        <div class="form-group">
            <label>SKU <span class="required"></span></label>
            <input type="text" class="form-control"
                   name="sku"
                   value="{{ $product->sku or old('sku') }}"
            >
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label>Modelo <span class="required"></span></label>
            <input type="text" class="form-control"
                   name="modelo"
                   value="{{ $product->modelo or old('modelo') }}"
            >
        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-group">
            <label>País <span class="required"></span></label>
            <input type="text" class="form-control"
                   name="pais"
                   value="{{ $product->pais or old('pais') }}"
            >
        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-group">
            <label>Peso (kg) <span class="required"></span></label>
            <input type="number" class="form-control"
                   name="peso"
                   value="{{ $product->peso or old('peso') }}"
            >
        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-group">
            <label>Color <span class="required"></span></label>
            <input type="color" class="form-control"
                   name="color"
                   value="{{ $product->color or old('color') }}"
            >
        </div>
    </div>

    <div class="col-lg-3">
        <div class="form-group">
            <label>Material <span class="required"></span></label>
            <input type="text" class="form-control"
                   name="material"
                   value="{{ $product->material or old('material') }}"
            >
        </div>
    </div>
    <div class="col-lg-9">
        <div class="form-group">
            <label>Garantia del Producto <span class="required"></span></label>
            <input type="text" class="form-control"
                   name="garantia"
                   value="{{ $product->garantia or old('garantia') }}"
            >
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label>Condición del Producto <span class="required"></span></label>
            <input type="text" class="form-control"
                   name="condicion"
                   value="{{ $product->condicion or old('condicion') }}"
            >
        </div>
    </div>
    <div class="col-lg-5">
        <div class="form-group">
            <label>Detalle condición física del producto <span class="required"></span></label>
            <input type="text" class="form-control"
                   name="detalle_condicion"
                   value="{{ $product->detalle_condicion or old('detalle_condicion') }}"
            >
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label>¿Qué hay en la caja? <span class="required"></span></label>
            <input type="text" class="form-control"
                   name="caja"
                   value="{{ $product->caja or old('caja') }}"
            >
        </div>
    </div>

    <!--HASTA ACA ES EL DETALLE DEL PRODUCTO -->

    <div class="col-lg-12 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Imagen <span class="required">*</span></label>
            <input type="file" name="image" class="dropify"
                   @if(!empty($product->image))
                   data-default-file="{{ asset('web/'. $product->image) }}"
                   @endif
                   data-allowed-file-extensions="jpg png jpeg"
            >
            <span class="help-block">Dimension de imagen permitido: 350x350</span>
            <br>
            <span class="help-block">Tipo de imagen permitido: .png .jpg .jpeg</span>
        </div>
    </div>

</div>

<span class="help-block"><em>(<span class="required">*</span>) Todos los elementos son requeridos.</em></span>
<hr>
<button type="submit" class="btn btn-primary btn-lg">Guardar</button>
<a href="{{ route('products.index') }}" class="btn btn-secondary btn-lg m-l-10">Cancelar</a>