<?php
// login.php
session_start();
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $senha = $_POST['senha'];

  $stmt = $conn->prepare("SELECT id, senha FROM usuarios WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $senha_hash);
    $stmt->fetch();
    if (password_verify($senha, $senha_hash)) {
      $_SESSION['usuario_id'] = $id;
      header("Location: agendamento.php");
      exit;
    } else {
      echo "Senha incorreta.";
    }
  } else {
    echo "Usuário não encontrado.";
  }
  $stmt->close();
  $conn->close();
}
?>

<form method="POST">
  <h2>Login</h2>
  <input type="email" name="email" placeholder="Email" required><br>
  <input type="password" name="senha" placeholder="Senha" required><br>
  <button type="submit">Entrar</button>
</form>
