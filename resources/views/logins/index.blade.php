<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de accesos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background: #fff;
            margin-bottom: 10px;
            padding: 10px;
            border-left: 5px solid #007BFF;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .empty {
            color: #888;
            font-style: italic;
        }
    </style>
</head>
<body>
    <h1>Historial de accesos</h1>

    @php
        // Simulación de datos si $logins está vacío
        if (!isset($logins) || $logins->isEmpty()) {
            $logins = collect([
                (object)['user_id' => 101, 'fecha_login' => '2025-10-14 08:32:10', 'ip' => '192.168.1.10'],
                (object)['user_id' => 102, 'fecha_login' => '2025-10-13 17:45:03', 'ip' => '192.168.1.11'],
                (object)['user_id' => 103, 'fecha_login' => '2025-10-12 09:15:22', 'ip' => '192.168.1.12'],
                (object)['user_id' => 104, 'fecha_login' => '2025-10-11 20:01:47', 'ip' => '192.168.1.13'],
                (object)['user_id' => 105, 'fecha_login' => '2025-10-10 07:22:33', 'ip' => '192.168.1.14'],
            ]);
        }
    @endphp

    <ul>
        @foreach ($logins as $login)
            <li>
                <strong>Usuario ID:</strong> {{ $login->user_id }} |
                <strong>Fecha:</strong> {{ $login->fecha_login }} |
                <strong>IP:</strong> {{ $login->ip }}
            </li>
        @endforeach
    </ul>
</body>
</html>
