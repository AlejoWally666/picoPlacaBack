<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PicoPlacaController extends Controller
{
    public function checkPicoPlaca(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'placa' => 'required|string',
            'dia' => 'required|integer|between:1,7',
            'hora' => 'required|date_format:H:i'
        ]);

        // Obtener la hora y verificar si está dentro de los rangos permitidos
        $hora = $request->hora;
        \Log::info("Hora recibida: $hora");

        // Convertir la hora a un objeto DateTime
        $horaDateTime = \DateTime::createFromFormat('H:i', $hora);
        $horaInicioManana = \DateTime::createFromFormat('H:i', '06:00');
        $horaFinManana = \DateTime::createFromFormat('H:i', '09:30');
        $horaInicioTarde = \DateTime::createFromFormat('H:i', '16:00');
        $horaFinTarde = \DateTime::createFromFormat('H:i', '21:00');

        // Verificar si la hora está dentro de los rangos
        if (
            !($horaDateTime >= $horaInicioManana && $horaDateTime <= $horaFinManana) &&
            !($horaDateTime >= $horaInicioTarde && $horaDateTime <= $horaFinTarde)
        ) {
            return response()->json([
                'ok' => true,
                'data' => ['picoplaca' => false,'motivo' => 'Horario'],
                'message' => 'Consulta exitosa'
            ]);
        }

        // Obtener el último dígito de la placa
        $placa = $request->placa;
        $ultimoDigito = substr($placa, -1);
        \Log::info("Último dígito de la placa: $ultimoDigito");

        // Obtener el día de la semana (1 = Lunes, 2 = Martes, ..., 7 = Domingo)
        $diaSemana = $request->dia;
        \Log::info("Día de la semana: $diaSemana");

        // Determinar si aplica Pico y Placa
        $picoplaca = false;
        switch ($diaSemana) {
            case 1: // Lunes
                $picoplaca = in_array($ultimoDigito, ['1', '2']);
                break;
            case 2: // Martes
                $picoplaca = in_array($ultimoDigito, ['3', '4']);
                break;
            case 3: // Miércoles
                $picoplaca = in_array($ultimoDigito, ['5', '6']);
                break;
            case 4: // Jueves
                $picoplaca = in_array($ultimoDigito, ['7', '8']);
                break;
            case 5: // Viernes
                $picoplaca = in_array($ultimoDigito, ['9', '0']);
                break;
            case 6: // Sábado
            case 7: // Domingo
                $picoplaca = false;
                break;
        }

        // Devolver una respuesta JSON
        return response()->json([
            'ok' => true,
            'data' => ['picoplaca' => $picoplaca],
            'message' => 'Consulta exitosa'
        ]);
    }
}
