<?php
session_start();
$base_url = dirname($_SERVER['SCRIPT_NAME']) . '/';
require_once 'conexao.php';


if (empty($_POST['email']) || empty($_POST['senha'])) {
    header("Location: " . $base_url . "login.html?erro=vazio");
    exit();
}

$email = $_POST['email'];
$senha = $_POST['senha'];

try {
    $stmt = $pdo->prepare("SELECT id, nome, email, senha, apelido FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if (!$usuario) {
        header("Location: " . $base_url . "login.php?erro=credenciais");
        exit();
    }

    if (password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nome' => $usuario['nome'],
            'apelido' => $usuario['apelido'],
            'email' => $usuario['email']
        ];

        header("Location: ../index.php");
        exit();
    } else {
        header("Location: " . $base_url . "login.php?erro=credenciais");
        exit();
    }
} catch (PDOException $e) {
    error_log("Erro no login: " . $e->getMessage());
    
    header("Location: " . $base_url . "login.html?erro=servidor");
    exit();
}
?>
