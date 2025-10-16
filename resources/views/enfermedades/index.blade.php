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
                Usuario ID: {{ $login->user_id }} |
                Fecha: {{ $login->created_at->format('d/m/Y H:i') }} |
                IP: {{ $login->ip }}
            </li>
        @endforeach
    </ul>

    <a href="{{ url('/') }}">← Volver al inicio</a>
</body>
</html>
