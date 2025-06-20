<?php
$host = 'localhost';
$db   = 'sistema_login';
$user = 'root'; // Usuário padrão do XAMPP
$pass = '';     // Sem senha no XAMPP padrão

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>