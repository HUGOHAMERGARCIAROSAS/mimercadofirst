@foreach($products as $index => $item)
    <tr>
        <td>{{ $index+1 }}</td>
        <td>
            <select name="" id="" class="form-control"
                    onchange="changeOrder(this.value, {{ $item->id }})">
                <option value=""></option>
                @for($i = 1; $i <= count($products); $i++)
                    @if($item->order == $i)
                        <option value="{{ $i }}" selected>{{ $i }}</option>
                    @else
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endif
                @endfor
            </select>
        </td>
        <td>
            <a href="{{ assetImage($item->image) }}"
               data-lightbox="image-1">
                <img src="{{ assetImage($item->image) }}"
                     width="48" alt="">
            </a>
        </td>
        <td>{{ $item->name }}</td>
        <td>{{ priceInSole($item->price) }}</td>
        <td>{{ $item->productUnitMeasure->name }}</td>
        <td>
            <a href="{{ route('products.edit', $item) }}"
               class="btn btn-info btn-sm"
               title="Editar">
                <i class="fa fa-edit"></i>
            </a>
            <a href="#"
               data-url="{{ route('products.destroy', $item) }}"
               data-type="delete"
               class="btn btn-danger js-sweetalert btn-sm"
               title="Eliminar">
                <i class="fa fa-trash-o"></i>
            </a>
        </td>
    </tr>
@endforeach