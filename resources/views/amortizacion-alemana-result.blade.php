<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Amortización Alemana</title>
    <link rel="icon" type="logo" href="https://cdn1.iconfinder.com/data/icons/european-country-flags/83/germany-256.png" />
</head>

<body>

    @extends('layouts.app')

    @section('content')
        <button class="inicio bg-blue-500 text-white px-4 py-2 rounded mt-4 inline-block" onclick="window.location.href='/'">Inicio</button>
        <button class="pdf bg-green-500 text-white px-4 py-2 rounded mt-4 inline-block" onclick="window.location.href='{{ url('/simulador/amortizacion-alemana/pdf') }}'">Descargar PDF</button>
        <div class="composicion mx-auto my-8">
            <h1 class="text-2xl font-bold mb-4">Composición del Préstamo</h1>

            <div class="mb-4">
                <strong>Préstamo:</strong> ${{ $composicionPrestamo['capital'] }}
            </div>
            <div class="mb-4">
                <strong>Tasa de Interés:</strong> {{ $composicionPrestamo['tasaNominalAnual'] }}%
            </div>
            <div class="mb-4">
                <strong>Meses:</strong> {{ $composicionPrestamo['plazo'] }}
            </div>
            <div class="mb-4">
                <strong>Total a Devolver:</strong> ${{ $composicionPrestamo['total'] }}
            </div>
        </div>
        <div class="cuadro mx-auto my-8">
            <h1 class="text-2xl font-bold mb-4">Cuadro de Marcha</h1>
            <table class="border-collapse w-full">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Mes</th>
                        <th class="border px-4 py-2">Capital Restante</th>
                        <th class="border px-4 py-2">Intereses</th>
                        <th class="border px-4 py-2">Amortización de capital</th>
                        <th class="border px-4 py-2">Cuota</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($amortizacionAlemanaCuotas as $resultado)
                        <tr>
                            <td class="border px-4 py-2">{{ $resultado['periodo'] }}</td>
                            <td class="border px-4 py-2">${{ $resultado['capital_restante'] }}</td>
                            <td class="border px-4 py-2">${{ $resultado['interes'] }}</td>
                            <td class="border px-4 py-2">${{ $resultado['amortizacion'] }}</td>
                            <td class="border px-4 py-2">${{ $resultado['cuota'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
</body>

</html>
