<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Editar Enfermedad</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
  <div class="container">
    <h1 class="mb-4">Editar Enfermedad</h1>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Formulario de actualización --}}
    <form method="POST" action="{{ route('enfermedades.update', $enfermedad->id) }}">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label for="Enfermedad" class="form-label">Enfermedad</label>
        <input type="text" id="Enfermedad" name="Enfermedad" class="form-control" value="{{ old('Enfermedad', $enfermedad->Enfermedad) }}" required>
      </div>

      <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea id="descripcion" name="descripcion" class="form-control">{{ old('descripcion', $enfermedad->descripcion) }}</textarea>
      </div>

      <div class="mb-3">
        <label for="sintomas" class="form-label">Síntomas</label>
        <textarea id="sintomas" name="sintomas" class="form-control">{{ old('sintomas', $enfermedad->sintomas) }}</textarea>
      </div>

      <button type="submit" class="btn btn-primary">Actualizar</button>
      <a href="{{ route('enfermedades.index') }}" class="btn btn-secondary">Volver</a>
    </form>

    {{-- Botón de eliminación --}}
    <form method="POST" action="{{ route('enfermedades.destroy', $enfermedad->id) }}" class="mt-3">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta enfermedad?')">
        Eliminar
      </button>
    </form>
  </div>
</body>
</html>
