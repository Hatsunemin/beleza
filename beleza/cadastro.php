<?php
// cadastro.php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

  $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $nome, $email, $senha);

  if ($stmt->execute()) {
    echo "Cadastro realizado com sucesso! <a href='login.php'>Login</a>";
  } else {
    echo "Erro: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
}
?>

<form method="POST">
  <h2>Cadastro</h2>
  <input type="text" name="nome" placeholder="Nome" required><br>
  <input type="email" name="email" placeholder="Email" required><br>
  <input type="password" name="senha" placeholder="Senha" required><br>
  <button type="submit">Cadastrar</button>
</form>
