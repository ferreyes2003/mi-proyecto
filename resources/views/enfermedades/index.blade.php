<!DOCTYPE html>
<html>
<head>
    <title>Historial de Accesos</title>
</head>
<body>
    <h1>Historial de accesos</h1>

    <ul>
        @foreach ($logins as $login)
            <li>
                Usuario: {{ $login->usuario }} |
                Fecha: {{ $login->fecha_login->format('d/m/Y H:i') }} |
                IP: {{ $login->ip }}
            </li>
        @endforeach
    </ul>

    <a href="{{ url('/') }}">← Volver al inicio</a>
</body>
</html>
