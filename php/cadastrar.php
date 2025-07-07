<?php

$base_url = 'http://' . $_SERVER['HTTP_HOST'] . '/desapeguei/';
require 'conexao.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$confirmar_senha = $_POST['confirmar_senha'];

if ($senha !== $confirmar_senha) {
    header("Location: " . $base_url . "cadastro.html?erro=senhas_nao_coincidem");
    exit();
}
/*---criptografia da senha----*/
$senha_hash = password_hash($senha, PASSWORD_BCRYPT);

try {
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $email, $senha_hash]);
    
    header("Location: " . $base_url . "php/login.php?cadastro=sucesso");
    exit();

} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        header("Location: " . $base_url . "cadastro.html?erro=email_existente");
    } else {
        header("Location: " . $base_url . "cadastro.html?erro=servidor");
    }
    exit();
}
?>