<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amortización Francesa - Resultado PDF</title>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            color: #333; 
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        .header {
            text-align: center;
            margin: 20px auto;
            line-height: 1.6;
        }

        .container {
            margin-top: 40px;
        }

        th, td {
            border: 1px solid #cbd5e0;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #4a5568;
            color: #ffffff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .composicion-prestamo {
            margin: 20px auto;
            line-height: 1.6;
        }
    </style>
</head>

<body>
    <h1>Amortización Francesa</h1>
    <div class="composicion-prestamo">
        <h2 class="text-2xl font-bold mb-4">Composición del Préstamo</h2>
        <strong>Fecha:</strong> <?php echo date("Y-m-d"); ?><br>
        <strong>Amortización:</strong> Sistema Francés<br>
        <strong>Préstamo:</strong> ${{ $composicionPrestamo['capital'] }}<br>
        <strong>Tasa de Interés:</strong> {{ $composicionPrestamo['tasaNominalAnual'] }}%<br>
        <strong>Meses:</strong> {{ $composicionPrestamo['plazo'] }}<br>
        <strong>Cuota:</strong> ${{ $composicionPrestamo['cuota'] }}<br>
        <strong>Total a Devolver:</strong> ${{ $composicionPrestamo['total'] }}<br>
    </div>
    <div class="container mx-auto my-8">
        <h2 class="text-2xl font-bold mb-4">Cuadro de Marcha</h2>
        <table>
            <thead>
                <tr>
                    <th>Mes</th>
                    <th>Capital Restante</th>
                    <th>Intereses</th>
                    <th>Amortización de Capital</th>
                    <th>Cuota</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($amortizacionFrancesaCuotas as $resultado)
                    <tr>
                        <td>{{ $resultado['periodo'] }}</td>
                        <td>{{ $resultado['capital_restante'] }}</td>
                        <td>{{ $resultado['interes'] }}</td>
                        <td>{{ $resultado['amortizacion'] }}</td>
                        <td>{{ $resultado['cuota'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</body>
</html>
