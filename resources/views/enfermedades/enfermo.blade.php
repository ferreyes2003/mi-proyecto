<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Enfermedades</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #333;
        }
        ul {
            padding-left: 0;
            list-style-type: none;
        }
        li {
            background: #fff;
            margin-bottom: 10px;
            padding: 10px;
            border-left: 5px solid #007BFF;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .acciones {
            margin-top: 30px;
        }
        .acciones a {
            display: block;
            margin-bottom: 8px;
            text-decoration: none;
            color: #007BFF;
        }
        .acciones a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Enfermedades registradas</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <ul>
        @foreach ($enfermedades as $enfermedad)
            <li>
                <strong>{{ $enfermedad->nombre }}</strong>: {{ $enfermedad->descripcion }}
            </li>
        @endforeach
    </ul>

    <div class="acciones">
        <a href="{{ route('enfermedades.create') }}">➕ Registrar nueva enfermedad</a>
        <a href="{{ route('enfermedades.create') }}">🧾 Añadir enfermedad detectada</a>
        <a href="{{ route('enfermedades.create') }}">🩺 Cargar diagnóstico reciente</a>
        <a href="{{ route('enfermedades.create') }}">📋 Ingresar caso clínico</a>
        <a href="{{ route('enfermedades.create') }}">🧬 Documentar enfermedad rara</a>
    </div>
</body>
</html>
