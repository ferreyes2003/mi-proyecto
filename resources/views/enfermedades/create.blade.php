<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Registrar Enfermedad</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
  <div class="container">
    <h1 class="mb-4">Registrar Nueva Enfermedad</h1>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('enfermedades.store') }}">
      @csrf
      <div class="mb-3">
        <label for="Enfermedad" class="form-label">Enfermedad</label>
        <input type="text" id="Enfermedad" name="Enfermedad" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea id="descripcion" name="descripcion" class="form-control"></textarea>
      </div>

      <div class="mb-3">
        <label for="sintomas" class="form-label">Síntomas</label>
        <textarea id="sintomas" name="sintomas" class="form-control"></textarea>
      </div>

      <button type="submit" class="btn btn-primary">Guardar</button>
      <button type="submit" class="btn btn-primary">Eliminar</button>
      <button type="submit" class="btn btn-primary">Editar</button>
      <a href="{{ route('enfermedades.index') }}" class="btn btn-secondary">Volver</a>
    </form>
  </div>
</body>
</html>