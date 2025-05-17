<?php

namespace App\Validation;

class CustomRules
{

    //Controla que el recordatorio no sea superior al vencimiento
    public function validarRecordatorioVsVencimiento($str, string $fields, array $data): bool
    {
        if (empty($str)) {
            return true; // Si recordatorio está vacío, es válido
        }

        if (empty($data['fecha_vencimiento'])) {
            return false; // vencimiento es obligatorio
        }

        return strtotime($str) <= strtotime($data['fecha_vencimiento']);
    }

    //Controla que la tarea no se cree con una fecha antigua a la actual
    public function fechaNoPasada($fecha): bool{
    if (empty($fecha)) {
        return false; // vencimiento es obligatorio
    }

    $hoy = strtotime(date('Y-m-d'));
    $fechaIngresada = strtotime($fecha);

    return $fechaIngresada >= $hoy; 
   }

}