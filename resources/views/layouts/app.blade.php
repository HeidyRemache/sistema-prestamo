<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simulador de Crédito</title>

    <!-- Favicon -->
    <link rel="icon" href="https://cdn4.iconfinder.com/data/icons/keynote-and-powerpoint-icons/256/Money-256.png" type="image/x-icon">

    <!-- Enlaces a estilos CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body 
        {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7fafc;
            color: #2d3748;
        }

        nav {
            background-color: #2d3748;
            padding: 1rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            width: 100%;
            box-sizing: border-box;
            transition: 0.3s ease-in-out;
        }

        nav ul {
            display: flex;
            justify-content: space-around;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        nav li {
            margin-right: 15px;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            transition: color 0.3s ease-in-out;
        }

        nav a:hover {
            color: #cbd5e0;
        }

        .composicion, .cuadro {
            max-width: 800px;
            margin:20px auto;
            padding: 20px;
            background-color: #2d3748;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            color: #fff;
        }

        h1 {
            margin-bottom: 40px;
            text-align: center;
        }

        form 
        {
            margin-top: 20px;
        }

        label 
        {
            display: block;
            margin-bottom: 8px;
        }

        input 
        {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        .inicio 
        {
            background-color: #008080;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px; 
            margin-left: 860px;
        }

        .pdf 
        {
            background-color: #0E8044; 
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px; 
            margin-left: 5px;
        }

        button:hover 
        {
            background-color: #2d3748;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        td 
        {
            border: 1px solid #cbd5e0;
            padding: 12px;
            text-align: center;
            background-color: #475569;
            color: #ffffff;
        }

        th 
        {
            border: 1px solid #cbd5e0;
            padding: 12px;
            text-align: center;
            background-color: #008080;
            color: #ffffff;
        }
        
    </style>
</head>
<body>
    <!-- Barra de navegación -->
    <nav>
        <ul>
            <li><a href="/"><i class="fas fa-home"></i> Inicio</a></li>
            <li><a href="{{ url('/simulador/amortizacion-alemana') }}"><img src="https://cdn1.iconfinder.com/data/icons/european-country-flags/83/germany-256.png" alt="Amortización Alemana" style="width: 20px; height: 20px;"> Amortización Alemana</a></li>
            <li><a href="{{ url('/simulador/amortizacion-francesa') }}"><img src="https://cdn1.iconfinder.com/data/icons/european-country-flags/83/france-256.png" alt="Amortización Alemana" style="width: 20px; height: 20px;"> Amortización Francesa</a></li>
        </ul> 
    </nav>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
