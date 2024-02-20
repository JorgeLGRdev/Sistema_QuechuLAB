<?php

namespace App\Http\Controllers;

use App\Models\Detalle_Orden;
use App\Models\Orden;
use App\Models\Estudio;
use App\Models\Paciente;
use App\Models\Detalle_Perfil;
use App\Models\Perfil;
use App\Models\ValorReferencia;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Picqer\Barcode\BarcodeGeneratorHTML;
use App\Helpers\Helpers;
use App\Models\Resultado;


class PdfController extends Controller
{
    
    public function generarRecibo($id)
    {
            $detalle_orden = Detalle_Orden::find($id);
           // Realiza otra consulta a la base de datos para obtener las órdenes
           $ordenes = Orden::where('detalle_orden_id', $detalle_orden->id)->get();
    
           // Para cada orden, obitene los estudios relacionados
           $estudios = collect();
           foreach ($ordenes as $orden) {
               $estudiosOrden = Estudio::where('id', $orden->estudio_id)->get();
              // $estudiosOrden = Estudio::find($orden->estudio_id);
               $estudios = $estudios->concat($estudiosOrden);
           }
   
           //Datos del paciente
           $paciente = Paciente::find($detalle_orden->paciente_id);
            //Codigo barras 
            $generador = new BarcodeGeneratorHTML();
            $codigoDeBarras = $generador->getBarcode($id, $generador::TYPE_CODE_128);
            // Genera el recibo de pago
           $data = ['detalleOrden' => $detalle_orden, 'estudios' => $estudios, 'paciente' => $paciente, 'codigoDeBarras' => $codigoDeBarras];


        $pdf = Pdf::loadView('ordenes.recibo_de_pago', $data);
        return $pdf->download('recibo_de_pago.pdf');
    }

    public function generarEtiquetas($id){ // detalle_orden_id
        $detalle_orden = Detalle_Orden::find($id);
        $ordenes = Orden::where('detalle_orden_id', $detalle_orden->id)->get();

        $muestras = [];
        $estudios = [];
        foreach ($ordenes as $orden) {
            $estudio = Estudio::find($orden->estudio_id);
            if (!in_array($estudio->tipo_muestra, $muestras)) {
                // Si la muestra no está en el arreglo, la añadimos
                $muestras[] = $estudio->tipo_muestra;
                $estudios[] = $estudio->nombre;     //debe ser la abreviatura
            } else {
                // Si la muestra ya está en el arreglo, concatenamos el estudio
                $indice = array_search($estudio->tipo_muestra, $muestras);
                $estudios[$indice] .= ', ' . $estudio->nombre;      // debe ser la abreviatura
            }
        }
         
        $paciente = Paciente::find($detalle_orden->paciente_id);
        $nombrePaciente = $paciente->nombre. ' '. $paciente->apellido_paterno. ' '. $paciente->apellido_materno;
         //Codigo barras 
         $generador = new BarcodeGeneratorHTML();
         $codigoDeBarras = $generador->getBarcode($id, $generador::TYPE_CODE_128);
        
         //foreach($muestras as $muestra){
            //$indice = array_search($muestra, $muestras);
           // $estudios = $estudios[$indice];
         //}

          //DATA
          $data = ['detalleOrden_id' => $id, 
          'paciente' => $nombrePaciente, 
          'muestras' => $muestras, 
          'estudios' => $estudios,
          'codigoDeBarras' => $codigoDeBarras];

         return $this->generarEtiqueta($data);
    }

    public function generarEtiqueta($data){
        $pdf = PDF::loadView('ordenes.etiqueta', $data);
        return $pdf->download('etiqueta.pdf');
    }
 
    public function generarInforme($ordenId){
        $detalle_orden = Detalle_Orden::find($ordenId);
        $ordenes = Orden::where('detalle_orden_id', $detalle_orden->id)->get();
        $paciente = Paciente::find($detalle_orden->paciente_id);
       
        //$resultados = Resultado::where('detalle_orden_id', $detalle_orden->id);

        $estudios = collect();
        $resultados = collect();
        $valores_referencia = collect();

        foreach ($ordenes as $orden) {
            $estudio = Estudio::find($orden->estudio_id);
            //en  la vista: si es perfil solo agregar nombre y metodo
            if($estudio->es_perfil === 's'){
                $estudios->push($estudio); //se agrega el perfil
                $resultados->push(null); //equivalente al perfil
                $valores_referencia->push(null);//equivalente al perfil

                $detalle_perfil = Detalle_Perfil::where('nombre', $estudio->nombre)->first();
                $perfiles = Perfil::where('detalle_perfil_id', $detalle_perfil->id)->get();
                foreach($perfiles as $perfil){
                    $estudioAux = Estudio::find($perfil->estudio_id);
                    $estudios->push($estudioAux);
                    //Valores de referencia
                    $referencias = ValorReferencia::where('estudio_id', $estudioAux->id)->get();
                    $valores_referencia->push($referencias);
                    //Resultados
                    $resultado = Resultado::where('detalle_orden_id', $detalle_orden->id)->get()->where('estudio_id', $estudioAux->id)->first();
                    $resultados->push($resultado);
                }
            }else{
                $estudios->push($estudio);
                  //Valores de referencia
                  $referencias = ValorReferencia::where('estudio_id', $estudio->id)->get();
                  $valores_referencia->push($referencias);
                  //Resultados
                  $resultado = Resultado::where('detalle_orden_id', $detalle_orden->id)->get()->where('estudio_id', $estudio->id)->first();
                  $resultados->push($resultado);
            }
        }

        //Codigo barras 
        $generador = new BarcodeGeneratorHTML();
        $codigoDeBarras = $generador->getBarcode($detalle_orden->id, $generador::TYPE_CODE_128);

        //DATA
           $data = ['detalleOrden' => $detalle_orden, 
           'paciente' => $paciente, 
           'estudios' => $estudios,
           'resultados' => $resultados,
           'valoresReferencias' => $valores_referencia,
           'codigoDeBarras' => $codigoDeBarras];
 

        $pdf = PDF::loadView('ordenes.informe', $data);
        $pdf->getDomPDF()->set_option("isPhpEnabled", true);
 

        return $pdf->download('informe_de_resultados.pdf');
    }
}
