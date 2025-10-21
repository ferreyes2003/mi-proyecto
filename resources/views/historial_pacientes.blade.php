<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Historial de Pacientes</title>

  <!-- Estilos -->
  <style>
    body {
      background: #0d1117;
      color: #fff;
      font-family: 'Poppins', sans-serif;
      text-align: center;
      padding: 40px;
    }

    h2 {
      color: #00ffff;
      margin-bottom: 20px;
    }

    table {
      width: 90%;
      margin: 20px auto;
      border-collapse: collapse;
      background: #161b22;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 0 15px rgba(0,255,255,0.2);
    }

    th, td {
      padding: 12px;
      border-bottom: 1px solid #30363d;
      text-align: left;
    }

    th {
      color: #00ffff;
      text-transform: uppercase;
      font-weight: 600;
    }

    tr:hover {
      background: #1f2937;
    }

    a {
      color: #00ffff;
      text-decoration: none;
      font-weight: bold;
    }

    a:hover {
      text-decoration: underline;
    }

    /* DataTables */
    .dataTables_wrapper {
      color: #fff;
    }

    .dataTables_filter input {
      background: #0d1117;
      border: 1px solid #00ffff;
      border-radius: 5px;
      color: #fff;
      padding: 5px;
    }

    .dataTables_length select {
      background: #161b22;
      color: #fff;
      border: 1px solid #00ffff;
      border-radius: 5px;
    }

    .dataTables_info, .dataTables_paginate {
      color: #00ffff;
    }

    .paginate_button {
      color: #00ffff !important;
      border: none !important;
      background: none !important;
    }

    .paginate_button:hover {
      text-decoration: underline;
    }
  </style>

  <!-- CDN de jQuery y DataTables -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
</head>

<body>
  <h2>📋 Historial de Pacientes</h2>

  <table id="tabla-pacientes">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Edad</th>
        <th>Síntomas</th>
        <th>Diagnóstico</th>
        <th>Fecha</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pacientes as $p)
        <tr>
          <td>{{ $p->id }}</td>
          <td>{{ $p->nombre }}</td>
          <td>{{ $p->edad }}</td>
          <td>{{ $p->sintomas }}</td>
          <td>{{ $p->diagnostico }}</td>
          <td>{{ $p->created_at ? $p->created_at->format('d/m/Y H:i') : '—' }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <p><a href="{{ url('/asistente') }}">⬅️ Volver al Asistente</a></p>

  <script>
    $(document).ready(function() {
      $('#tabla-pacientes').DataTable({
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json'
        },
        order: [[5, 'desc']], // Ordenar por fecha descendente
        pageLength: 5,        // 5 pacientes por página
      });
    });
  </script>
</body>
</html>