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

    @extends('layouts.app-form')

    @section('content')
        <h1>Sistema de Amortización Alemana</h1>

        <form action="{{ url('/simulador/amortizacion-alemana') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="monto">Capital / Préstamo:</label>
                <input type="text" name="monto" id="principal" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="tasa_interes">Tasa Nominal Anual:</label>
                <input type="text" name="tasa_interes" id="interest" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="plazo_meses">Plazo:</label>
                <select name="plazo_meses" id="terms" class="form-control">
                    <option value="12">12 Meses</option>
                    <option value="18">18 Meses</option>
                    <option value="24">24 Meses</option>
                    <option value="36">36 Meses</option>
                    <option value="48">48 Meses</option>
                    <option value="60">60 Meses</option>
                    <option value="72">72 Meses</option>
                    <option value="84">84 Meses</option>
                    <option value="96">96 Meses</option>
                    <option value="108">108 Meses</option>
                    <option value="120">120 Meses</option>
                </select>
            </div>
            <button type="submit">Calcular</button>
        </form>
    @endsection

</body>

</html>
