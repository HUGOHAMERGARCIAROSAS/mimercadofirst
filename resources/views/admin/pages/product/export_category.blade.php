<!DOCTYPE html>
<html lang="en">
<head><meta charset="gb18030">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subcategorias</title>
</head>
<body>
    <table>
        <thead>
        <tr>															

            <th>ID</th>
            <th>Nombre</th>     
            <th>Razón social</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categorias as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->proveedor->razon_social }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>