<!DOCTYPE html>
<html>
<head>
    <title>Etiqueta</title>
    <style>
        /* Asegúrate de que los estilos se ajusten a las especificaciones de tu impresora de etiquetas */
        body {
            font-family: 'Arial', sans-serif;
            width: 4in; /* Ajusta el ancho al tamaño de tus etiquetas */
            height: 6in; /* Ajusta la altura al tamaño de tus etiquetas */
        }
        .etiqueta {
            border: 1px solid #000;
            padding: 10px;
            margin: 10px;
        }
    </style>
</head>
<body>
    @foreach ($muestras as $muestra)
        <div class="etiqueta">
            <h2>Paciente: {{$paciente}}</h2>
            <p>tipo de muestra: {{$muestra}}</p>
            <p>estudios:{{$estudiosMuestra = $estudios[array_search($muestra, $muestras)]}}</p>
            <p>orden: {{$detalleOrden_id}} {!!$codigoDeBarras!!}</p>
        </div>
    @endforeach

</body>
</html>
