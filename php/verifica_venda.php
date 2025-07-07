<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: ../vender.html"); 
    exit();
} else {
    echo "<script>
        alert('Você precisa estar logado para vender.');
        window.location.href = '../login.html';
    </script>";
    exit();
}