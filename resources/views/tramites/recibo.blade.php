<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recibo</title>
</head>

<style>

    @page{
        size:58mm 110mm;
        margin: 5;
    }

    #wrapper{
        color: #000;
        font-family: Arial,Helvetica;
    }

    .receipt-header{
        margin-bottom: 20px;
    }

    .receipt-header h1{
        font-family: Arial,Helvetica;
        font-size: 12px;
        text-align: center;
    }

    .content{
        font-size: 10px;
    }

    .content p{
        margin: 0;
        margin-bottom: 5px;
    }

    .title{
        text-align: center;
    }

    .total{
        font-size: 14px;
    }

    .footer p{
        margin:0;
        font-size: 10px;
    }

</style>

<body>
    <div id="wrapper">

        <div class="receipt-header">

            <h1>GOBIERNO DEL ESTADO DE MICHOACÁN DE OCAMPO DIRECCIÓN DEL REGISTRO PÚBLICO DE LA PROPIEDAD</h1>

        </div>

        <div class="content">

            <p class="title">CALIFICACIÓN DE INSCRIPCIONES</p>
            <p>Fecha: {{Carbon\Carbon::now()->format('d-m-Y')}}</p>
            <p>Trámite: {{ now()->format('Y') . '-' .$tramite->numero_control }}</p>
            <p>Servicio: {{ $tramite->servicio->nombre }}</p>
            <p>Tipo de servicio: {{ $tramite->tipo_servicio }}</p>
            <p>Orden de pago: {{ $tramite->orden_de_pago }}</p>

        </div>

        <div class="total">

            <p>Total a pagar: ${{ $tramite->monto }}</p>

        </div>

        <div class="footer">
            <p>LA VIGENCIA PARA EL PAGO DE ESTE TRÁMITE ES: {{ $tramite->limite_de_pago }}.</p>
        </div>

    </div>

</body>
</html>
