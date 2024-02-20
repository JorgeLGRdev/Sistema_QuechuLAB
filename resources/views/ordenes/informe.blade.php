<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informe de resultados</title>
    <style>
           @page {
            margin: 0cm 0cm;
        }

        header {
            position: fixed;
            top: 0cm;
            left: 1cm;
            right: 1cm;
            height: 2cm;

            /** Aquí puedes estilizar tu membrete **/
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 4.5cm 1cm 1cm;
        }

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
            padding: 1px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
       
        .texto-negrita {
            font-weight: bold;
        }
        .texto-pequeno {
            font-size: small;
        }
        .texto-extra-pequeno {
            font-size: 12px;
        }
        .text-right{
            text-align: right;
        }
        .text-left{
            text-align: left;
        }
        .text-center{
            text-align: center;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 1cm;
            right: 1cm;
            height: 2cm;
        }
    </style>
</head>
<body>
  <header>
    <div>
        <table>
            <tbody class="texto-pequeno">
                <tr>
                    <td><img src="{{ public_path('images/quechulab-logo.jpeg') }}" alt="Icono" width="130" height="100">
                    </td>
                    <td class="text-left">
                        <p class="texto-negrita">Quechultenango, Gro</p>
                        
                        <p class="texto-extra-pequeno">Calle Allende #9, Col. Centro,</p>
                        <p class="texto-extra-pequeno">esquina con Benito Juárez a un costado</p>
                        <p class="texto-extra-pequeno">de la Iglesia Santiago Apostol C.P. 39250</p>
                    </td>
                    <td class="text-right">
                        <p class="texto-negrita">747 499 0495</p>
                        <p class="texto-negrita">Q.B.P. Jesús Isaí</p>
                        <p class="texto-extra-pequeno">Dozal Barrios</p>
                        <p class="texto-extra-pequeno">CED. PROF. 11888986</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
  </header>
    <div>
        <table>
            <tbody class="texto-pequeno">
                <tr>
                    <td colspan="3" class="texto-negrita"> 
                        Paciente: {{$paciente->apellido_paterno}} {{$paciente->apellido_materno}} {{$paciente->nombre}}
                    </td>
                </tr>
                <tr>
                    <td>
                        Edad: {{ \App\Helpers\Helpers::obtenerEdad($paciente->fecha_nacimiento) }}
                    </td>
                    <td>
                        Sexo: {{$paciente->sexo === 'F' ? 'Femenino': 'Masculino'}}
                    </td>
                    <td></td>
                    <td class="texto-negrita">{{$detalleOrden->id}}</td>
                </tr>
                <tr>
                    <td colspan="2">PARTICULAR</td>
                    <td>Fecha: {{ \App\Helpers\Helpers::formatFecha($detalleOrden->created_at) }}</td>
                    <td>{!!$codigoDeBarras!!}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        Impresión: {{\App\Helpers\Helpers::obtenerDia()}}, {{ \App\Helpers\Helpers::formatFecha(now()->format('d-m-Y')) }}, {{date('H:i')}}
                    </td>
                    <td>
                        Hora: {{ \App\Helpers\Helpers::formatHora($detalleOrden->created_at) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        Dr(a). : {{$detalleOrden->doctor}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <hr>
    <table>
        <thead>
            <tr class="texto-pequeno">
                <th>ESTUDIO</th>
                <th>RESULTADO</th>
                <th>UNIDADES</th>
                <th colspan="3">VALORES DE REFERENCIA</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($estudios as $index => $estudio)
                
                    @if ($estudio->es_perfil ==='s')
                    <tr class="texto-pequeno">
                            <td class="texto-negrita">
                                <p>
                                    {{$estudio->nombre}} 
                                </p>
                                <p class="texto-extra-pequeno">
                                    Método: {{$estudio->metodo}}
                                </p>
                            </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @else 
                        @if ($estudio->reporte_especial === 'S')
                        <tr class="texto-pequeno"> 
                            <td><p>{{$estudio->nombre}}</p></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                           
                            @php
                                $resultadosAux = \App\Helpers\Helpers::obtenerResultados($estudio->id, $detalleOrden->id);               
                            @endphp
                            @if (!$resultadosAux->isEmpty())
                                @foreach ($resultadosAux as $resultado)
                                    <tr class="texto-pequeno">
                                        <td>{{$resultado->parametro}}</td>
                                        <td class="text-center">
                                            @if ($resultado->val_ref_texto != '' || $resultado->val_ref_inicial != '' || $resultado->val_ref_final != '')
                                                {{$resultado->resultado}}
                                            @endif
                                        </td>
                                        <td>{{$resultado->unidades}}</td>

                                        <td>{{$resultado->val_ref_texto}}</td>
                                        <td>{{$resultado->val_ref_inicial}}</td>
                                        <td>{{$resultado->val_ref_final}}</td>

                                    </tr>
                                @endforeach   
                            @endif
                        @else
                        <tr class="texto-pequeno">
                            <td><p>{{$estudio->nombre}}</p></td>
                            <td class="text-center">
                                @php
                                $resultado = $resultados->get($index);
                                @endphp
                            {{($resultado) ? $resultado->resultado:''}}</p>
                            </td>
                            <td class="text-left">{{$estudio->unidades}}</td>
                            <td colspan="3">
                                @php
                                    $vReferencias = $valoresReferencias->get($index);
                                @endphp
                                @if ($vReferencias)
                                <table>
                                    <tbody>
                                        @foreach ($vReferencias as $valorReferencia)
                                        <tr>
                                            <td>{{ $valorReferencia->valor_texto}}</td>
                                            <td>{{ $valorReferencia->valor_inicial}}</td>
                                            <td>{{ $valorReferencia->valor_final}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </td>
                        </tr>
                       
                        @endif
                        
                    @endif
            @endforeach
        </tbody>
    </table>
    <hr>
    <br>
    <table>
        <tbody class="texto-pequeno">
            <tr>
                <td rowspan="2">
                    Revisó resultados: Q.B.P. JESÚS ISAÍ DOZAL BARRIOS</td>
                <td>
                    <br><br>
                    <p>RESPONSABLE SANITARIO</p>
                    <p>Q.B.P. JESÚS ISAÍ DOZAL BARRIOS <br>CED. PROF. 11888986</p>
                </td>
            </tr>
          
        </tbody>
    </table>
    <footer>
        <div class="page-number">
            <span class="pagenum"></span>
        </div>
    </footer>

    <script type="text/php">
        if (isset($pdf)) {
            $x = 500;
             $y = 800;
             $text = "Página: {PAGE_NUM} de {PAGE_COUNT}";
             $font = $fontMetrics->getFont("Arial", "bold");
            $size = 10;
            $color = array(0,0,0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }
    </script>
</body>
</html>