<?php
// index.php
include('conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Clínica de Estética</title>
  <link rel="stylesheet" href="style.css" />
  <!-- Font Awesome para ícones sociais -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poiret+One&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Anaheim&display=swap" rel="stylesheet">
</head>

<body>
  <header>
    <div class="navbar">
      <h1>ELYRA</h1>
      <nav>
        <ul>
          <li><a href="index.php">INÍCIO</a></li>
          <li><a href="#sobre">SOBRE</a></li>
          <li><a href="#servicos">SERVIÇOS</a></li>
          <li><a href="#contato">CONTATO</a></li>
          <li><a href="cadastro.php">CADASTRO</a></li>
          <a href="login.php" title="Login"><i class="fa-solid fa-lock"></i></a>
          <li><a href="logout.php">LOGOUT</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main>
    <section class="hero">
      <div class="hero-text">
        <small>Lançamentos</small>
        <h2>Metálicos</h2>
        <h3>Brilhe já</h3>
        <p>Conheça nossas novas sombras com acabamento brilhante, toque suave e leve com 10 horas de durabilidade.</p>
        <a href="cadastro.php"><button>Comprar</button></a>
      </div>
      <div class="hero-image"></div>
    </section>

    <section id="sobre" class="section2">
      <div class="section-content">
        <h2>Sobre Nós</h2>
        <p>Somos uma clínica especializada em estética avançada, com equipe altamente qualificada.</p>
      </div>
    </section>

    <section id="servicos" class="section3">
      <div class="section-content">
        <h2>Serviços</h2>
        <ul>
          <li>Limpeza de Pele</li>
          <li>Botox</li>
          <li>Preenchimento Facial</li>
          <li>Depilação a Laser</li>
        </ul>
      </div>
    </section>

    <section id="contato" class="section4">
      <div class="section-content">
        <h2>Contato</h2>
        <p>Endereço: Rua da Beleza, 123 - Centro</p>
        <p>Telefone: (11) 1234-5678</p>
        <p>Email: contato@clinicabella.com</p>
      </div>
    </section>
  </main>

  <footer class="footer-dark">
    <div class="newsletter">
      <h2>Você está <em>na lista?</em></h2>
      <p>Receba ofertas e descontos exclusivos</p>
      <form class="newsletter-form">
        <label for="email">Insira seu email aqui *</label>
        <div class="form-group">
          <input type="email" id="email" placeholder="Email" required />
          <button type="submit">Enviar</button>
        </div>
      </form>
    </div>

    <div class="footer-grid">
      <div>
        <h3>Nossa loja</h3>
        <p>Rua Prates, 194 - Bom Retiro<br>São Paulo - SP, 01121-000</p>
        <p>Seg a Sex: 11:00 às 22:00<br>Sáb e Dom: 11:00 às 24:00</p>
        <p>Tel: (11) 3456-7890<br>Email: info@meusite.com</p>
      </div>
      
      <div>
        <h3>Atendimento ao cliente</h3>
        <p>Tel: (11) 3456-7890<br>Email: info@meusite.com</p>
        <div class="social-icons">
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
      </div>
    </div>

    <div class="copyright">
      <p>&copy; <a>2025</a></p>
    </div>
  </footer>

  <!-- Chatbot IA -->
  <style>
    #chatbot-box {
      position: fixed;
      bottom: 20px;
      right: 20px;
      width: 320px;
      height: 450px;
      background: white;
      border: 1px solid #ccc;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      display: flex;
      flex-direction: column;
      overflow: hidden;
      z-index: 1000;
    }

    #chatbot-messages {
      flex: 1;
      padding: 10px;
      overflow-y: auto;
      font-size: 14px;
    }

    #chatbot-input {
      display: flex;
      border-top: 1px solid #ccc;
    }

    #chatbot-input input {
      flex: 1;
      padding: 10px;
      border: none;
      font-size: 14px;
      outline: none;
    }

    #chatbot-input button {
      background: #ff69b4;
      color: white;
      border: none;
      padding: 0 15px;
      cursor: pointer;
    }

    .chat-msg.bot { color: #555; margin: 5px 0; }
    .chat-msg.user { color: #000; font-weight: bold; margin: 5px 0; }
  </style>

  <div id="chatbot-box">
    <div id="chatbot-messages"></div>
    <div id="chatbot-input">
      <input type="text" id="chatbot-text" placeholder="Pergunte algo..." />
      <button onclick="sendMessage()">Enviar</button>
    </div>
  </div>

  <script>
  async function sendMessage() {
    const input = document.getElementById("chatbot-text");
    const msg = input.value.trim();
    if (!msg) return;

    appendMessage("user", msg);
    input.value = "";

    appendMessage("bot", "Pensando...");

    const resposta = await fetch("https://api.openai.com/v1/chat/completions", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "Authorization": "Bearer sk-proj-5Zz"
      },
      body: JSON.stringify({
        model: "gpt-3.5-turbo",
        messages: [{ role: "user", content: msg }],
        temperature: 0.7
      })
    });

    const dados = await resposta.json();
    const texto = dados.choices?.[0]?.message?.content || "Desculpe, não entendi.";
    removeThinking();
    appendMessage("bot", texto);
  }

  function appendMessage(tipo, texto) {
    const container = document.getElementById("chatbot-messages");
    const div = document.createElement("div");
    div.className = `chat-msg ${tipo}`;
    div.textContent = tipo === "user" ? `Você: ${texto}` : `Bot: ${texto}`;
    container.appendChild(div);
    container.scrollTop = container.scrollHeight;
  }

  function removeThinking() {
    const container = document.getElementById("chatbot-messages");
    const mensagens = container.querySelectorAll(".chat-msg.bot");
    if (mensagens.length > 0 && mensagens[mensagens.length - 1].textContent.includes("Pensando")) {
      container.removeChild(mensagens[mensagens.length - 1]);
    }
  }
  </script>

</body>
</html>
