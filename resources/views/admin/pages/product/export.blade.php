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
            <th>Orden</th> 
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>       
            <th>Unidades</th>
            <th>Escala</th>
            <th>Categoria</th>
            <th>Oferta</th>
            <th>Disponible</th>
            <th>SKU</th>
            <th>país</th>
            <th>Peso(kg)</th>
            <th>Color(Hexadeximal)</th>
            <th>Material</th>
            <th>Garantia</th>
            <th>Condicion</th>
            <th>Detalle condición</th>
            <th>Caja</th>
            <th>Modelo</th>
        </tr>
        </thead>
        <tbody>
        @foreach($productos as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->orden }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->productUnitMeasure->abrv }}</td>
                <td>{{ $item->productUnitMeasure->name }}</td>
                <td>{{ $item->category->name}}</td>
                <td>{{ $item->formatProductToday($item->product_today) }}</td>
                <td>{{ $item->disponible }}</td>
                <td>{{ $item->sku }}</td>
                <td>{{ $item->pais }}</td>
                <td>{{ $item->peso }}</td>
                <td>{{ $item->color }}</td>
                <td>{{ $item->material }}</td>
                <td>{{ $item->garantia }}</td>
                <td>{{ $item->condicion }}</td>
                <td>{{ $item->detalle_condicion }}</td>
                <td>{{ $item->caja }}</td>
                <td>{{ $item->modelo }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>