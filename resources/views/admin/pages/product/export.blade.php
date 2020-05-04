<!DOCTYPE html>
<html lang="en">
<head><meta charset="gb18030">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
        <tr>															

            <th>ID</th>
            <th>orden</th>
            <th>id_del_proveedor</th>
            <th>nombre</th>
            <th>descripcion</th>
            <th>precio</th>
            <th>porcentaje</th>
            <th>monto</th>
            <th>precio_final</th>
            <th>unidades</th>
            <th>escala</th>
            <th>categoria</th>
            <th>sub_Categoria_1</th>
            <th>sub_Categoria_2</th>
            <th>oferta</th>
            <th>disponible</th>
            <th>proveedor</th>
        </tr>
        </thead>
        <tbody>
        @foreach($productos as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->orden }}</td>
                 @if (!isset($item->admin->codigo_proveedor ))
                <td> No se le asigno Codigo de Proveedor</td>
                @else
                <td>{{ $item->admin->codigo_proveedor }} </td>
                @endif
                <td>{{ $item->name }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->porcentaje }}</td>
                <td>{{ $item->monto }}</td>
                <td>{{ $item->final }}</td>
                <td>{{ $item->productUnitMeasure->abrv }}</td>
                <td>{{ $item->productUnitMeasure->name }}</td>
                    <?php 
                        $subcategoria2 = App\src\Models\ProductSubCategory::find($item->product_sub_category_id);
                        
                    ?>
                <td>
                    @if($subcategoria2 != null)
                        {{$item->productSubCategory->subCategory->category->id}}
                    @endif
                    @if($subcategoria2 == null)
                        No se le asigno Categoria
                    @endif
                </td>
                
                <td>
                    @if($subcategoria2 != null)
                        {{ $item->productSubCategory->subCategory->id }}  
                    @endif
                    @if($subcategoria2 == null)
                        No se le asigno Subcategoria1
                    @endif
                </td>
                <td>
                    @if($subcategoria2 != null)
                        {{ $item->productSubCategory->id }} 
                    @endif
                    @if($subcategoria2 == null)
                        No se le asigno Subcategoria2
                    @endif
                </td>
                <td>{{ $item->formatProductToday($item->product_today) }}</td>
                <td>{{ $item->disponible }}</td>
                @if (!isset($item->admin->nombres ))
                <td> No se le asigno Proveedor</td>
                @else
                <td>{{ $item->admin->nombres }} </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>