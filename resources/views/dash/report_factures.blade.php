<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<style>
table {
  table-layout: fixed;
  width: 100%;
  border: 1px solid black;
  text-align:center;
}

thead th{
    width: auto;
}

tbody tr:nth-child(odd) {
  background-color: #E8E5E5;
}

tbody tr:nth-child(even) {
  background-color: #F5F3F2;
}


</style>

<table class="table-primary">
    <thead>
        <tr>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th>Documento</th>
            <th>Tipo documento</th>
            <th>Factura</th>
            <th>Fecha factura</th>
            <th>Estado factura</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad pedida</th>
            <th>Categoria</th>
        </tr>
    </thead>
    <tbody>
        @foreach($facturas as $factura)
        <tr>
            <td>{{ $factura->Nombres }} </td>
            <td>{{ $factura->apellidos }} </td>
            <td>{{ $factura->direccion }} </td>
            <td>{{ $factura->telefono }} </td>
            <td>{{ $factura->cedula }} </td>
            <td>{{ $factura->tipo_documento }} </td>
            <td>{{ $factura->id }} </td>
            <td>{{ $factura->created_at }} </td>
            <td>{{ $factura->status }} </td>
            <td>{{ $factura->nombres_productos }} </td>
            <td>{{ $factura->valor }} </td>
            <td>{{ $factura->quantity }} </td>
            <td>{{ $factura->nombre_catego }} </td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
