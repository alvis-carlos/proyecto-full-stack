<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<style>
    .title{
        text-align: center;
    }
    .container{
        width: 100%;
        height: 300px;
    }
    .container .company{
        display: inline;
        float: left;
        padding-right: 310px;
    }
    .container .client{
        display: inline;
        float: right;
        padding-left: 310px;
    }

    table {
        width: 100%;
        border: 1px solid #999;
        text-align: left;
        border-collapse: collapse;
        margin: 0 0 1em 0;
        caption-side: top;
    }
    .th_{
        background: #36579D;
        padding: 0.3em;
        color: white;
    }
    th, td {
        width: 100%;
    }
    hr{
        background: #36579D;
    }
</style>

<p class='title'>FACTURA</p>

<div class="container">
    <hr>
        <div class="company">
            <div class="col mx-auto">
                <p>EMPRESA: Uninpahu</p>
                <p>NIT: 23532454</p>
                <p>ID orden: {{ $order['id'] }}</p>
            </div>
            <div class="col mx-auto">
                <p>ESTADO ORDEN: {{ $order['status'] }}</p>
                <p>FECHA DE PAGO: {{ $order['created_at'] }}</p>
                <p>TOTAL PAGADO: {{ $total }}</p>
            </div>
        </div>
        <div class="client">
            <p>NOMBRE: {{ $profile['Nombres'] }}</p>
            <p>APELLIDO: {{ $profile['apellidos'] }}</p>
            <p>CELULAR/TELEFONO: {{ $profile['telefono'] }}</p>
            <p>DIRECCIÓN: {{ $profile['direccion'] }}</p>
            <p>DOCUMENTO IDENTIDAD:  {{ $profile['cedula'] }}-{{ $profile['tipo_documento'] }} </p>
        </div>
</div>

<hr>

        <br><br>
            <table>
                    <tr>
                        <th class='th_'>SKU</th>
                        <th class='th_'>Nombre Producto</th>
                        <th class='th_'>Valor</th>
                        <th class='th_'>Cantidad</th>
                        <th class='th_'>Total</th>
                    </tr>
                    @foreach($details as $detail)
                    <tr>
                        <th>{{ $detail['id'] }}</th>
                        <th>{{ $detail['nombres_productos'] }}</th>
                        <th>{{ $detail['valor'] }}</th>
                        <th>{{ $detail['quantity'] }}</th>
                        <th>{{ $detail['total'] }}</th>
                    </tr>
                    @endforeach
            </table>
    
            <br><br>
<footer id="footer" class="text-center text-lg-start bg-light text-muted">
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        Gracias por su compra
  </div>
</footer>
</body>
</html>