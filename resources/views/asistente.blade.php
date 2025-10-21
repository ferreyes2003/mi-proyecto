<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>🩺 Asistente Médico Inteligente</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #0d1117;
      color: #fff;
      text-align: center;
      padding: 40px;
    }
    #chat {
      width: 400px;
      height: 400px;
      background: #161b22;
      border: 1px solid #30363d;
      margin: 0 auto;
      border-radius: 10px;
      padding: 10px;
      overflow-y: scroll;
    }
    .usuario { text-align: right; color: #00ffff; margin: 10px; }
    .ia { text-align: left; color: #ccc; margin: 10px; }
    input {
      width: 70%;
      padding: 8px;
      margin-top: 10px;
      border-radius: 5px;
      border: none;
    }
    button {
      padding: 8px 12px;
      margin-left: 5px;
      border: none;
      border-radius: 5px;
      background: #238636;
      color: #fff;
      cursor: pointer;
    }
    button:hover { background: #2ea043; }
  </style>
</head>
<body>
  <h2>🩺 Asistente Médico Inteligente</h2>

  <div id="chat"></div>

  <div>
    <input type="text" id="entrada" placeholder="Escribe síntomas o consulta...">
    <button onclick="enviar()">Enviar</button>
  </div>

  <script>
    const chat = document.getElementById('chat');
    const entrada = document.getElementById('entrada');

    async function enviar() {
      const texto = entrada.value.trim();
      if (!texto) return;

      // Mostrar mensaje del usuario
      chat.innerHTML += `<div class="usuario">${texto}</div>`;
      entrada.value = '';

      const token = document.querySelector('meta[name="csrf-token"]').content;

      try {
        const res = await fetch('/asistente', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
          },
          body: JSON.stringify({ consulta: texto })
        });

        const data = await res.json();
        chat.innerHTML += `<div class="ia">${data.respuesta}</div>`;
        chat.scrollTop = chat.scrollHeight;
      } catch (error) {
        chat.innerHTML += `<div class="ia">⚠️ Error al conectar con el asistente.</div>`;
      }
    }

    // Permitir enviar con Enter
    entrada.addEventListener('keypress', (e) => {
      if (e.key === 'Enter') enviar();
    });
  </script>
</body>
</html>