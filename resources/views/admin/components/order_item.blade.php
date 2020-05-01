<select name="order" id="order" class="form-control"
        onchange="changeOrder(this.value, '{{ $itemId }}', '{{ $url }}')">
    <option value=""></option>
    @for($order = 1; $order <= $itemsSize; $order++)
        @if($item->order == $order)
            <option value="{{ $order }}" selected>{{ $order }}</option>
        @else
            <option value="{{ $order }}">{{ $order }}</option>
        @endif
    @endfor
</select>