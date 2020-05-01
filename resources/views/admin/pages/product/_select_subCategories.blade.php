<option value="">Seleccione</option>
@foreach($subcategories as $item)
    <option value="{{ $item->id }}">{{ $item->name }}</option>
@endforeach