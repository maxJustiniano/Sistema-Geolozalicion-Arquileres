<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Denegado - Sistema de Alquileres Formosa</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #f5f5f5, #e0e0e0);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .error-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 500px;
            width: 90%;
        }
        .header {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
            padding: 20px;
            border-radius: 10px 10px 0 0;
            margin: -40px -40px 30px -40px;
        }
        .header h1 {
            margin: 0;
            font-weight: 300;
            font-size: 2em;
        }
        .error-code {
            font-size: 6em;
            color: #e74c3c;
            margin: 0;
            font-weight: 300;
        }
        .error-message {
            font-size: 1.2em;
            margin: 20px 0;
            color: #555;
        }
        .error-details {
            margin: 20px 0;
            color: #777;
            line-height: 1.5;
        }
        .btn {
            background: #4a90e2;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            margin: 10px;
            transition: background 0.3s;
        }
        .btn:hover {
            background: #357abd;
        }
        .btn-secondary {
            background: #95a5a6;
        }
        .btn-secondary:hover {
            background: #7f8c8d;
        }
        @media (max-width: 768px) {
            .error-container {
                padding: 20px;
                margin: 20px;
            }
            .header {
                margin: -20px -20px 20px -20px;
            }
            .error-code {
                font-size: 4em;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="header">
            <h1>Acceso Denegado</h1>
        </div>
@if(session('error-message'))
    <div class="error-container">
        <h2 class="error-code">{{ session('error-code', '403') }}</h2>
        <p class="error-message">{{ session('error-message') }}</p>
        <div class="error-details">
            @if(session('error-details1'))
                <p>{{ session('error-details1') }}</p>
            @endif
            @if(session('error-details2'))
                <p>{{ session('error-details2') }}</p>
            @endif
        </div>
    </div>
@endif

        <a  href="{{ url('/dashboard') }}" class="btn">Volver al Inicio</a>
        <a href="javascript:history.back()" class="btn btn-secondary">Volver Atrás</a>
    </div>

    <script>
        setTimeout(function() {
            window.location.href = "{{ url('/dashboard') }}"; //redirecciona hacia:
        }, 5000);
        console.log('Redirigiendo al inicio en 5 segundos...');
    </script>
</body>
</html>