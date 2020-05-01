@if ($modal)
    @foreach($subcategories as $item)
        <option value="{{ $item->id }}">{{ $item->name }}</option>
    @endforeach
@else
    <option value="">Mostras Sub Categorias 1</option>
    @foreach($subcategories as $item)
        <option value="{{ $item->id }}">{{ $item->name }}</option>
    @endforeach
@endif