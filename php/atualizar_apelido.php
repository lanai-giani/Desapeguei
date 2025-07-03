<?php
session_start();
require_once __DIR__ . '/../php/conexao.php';

if (!isset($_SESSION['usuario']) || empty($_POST['apelido'])) {
    http_response_code(400);
    exit("Requisição inválida");
}

$usuario_id = $_SESSION['usuario']['id'];
$apelido = trim($_POST['apelido']);

$stmt = $pdo->prepare("UPDATE usuarios SET apelido = ? WHERE id = ?");
$stmt->execute([$apelido, $usuario_id]);

// Atualiza sessão
$_SESSION['usuario']['apelido'] = $apelido;

echo "Apelido atualizado com sucesso";
