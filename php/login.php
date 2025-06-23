<?php
session_start();
$base_url = dirname($_SERVER['SCRIPT_NAME']) . '/';
require_once __DIR__ . '/../conexao.php';

// Debug (opcional - remova depois)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verifica se campos estão vazios
if (empty($_POST['email']) || empty($_POST['senha'])) {
    header("Location: " . $base_url . "login.html?erro=vazio");
    exit();
}

$email = $_POST['email'];
$senha = $_POST['senha'];

try {
    // Busca usuário no banco
    $stmt = $pdo->prepare("SELECT id, nome, email, senha FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    // Verifica se usuário existe e senha está correta
    if (!$usuario) {
        header("Location: " . $base_url . "login.php?erro=credenciais");
        exit();
    }

    if (password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nome' => $usuario['nome'],
            'email' => $usuario['email']
        ];
        
        session_start();
        $_SESSION['usuario'] = $email; // ou ID, nome, etc.
        header("Location: ../index.php");
        exit();

        // Redireciona para área logada
        header("Location: /Desapeguei/index.html");
        exit();
    } else {
        header("Location: " . $base_url . "login.php?erro=credenciais");
        exit();
    }
} catch (PDOException $e) {
    // Log do erro (opcional)
    error_log("Erro no login: " . $e->getMessage());
    
    header("Location: " . $base_url . "login.html?erro=servidor");
    exit();
}
?>