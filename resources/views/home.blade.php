<!DOCTYPE html>
<html>
<head>
    <title>Proyecto Enfermedades</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 40px; background: #e6f5dfe0; }
        h1 { color: #d82121ff; }
        .menu { margin-top: 20px; }
        .menu a {
            display: block;
            margin: 10px 0;
            padding: 10px;
            background: #093050ff;
            color: white;
            text-decoration: none;
            width: 300px;
            border-radius: 5px;
        }
        .menu a:hover { background: #2779bd; }
    </style>
</head>
<body>
    <h1>Bienvenido al Proyecto Enfermedades</h1>
    <p>Este prototipo incluye:</p>
    <ul>
        <li>Gestión de enfermedades</li>
        <li>Historial de accesos (login)</li>
        <li>Usuarios del sistema</li>
    </ul>

    <div class="menu">
        <a href="{{ route('enfermedades.index') }}">📋 Ver enfermedades</a>
        <a href="{{ route('enfermedades.create') }}">➕ Registrar enfermedad</a>
        <a href="{{ route('logins.index') }}">🕒 Historial de accesos</a>
        <!-- Puedes agregar más enlaces aquí -->
    </div>
</body>
</html>
