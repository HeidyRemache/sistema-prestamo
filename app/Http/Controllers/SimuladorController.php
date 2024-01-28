<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class SimuladorController extends Controller
{
    public function formAmortizacionAlemana()
    {
        return view('amortizacion-alemana-form');
    }

    public function calcularAmortizacionAlemana(Request $request)
    {
        // Validación de datos del formulario
        $request->validate([
            'monto' => 'required|numeric',
            'tasa_interes' => 'required|numeric|min:0',
            'plazo_meses' => 'required|integer|min:1',
        ]);

        // Obtener los datos del formulario
        $capital = floatval($request->input('monto'));
        $tasaNominalAnual = floatval($request->input('tasa_interes'));
        $plazo = intval($request->input('plazo_meses'));

        // Convertir la tasa nominal anual a tasa de interés efectiva mensual
        $tasaInteresEfectiva = $tasaNominalAnual / 100 / 12;

        // Calcular la amortización de capital por periodo
        $amortizacionCapital = $capital / $plazo;

        // Inicializar variables
        $amortizacionAlemanaCuotas = [];
        $totalInteres = 0;

        // Calcular las cuotas para cada periodo
        for ($i = 0; $i < $plazo; $i++) {
            // Calcular el interés total de cada periodo
            $interesTotal = ($capital - array_sum(array_column($amortizacionAlemanaCuotas, 'amortizacion'))) * $tasaInteresEfectiva;

            // Acumular el interés total
            $totalInteres += $interesTotal;

            // Calcular la cuota total del periodo
            $cuotaTotal = $amortizacionCapital + $interesTotal;

            // Calcular el capital restante
            $capital_restante = $capital - ($amortizacionCapital * $i);

            // Almacenar los resultados en el array de cuotas
            $amortizacionAlemanaCuotas[] = [
                'periodo' => $i + 1,
                'capital_restante' => number_format($capital_restante, 2),
                'interes' => number_format($interesTotal, 2),
                'amortizacion' => number_format($amortizacionCapital, 2),
                'cuota' => number_format($cuotaTotal, 2),
            ];
        }

        $totalDevolver = $capital + $totalInteres;

        $composicionPrestamo = [
            'capital' => number_format($capital, 2),
            'tasaNominalAnual' => number_format($tasaNominalAnual, 2),
            'plazo' => $plazo,
            'total' => number_format($totalDevolver, 2),
        ];

        $request->session()->put('amortizacionAlemanaCuotas', $amortizacionAlemanaCuotas);
        $request->session()->put('composicionPrestamo', $composicionPrestamo);

        return view('amortizacion-alemana-result', compact('amortizacionAlemanaCuotas', 'composicionPrestamo'));
    }

    public function descargarPdfAmortizacionAlemana(Request $request)
    {
        // Obtén los resultados de la amortización alemana
        $amortizacionAlemanaCuotas = $request->session()->get('amortizacionAlemanaCuotas');
        $composicionPrestamo = $request->session()->get('composicionPrestamo');

        // Carga la vista del PDF con los resultados
        $pdf = PDF::loadView('amortizacion-alemana-result-pdf', compact('amortizacionAlemanaCuotas', 'composicionPrestamo'));

        // Descarga el PDF
        return $pdf->download('amortizacion-alemana.pdf');
    }

    public function formAmortizacionFrancesa()
    {
        return view('amortizacion-francesa-form');
    }

    public function calcularAmortizacionFrancesa(Request $request)
    {
        // Validación de datos del formulario
        $request->validate([
            'monto' => 'required|numeric',
            'tasa_interes' => 'required|numeric|min:0',
            'plazo_meses' => 'required|integer|min:1',
        ]);

        // Obtener los datos del formulario
        $capitalOriginal = floatval($request->input('monto'));
        $tasaNominalAnual = floatval($request->input('tasa_interes'));
        $plazo = intval($request->input('plazo_meses'));

        // Convertir la tasa nominal anual a tasa de interés efectiva
        $tasaInteresEfectiva = $tasaNominalAnual / 100;
        $tasaInteresEfectivaCapitalizacion = $tasaInteresEfectiva / 12;

        // Calcular la cuota periódica constante
        $cuotaPeriodica = $capitalOriginal * ($tasaInteresEfectivaCapitalizacion) / (1 - pow(1 + $tasaInteresEfectivaCapitalizacion, -$plazo));

        // Inicializar variables
        $capital = $capitalOriginal;
        $amortizacionFrancesaCuotas = [];
        $totalInteres = 0;

        // Calcular las cuotas para cada periodo
        for ($i = 1; $i <= $plazo; $i++) {
            // Calcular el interés total de cada periodo
            $interesTotalAnioK = $capital * $tasaInteresEfectivaCapitalizacion;

            // Calcular la amortización del periodo
            $amortizacionAnioK = $cuotaPeriodica - $interesTotalAnioK;

            // Acumular el interés total
            $totalInteres += $interesTotalAnioK;

            // Almacenar los resultados en el array de cuotas
            $amortizacionFrancesaCuotas[] = [
                'periodo' => $i,
                'capital_restante' => number_format($capital, 2),
                'interes' => number_format($interesTotalAnioK, 2),
                'amortizacion' => number_format($amortizacionAnioK, 2),
                'cuota' => number_format($cuotaPeriodica, 2),
            ];

            // Actualizar el capital para el próximo período
            $capital -= $amortizacionAnioK;
        }

        $totalDevolver = $capitalOriginal + $totalInteres;

        $composicionPrestamo = [
            'capital' => number_format($capitalOriginal, 2),
            'tasaNominalAnual' => number_format($tasaNominalAnual, 2),
            'plazo' => $plazo,
            'cuota' => number_format($cuotaPeriodica, 2),
            'total' => number_format($totalDevolver, 2),
        ];

        $request->session()->put('amortizacionFrancesaCuotas', $amortizacionFrancesaCuotas);
        $request->session()->put('composicionPrestamo', $composicionPrestamo);

        return view('amortizacion-francesa-result', compact('amortizacionFrancesaCuotas', 'composicionPrestamo'));
    }


    public function descargarPdfAmortizacionFrancesa(Request $request)
    {
        // Obtén los resultados de la amortización alemana
        $amortizacionFrancesaCuotas = $request->session()->get('amortizacionFrancesaCuotas');
        $composicionPrestamo = $request->session()->get('composicionPrestamo');

        // Carga la vista del PDF con los resultados
        $pdf = PDF::loadView('amortizacion-francesa-result-pdf', compact('amortizacionFrancesaCuotas', 'composicionPrestamo'));

        // Descarga el PDF
        return $pdf->download('amortizacion-francesa.pdf');
    }
}
