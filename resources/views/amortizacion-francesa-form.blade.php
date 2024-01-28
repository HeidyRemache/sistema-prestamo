<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Amortización Francesa</title>
    <link rel="icon" type="logo" href="https://cdn1.iconfinder.com/data/icons/european-country-flags/83/france-256.png" />
</head>

<body>

    @extends('layouts.app-form')

    @section('content')
        <h1 class="text-2xl font-bold mb-4">Amortización Francesa</h1>

        <form action="{{ url('/simulador/amortizacion-francesa') }}" method="post" style="max-width: 800px">
            @csrf

            <div class="mb-4">
                <label for="monto" class="block">Capital / Préstamo:</label>
                <input type="text" name="monto" id="principal" class="w-full" required>
            </div>

            <div class="mb-4">
                <label for="tasa_interes" class="block">Tasa Nominal Anual:</label>
                <input type="text" name="tasa_interes" id="interest" class="w-full" required>
            </div>

            <div class="mb-4">
                <label for="plazo_meses" class="block">Plazo:</label>
                <select name="plazo_meses" id="terms" class="w-full">
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
            <br>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Calcular</button>
        </form>
    @endsection

</body>

</html>
