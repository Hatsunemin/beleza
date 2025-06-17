<?php
// agendamento.php
session_start();
include('conexao.php');

if (!isset($_SESSION['usuario_id'])) {
  echo "<p>Você precisa estar logado para acessar esta página. <a href='login.php'>Login</a></p>";
  exit;
}

$usuario_id = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $procedimento = $_POST['procedimento'];
  $data = $_POST['data'];

  $stmt = $conn->prepare("INSERT INTO agendamentos (usuario_id, data, procedimento) VALUES (?, ?, ?)");
  $stmt->bind_param("iss", $usuario_id, $data, $procedimento);
  if ($stmt->execute()) {
    echo "<div class='message success'>Agendamento realizado com sucesso!</div>";
  } else {
    echo "<div class='message error'>Erro: " . htmlspecialchars($stmt->error) . "</div>";
  }
  $stmt->close();
}

// Exibir agendamentos do usuário
$stmt = $conn->prepare("SELECT data, procedimento FROM agendamentos WHERE usuario_id = ? ORDER BY data DESC");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

echo "<h2>Seus Agendamentos</h2>";
if ($result->num_rows === 0) {
  echo "<p class='no-appointments'>Nenhum agendamento encontrado.</p>";
} else {
  while ($row = $result->fetch_assoc()) {
    $data_formatada = date('d/m/Y H:i', strtotime($row['data']));
    echo "<p class='appointment-item'><strong>" . htmlspecialchars($row['procedimento']) . "</strong> <span class='appointment-date'>- " . $data_formatada . "</span></p>";
  }
}
$stmt->close();
$conn->close();
?>

<h2>Novo Agendamento</h2>
<form method="POST" class="agendamento-form" novalidate>
  <label for="procedimento" class="form-label">Procedimento</label>
  <input type="text" id="procedimento" name="procedimento" placeholder="Procedimento" required>

  <label for="data" class="form-label">Data e Hora</label>
  <input type="datetime-local" id="data" name="data" required>

  <button type="submit" class="btn-primary">Agendar</button>
</form>

<section class="services-section">
  <h2>Serviços Oferecidos</h2>
  <div class="services-container">
    <article class="service-card">
      <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/d0d6f7d9-e66e-46ea-84fb-2da75de4049c.png" alt="Imagem ilustrativa de serviço de massagem" loading="lazy">
      <h3>Massagem Relaxante</h3>
      <p>Técnicas de massagem para relaxar corpo e mente, aliviando tensões.</p>
    </article>
    <article class="service-card">
      <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/0ccf566e-43fc-4b68-8901-ef357dd0d34f.png" alt="Imagem ilustrativa de limpeza de pele" loading="lazy">
      <h3>Limpeza de Pele Profunda</h3>
      <p>Tratamento facial para remoção de impurezas, deixando a pele renovada.</p>
    </article>
    <article class="service-card">
      <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/ac9876c7-d038-448d-969c-dad486d77b2b.png" alt="Imagem ilustrativa de corte de cabelo estiloso" loading="lazy">
      <h3>Corte de Cabelo Moderno</h3>
      <p>Estilo personalizado conforme sua preferência, com profissionais qualificados.</p>
    </article>
     <article class="service-card">
      <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/ac9876c7-d038-448d-969c-dad486d77b2b.png" alt="Imagem ilustrativa de corte de cabelo estiloso" loading="lazy">
      <h3>Corte de Cabelo Moderno</h3>
      <p>Estilo personalizado conforme sua preferência, com profissionais qualificados.</p>
    </article>
     <article class="service-card">
      <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/ac9876c7-d038-448d-969c-dad486d77b2b.png" alt="Imagem ilustrativa de corte de cabelo estiloso" loading="lazy">
      <h3>Corte de Cabelo Moderno</h3>
      <p>Estilo personalizado conforme sua preferência, com profissionais qualificados.</p>
    </article>
     <article class="service-card">
      <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/ac9876c7-d038-448d-969c-dad486d77b2b.png" alt="Imagem ilustrativa de corte de cabelo estiloso" loading="lazy">
      <h3>Corte de Cabelo Moderno</h3>
      <p>Estilo personalizado conforme sua preferência, com profissionais qualificados.</p>
    </article>
     <article class="service-card">
      <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/ac9876c7-d038-448d-969c-dad486d77b2b.png" alt="Imagem ilustrativa de corte de cabelo estiloso" loading="lazy">
      <h3>Corte de Cabelo Moderno</h3>
      <p>Estilo personalizado conforme sua preferência, com profissionais qualificados.</p>
    </article>
     <article class="service-card">
      <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/ac9876c7-d038-448d-969c-dad486d77b2b.png" alt="Imagem ilustrativa de corte de cabelo estiloso" loading="lazy">
      <h3>Corte de Cabelo Moderno</h3>
      <p>Estilo personalizado conforme sua preferência, com profissionais qualificados.</p>
    </article>
     <article class="service-card">
      <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/ac9876c7-d038-448d-969c-dad486d77b2b.png" alt="Imagem ilustrativa de corte de cabelo estiloso" loading="lazy">
      <h3>Corte de Cabelo Moderno</h3>
      <p>Estilo personalizado conforme sua preferência, com profissionais qualificados.</p>
    </article>
  </div>
</section>

<style>
  /* Basic reset */
  *, *::before, *::after {
    box-sizing: border-box;
  }

  body {
    background: #fafafa;
    margin: 0 auto;
    padding: 30px 20px;
    max-width: 1200px;
    font-family: 'Open Sans', Arial, sans-serif;
    color: #2c2c2c;
    font-size: 16px;
    line-height: 1.5;
  }

  /* Typography and headings */
  h2 {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    font-size: 2.5rem;
    color: #1a1a1a;
    margin-bottom: 32px;
    text-align: center;
    letter-spacing: 0.05em;
  }

  h3 {
    font-size: 1.3rem;
    margin: 16px 0 8px;
    color: #4a4a4a;
  }
  
  p {
    margin-bottom: 1em;
  }

  /* Appointment display */
  .appointment-item {
    background: #fff;
    padding: 14px 24px;
    border-radius: 16px;
    box-shadow: 0 6px 12px rgb(0 0 0 / 0.08);
    margin-bottom: 16px;
    font-weight: 600;
    font-size: 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: background-color 0.3s ease;
  }
  .appointment-item:hover {
    background-color: #f0e7e5;
  }
  .appointment-date {
    font-weight: 400;
    color: #7a7a7a;
    font-size: 0.9rem;
  }
  .no-appointments {
    color: #7a7a7a;
    font-style: italic;
    text-align: center;
    margin-bottom: 30px;
  }

  /* Form styling */
  form.agendamento-form {
    background: #fff;
    padding: 40px 35px;
    border-radius: 24px;
    box-shadow: 0 10px 30px rgb(174 91 80 / 0.15);
    max-width: 480px;
    margin: 0 auto 60px;
    display: flex;
    flex-direction: column;
  }

  .form-label {
    font-weight: 600;
    color: #555;
    margin-bottom: 8px;
  }

  input[type="text"],
  input[type="datetime-local"] {
    font-family: 'Open Sans', Arial, sans-serif;
    padding: 16px 20px;
    border: 2px solid #ddd;
    border-radius: 16px;
    font-size: 1.1rem;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    margin-bottom: 24px;
    width: 100%;
  }

  input[type="text"]:focus,
  input[type="datetime-local"]:focus {
    outline: none;
    border-color: #ae5b50;
    box-shadow: 0 0 10px #ae5b50aa;
  }

  /* Button style */
  .btn-primary {
    background-color: #ae5b50;
    color: #fff;
    border: none;
    padding: 18px 0;
    border-radius: 20px;
    font-weight: 700;
    font-size: 1.25rem;
    cursor: pointer;
    box-shadow: 0 8px 16px rgba(174, 91, 80, 0.35);
    transition: background-color 0.3s ease, transform 0.2s ease;
  }
  .btn-primary:hover,
  .btn-primary:focus {
    background-color: #9e4e46;
    transform: translateY(-3px);
    outline: none;
  }

  /* Message feedbacks */
  .message {
    text-align: center;
    font-weight: 700;
    margin: 24px 0;
    padding: 12px 20px;
    border-radius: 12px;
    max-width: 480px;
    margin-left: auto;
    margin-right: auto;
  }
  .message.success {
    background-color: #daf7dc;
    color: #2f6627;
    box-shadow: 0 4px 8px rgba(47, 102, 39, 0.3);
  }
  .message.error {
    background-color: #f7dada;
    color: #662727;
    box-shadow: 0 4px 8px rgba(102, 39, 39, 0.3);
  }

  /* Services section */
  .services-section {
    max-width: 1200px;
    margin: 0 auto 60px;
    padding: 0 20px;
  }

  .services-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px,1fr));
    gap: 32px;
  }

  .service-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
    padding-bottom: 20px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
  }

  .service-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 14px 34px rgba(0, 0, 0, 0.15);
  }

  .service-card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
    display: block;
  }

  .service-card h3 {
    margin: 16px 20px 8px;
    color: #3f3f3f;
  }

  .service-card p {
    margin: 0 20px 20px;
    color: #6a6a6a;
    font-size: 0.95rem;
    line-height: 1.4;
  }

  /* Responsive adjustments */
  @media (max-width: 767px) {
    body {
      padding: 20px 12px;
      max-width: 100%;
    }

    form.agendamento-form {
      padding: 30px 20px;
    }

    h2 {
      font-size: 2rem;
      margin-bottom: 24px;
    }
  }
</style>

