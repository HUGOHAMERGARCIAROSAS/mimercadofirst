<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


<table border="1">
    <tbody>
    <tr>
        <th>First Name</th>
        <th>Metodo de pago</th>
        <th>E-mail</th>
    </tr>
    @foreach($order as $index=>$item)
        <tr>
            <td>{{ $item+1 }}</td>
            <td>{{ $item['payment_method'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>



</body>
</html>