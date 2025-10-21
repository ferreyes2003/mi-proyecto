<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Proyecto Pacientes</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* === ESTILO GENERAL === */
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background: radial-gradient(circle at center, #0b0b1f, #000);
      overflow-x: hidden;
      color: #fff;
      min-height: 100vh;
    }

    .container {
      text-align: center;
      padding: 50px 20px;
      animation: fadeIn 1s ease-in;
    }

    h1 {
      font-size: 3em;
      background: linear-gradient(90deg, #05ff9d, #00bfff, #ff00cc);
      background-size: 300% 300%;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      animation: gradientShift 6s ease infinite;
      margin-bottom: 15px;
    }

    p { font-size: 1.2em; color: #ccc; margin-bottom: 20px; }

    #avatar {
      width: 130px; height: 130px; border-radius: 50%;
      margin: 20px auto; display: block;
      border: 3px solid #05ff9d; box-shadow: 0 0 20px #05ff9d88;
      transition: transform 0.5s ease;
    }
    #avatar:hover { transform: rotate(10deg) scale(1.05); }

    .menu {
      margin-top: 40px;
      display: flex; flex-wrap: wrap; justify-content: center; gap: 20px;
    }
    .menu a {
      padding: 14px 28px;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid #05ff9d;
      color: #fff; text-decoration: none;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(5, 255, 157, 0.3);
      transition: all 0.3s ease; backdrop-filter: blur(5px);
    }
    .menu a:hover {
      background: #05ff9d; color: #000;
      transform: translateY(-3px);
      box-shadow: 0 6px 16px rgba(5, 255, 157, 0.6);
    }

    .search-box {
      margin: 40px auto;
      display: flex; justify-content: center; gap: 10px; flex-wrap: wrap;
    }
    .search-box input {
      padding: 12px 18px; border-radius: 8px; border: none;
      width: 250px; max-width: 80%; outline: none; font-size: 1em;
    }
    .search-box button {
      background: #05ff9d; border: none;
      padding: 12px 20px; border-radius: 8px;
      cursor: pointer; color: #000; font-weight: 600;
      transition: transform 0.2s;
    }
    .search-box button:hover { transform: scale(1.05); }

    /* === ASISTENTE MÉDICO === */
    #asistente {
      margin: 60px auto;
      width: 90%;
      max-width: 700px;
      background: rgba(255,255,255,0.05);
      border: 1px solid #05ff9d33;
      border-radius: 16px;
      padding: 25px;
      display: none;
      box-shadow: 0 0 20px rgba(5,255,157,0.1);
    }
    #chat-box {
      max-height: 300px;
      overflow-y: auto;
      text-align: left;
      margin-bottom: 15px;
      padding-right: 10px;
    }
    .mensaje {
      background: rgba(255,255,255,0.08);
      padding: 10px 14px;
      border-radius: 12px;
      margin: 8px 0;
      width: fit-content;
      max-width: 80%;
    }
    .usuario { background: #05ff9d; color: #000; margin-left: auto; }
    .ia { border: 1px solid #05ff9d44; }

    #entrada {
      width: 75%;
      padding: 10px;
      border-radius: 8px;
      border: none;
      outline: none;
    }
    #enviar {
      background: #05ff9d;
      border: none;
      padding: 10px 18px;
      border-radius: 8px;
      cursor: pointer;
      color: #000;
      font-weight: 600;
    }

    .historial-btns {
      margin-top: 15px;
      display: flex;
      justify-content: center;
      gap: 10px;
    }
    .historial-btns button {
      background: rgba(255,255,255,0.1);
      border: 1px solid #05ff9d;
      color: #05ff9d;
      padding: 8px 14px;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    .historial-btns button:hover {
      background: #05ff9d;
      color: #000;
      transform: translateY(-2px);
    }

    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

    #musica-btn {
      position: fixed; bottom: 25px; right: 25px;
      background: #111; border: 2px solid #05ff9d;
      border-radius: 50%; width: 50px; height: 50px;
      color: #05ff9d; font-size: 1.4em;
      cursor: pointer; transition: all 0.3s ease;
    }
    #musica-btn:hover {
      background: #05ff9d; color: #000;
      transform: rotate(10deg) scale(1.1);
    }
  </style>
</head>
<body>

<div class="container">
  <h1>🌌 ASISTENTE MEDICO 🌌</h1>
  <img id="avatar" src="data:image/jpeg;base64,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" alt="Avatar animado">
  <p>Gestiona enfermedades, usuarios y accesos del sistema desde un entorno moderno.</p>

  <div class="menu">
    <a href="{{ route('enfermedades.index') }}">📋 Ver Enfermedades</a>
    <a href="{{ route('enfermedades.create') }}">➕ Registrar Enfermedad</a>
    <a href="{{ route('logins.index') }}">🕒 Historial de Accesos</a>
    <a href="#" onclick="toggleAsistente()">🧠 Asistente Médico</a>
  </div>

  <div class="search-box">
    <input type="text" id="busqueda" placeholder="🔍 Buscar enfermedad...">
    <button onclick="buscarEnfermedad()">Buscar</button>
  </div>

  <!-- 🧠 Asistente Médico -->
  <div id="asistente">
    <h2>🧠 Asistente Médico Inteligente</h2>
    <div id="chat-box"></div>

    <div>
      <input type="text" id="entrada" placeholder="Escribe síntomas o una pregunta...">
      <button id="enviar" onclick="enviarMensaje()">Enviar</button>
    </div>

    <div class="historial-btns">
      <button onclick="window.location.href='/historial'">🕒 Consultas</button>
      <button onclick="window.location.href='/historial-pacientes'">👥 Pacientes</button>
    </div>
  </div>
</div>

<!-- Música -->
<audio id="musica" autoplay loop>
  <source src="musica/magia.mp3" type="audio/mpeg">
</audio>
<button id="musica-btn" onclick="toggleMusica()">🎵</button>

<script>
  const musica = document.getElementById('musica');
  const asistente = document.getElementById('asistente');
  const chatBox = document.getElementById('chat-box');
  const entrada = document.getElementById('entrada');

  function toggleMusica() {
    musica.paused ? musica.play() : musica.pause();
  }

  function buscarEnfermedad() {
    const nombre = document.getElementById('busqueda').value;
    if(nombre.trim() !== '') {
      window.location.href = `/enfermedades?nombre=${encodeURIComponent(nombre)}`;
    }
  }

  function toggleAsistente() {
  const visible = asistente.style.display === "block";
  asistente.style.display = visible ? "none" : "block";

  if (!visible) {
    chatBox.innerHTML = "";
    // Enviar una solicitud vacía para que el asistente inicie
    fetch('/asistente', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({ consulta: '' })
    })
    .then(res => res.json())
    .then(data => {
      chatBox.innerHTML += `<div class="mensaje ia">${data.respuesta}</div>`;
    });
  }
}

  async function enviarMensaje() {
    const texto = entrada.value.trim();
    if (texto === '') return;

    chatBox.innerHTML += `<div class="mensaje usuario">${texto}</div>`;
    entrada.value = '';
    chatBox.scrollTop = chatBox.scrollHeight;

    try {
      const response = await fetch('/asistente', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ consulta: texto })
      });

      const data = await response.json();
      chatBox.innerHTML += `<div class="mensaje ia">${data.respuesta}</div>`;
      chatBox.scrollTop = chatBox.scrollHeight;
    } catch (error) {
      console.error('Error:', error);
      chatBox.innerHTML += `<div class="mensaje ia">⚠️ Error al conectar con el asistente.</div>`;
    }
  }
</script>

</body>
</html>