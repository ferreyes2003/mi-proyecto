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
  <h1>🌌 Bienvenido al Proyecto de Pacientes 🌌</h1>
  <img id="avatar" src="https://api.dicebear.com/7.x/adventurer/svg?seed=Jean" alt="Avatar animado">
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