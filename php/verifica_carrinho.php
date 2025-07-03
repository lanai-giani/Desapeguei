<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: carrinho.php");
    exit();
} else {
    echo "<script>
        alert('Você precisa estar logado para acessar o carrinho.');
        window.location.href = '../cadastro.html?redirect=carrinho';
    </script>";
    exit();
}
