<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Models\HistorialPaciente;

class AsistenteController extends Controller
{
    /**
     * Analiza el texto del usuario, sigue un flujo de preguntas,
     * genera diagnósticos y guarda los resultados en la base de datos.
     */
    public function analizar(Request $request)
{
    $consulta = strtolower(trim($request->input('consulta')));
    $fase = session('fase', 'inicio');
    $respuesta = '';

    switch ($fase) {
        case 'inicio':
            session(['fase' => 'nombre']);
            $respuesta = "👋 ¡Hola! Soy tu asistente médico. ¿Cuál es el nombre del paciente?";
            break;

        case 'nombre':
            session(['nombre' => ucfirst($consulta), 'fase' => 'edad']);
            $respuesta = "✅ Paciente registrado: $consulta. ¿Qué edad tiene?";
            break;

        case 'edad':
            $edad = (int) filter_var($consulta, FILTER_SANITIZE_NUMBER_INT);
            session(['edad' => $edad, 'fase' => 'sintomas']);
            $respuesta = "🧾 Edad registrada: $edad años. ¿Cuáles son sus síntomas?";
            break;

        case 'sintomas':
            session(['sintomas' => $consulta, 'fase' => 'confirmar']);
            $respuesta = "🩺 Síntomas registrados: $consulta. ¿Desea generar diagnóstico? (sí/no)";
            break;

        case 'confirmar':
            if (in_array($consulta, ['sí', 'si'])) {
                $nombre = session('nombre');
                $edad = session('edad');
                $sintomas = session('sintomas');

                // Diagnóstico simple
                if (str_contains($sintomas, 'fiebre') && str_contains($sintomas, 'tos')) {
                    $diagnostico = "Posible infección respiratoria. Recomendación: prueba COVID-19.";
                } elseif (str_contains($sintomas, 'dolor de cabeza')) {
                    $diagnostico = "Podría tratarse de migraña o presión alta.";
                } else {
                    $diagnostico = "No se puede determinar. Consulte a un médico.";
                }

                // Guardar historial
                \App\Models\HistorialPaciente::create([
                    'nombre' => $nombre,
                    'edad' => $edad,
                    'sintomas' => $sintomas,
                    'diagnostico' => $diagnostico,
                ]);

                // Limpiar sesión
                session()->forget(['nombre', 'edad', 'sintomas', 'fase']);

                $respuesta = "✅ Historial guardado correctamente. Diagnóstico: $diagnostico";
            } else {
                $respuesta = "❌ Diagnóstico cancelado. Puedes iniciar otro paciente escribiendo cualquier cosa.";
                session()->forget(['nombre', 'edad', 'sintomas', 'fase']);
            }
            break;

        default:
            session(['fase' => 'nombre']);
            $respuesta = "👋 Bienvenido al asistente. ¿Cuál es el nombre del paciente?";
    }

    // Guardar la consulta y respuesta
    \App\Models\Consulta::create([
        'consulta' => $consulta,
        'respuesta' => $respuesta,
    ]);

    return response()->json(['respuesta' => $respuesta]);
}

public function historial()
{
    // Muestra todas las consultas del chat (tabla consultas)
    $consultas = \App\Models\Consulta::latest()->get();
    return view('historial', compact('consultas'));
}

public function historialPacientes()
{
    // Muestra los historiales guardados (tabla historial_pacientes)
    $pacientes = \App\Models\HistorialPaciente::latest()->get();
    return view('historial_pacientes', compact('pacientes'));
}

}