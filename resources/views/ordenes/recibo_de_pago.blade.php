<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recibo de pago</title>
    <style>
        .content {
            margin: auto;
            width: 90%;
            padding: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .row {
            display: flex;
        }
        .column {
            flex: 50%;
            padding: 10px;
        }
    </style>
</head>
<body>

    <div class="content">
        <h1>Laboratorio de análisis clinicos QuechuLAB</h1>
        <p>Calle Allende #9 Col. Centro esquina con Benito Juárez. Tel. (747) 499-0495 </p>
        <hr>

        <div class="row">
            <div class="column">
                <p>Clave: {{$detalleOrden->id}}  {!!$codigoDeBarras!!}</p>
               
            </div>
            <div class="column">
                <p>Paciente: {{$paciente->nombre}} {{$paciente->apellido_paterno}} {{$paciente->apellido_materno}} </p>
                <p>Sexo: {{$paciente->sexo == "F" ? 'Femenino' : 'Masculino' }}   Edad: {{ \App\Helpers\Helpers::obtenerEdad($paciente->fecha_nacimiento) }} </p>
                <p>Dr(a): {{$detalleOrden->doctor}}</p>
                <p>Fecha de entrega: {{ \App\Helpers\Helpers::formatFecha(now()->format('d-m-Y')) }}   Hora de entrega: {{ now()->format('H:i:s') }}
                </p>
            </div>
        </div>
        <hr>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Estudios</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($estudios as $estudio)
                        <tr>
                            <td>{{$estudio->nombre}}</td>
                            <td>{{$estudio->precio}}</td>
                        </tr>
                    @endforeach
                    <p>Total: {{$detalleOrden->total}}</p>
                </tbody>
            </table>
        </div>
        <div>
            <p>Nota: Autorizo a Laboratorio de análisis clinicos QuechuLAB realice los estudios solicitados, conociendo los requisitos para la realización y riesgos del procedimiento de toma de muestra: Hematoma, Desmayo, Repeticion de la toma, Solicitud de nueva muestra.
                Acepto la responsabilidad de otorgar la concesión para realizar estudios en caso de no cumplir con los requisitos.
                El Laboratorio clinico se compromete a la confidencialidad de la información solicitada, excepto en los casos indicados por las autoridades competentes.
            </p>
        </div>
    </div>
  
</body>

</html>