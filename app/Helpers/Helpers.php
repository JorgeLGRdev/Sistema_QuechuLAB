<?php

namespace App\Helpers;

use App\Models\Estudio;
use App\Models\Orden;
use DateTime;
use App\Models\Paciente;
use App\Models\Resultado;

class Helpers
{
    public static function obtenerEdad($fechaNacimiento) {
        $hoy = new DateTime();
        $nacimiento = new DateTime($fechaNacimiento);
        $intervalo = $hoy->diff($nacimiento);

        if ($intervalo->y > 0) {
            return $intervalo->y . ' años';
        } elseif ($intervalo->m > 0) {
            return $intervalo->m . ' meses';
        } else {
            return $intervalo->d . ' días';
        }
    }

    public static function formatFecha($fechaHora) {
        // Crear un objeto DateTime a partir de la fecha y hora proporcionadas
        $dateTime = new DateTime($fechaHora);
    
        // Formatear la fecha al formato deseado (18 enero 2024)
        $fecha = $dateTime->format('d F Y');
        $fecha = str_replace(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'], ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'], $fecha);
    
        // Formatear la hora al formato deseado (horas, minutos y segundos)
            //  $hora = $dateTime->format('H:i:s');
    
        return $fecha;
    }
    // Uso de la función
    //list($fecha, $hora) = formatFechaHora('2024-01-18 11:12:13');
    //echo "Fecha: $fecha, Hora: $hora";  // Salida: Fecha: 18 enero 2024, Hora: 11:12:13
    public static function formatHora($fechaHora) {
        // Crear un objeto DateTime a partir de la fecha y hora proporcionadas
        $dateTime = new DateTime($fechaHora);
    
        // Formatear la fecha al formato deseado (18 enero 2024)
        //$fecha = $dateTime->format('d F Y');
        //$fecha = str_replace(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'], ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'], $fecha);
    
        // Formatear la hora al formato deseado (horas, minutos y segundos)
        $hora = $dateTime->format('H:i:s');
    
        return $hora;
    }


    public static function nombrePaciente($id){
        $paciente = Paciente::find($id);
        return $paciente->nombre. ' '. $paciente->apellido_paterno. ' '. $paciente->apellido_materno;
    }

    public static function estudiosOrden($id){
        $ordenes = Orden::where('detalle_orden_id', $id)->get();
        $nombres = '';
        foreach($ordenes as $orden){
            $estudio = Estudio::find($orden->estudio_id);
            $nombres = $nombres.$estudio->nombre. ', '; //debe ser la abreviatura del estudio
        }
        return $nombres;
    }

    public static function obtenerResultados($estudio_id, $orden_id){
        $resultados = Resultado::where('detalle_orden_id', $orden_id)
        ->where('estudio_id', $estudio_id)
        ->get(); 
        return $resultados;
    }

    public static function obtenerDia(){
        $diaActual = date('l');
        $dias = array(
            'Monday'    => 'Lunes',
            'Tuesday'   => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday'  => 'Jueves',
            'Friday'    => 'Viernes',
            'Saturday'  => 'Sábado',
            'Sunday'    => 'Domingo'
        );
        return $dias[$diaActual];
    }

    public static function esParametro($resultado_id){
        $res = Resultado::find($resultado_id);
        if($res != null && ($res->val_ref_texto != '' || $res->val_ref_inicial != '' || $res->val_ref_final != '')){
            return true;
        }else{
            return false;
        }
    }
}
