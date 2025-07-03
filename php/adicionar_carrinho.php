<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    // Usuário não está logado, redireciona para login
    header('Location: ../cadastro.html?redirect=carrinho');
    exit;
}

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

if (isset($_POST['id_anuncio'])) {
    $id_anuncio = intval($_POST['id_anuncio']);

    // Evita duplicatas
    if (!in_array($id_anuncio, $_SESSION['carrinho'])) {
        $_SESSION['carrinho'][] = $id_anuncio;
    }
}

// Redireciona para o carrinho
header('Location: carrinho.php');
exit;
