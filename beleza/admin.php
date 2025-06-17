<?php
// admin.php
session_start();
include('conexao.php');

if (!isset($_SESSION['usuario_id'])) {
  echo "Acesso negado. Faça login como administrador.";
  exit();
}

$usuario_id = $_SESSION['usuario_id'];

$stmt = $conn->prepare("SELECT email FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$stmt->bind_result($email);
$stmt->fetch();
$stmt->close();

if ($email !== 'admin@clinicabella.com') {
  echo "Acesso restrito ao administrador.";
  exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Painel Administrativo</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <div class="navbar">
      <h1>Estética Bella</h1>
      <nav>
        <ul>
          <li><a href="index.php">Início</a></li>
          <li><a href="logout.php">Sair</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <main>
    <h2>Painel do Administrador - Todos os Agendamentos</h2>
    <?php
    $result = $conn->query("SELECT a.id, u.nome, a.procedimento, a.data FROM agendamentos a JOIN usuarios u ON a.usuario_id = u.id ORDER BY a.data DESC");

    while ($row = $result->fetch_assoc()) {
      echo "<p><strong>" . htmlspecialchars($row['nome']) . ":</strong> " . htmlspecialchars($row['procedimento']) . " em " . htmlspecialchars($row['data']) . "</p>";
    }

    $conn->close();
    ?>
  </main>
  <footer>
    <p>&copy; 2025 Clínica Estética Bella - Admin</p>
  </footer>
</body>
</html>
