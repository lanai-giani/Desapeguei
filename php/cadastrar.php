<?php
// Definir a base URL primeiro
$base_url = 'http://' . $_SERVER['HTTP_HOST'] . '/Desapeguei/';
require 'conexao.php';

// Recebe dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$confirmar_senha = $_POST['confirmar_senha'];

// Validação básica no servidor
if ($senha !== $confirmar_senha) {
    header("Location: " . $base_url . "cadastro.html?erro=senhas_nao_coincidem");
    exit();
}

// Criptografa a senha
$senha_hash = password_hash($senha, PASSWORD_BCRYPT);

try {
    // Prepara e executa a query
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $email, $senha_hash]);
    
    // Redireciona com sucesso (usando $base_url)
    header("Location: " . $base_url . "login.html?cadastro=sucesso");
    exit();

} catch (PDOException $e) {
    // Trata erros específicos (usando $base_url)
    if ($e->getCode() == 23000) {
        header("Location: " . $base_url . "cadastro.html?erro=email_existente");
    } else {
        header("Location: " . $base_url . "cadastro.html?erro=servidor");
    }
    exit();
}
?>