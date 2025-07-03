<?php
session_start();

// Redireciona para login se não estiver logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$usuario = $_SESSION['usuario']; // Supondo que esse seja um array com dados do usuário
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minha Conta | Desapeguei</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="navbar">
        <div class="logo">
            <a href="../index.php"><img src="../assets/img/logoTeste.png" alt="desapeguei" width="180"></a>
        </div>
        <form class="barra-pesquisa" action="#" method="GET">
            <input type="search" name="q" placeholder="O que você procura?">
        </form>
                <nav>
                    <ul id="menuItens">
                        <li><a href="index.php">Início</a></li>
                        <li><a href="vender.php">Vender</a></li>
                        <?php if (isset($_SESSION['usuario'])): ?>
                        <li class="dropdown">
                            <a href="php/minha_conta.php" class="dropbtn">Minha Conta</a>
                            <div class="dropdown-content">
                                <a href="php/enderecos.php">Meus Endereços</a>
                                <a href="php/minha_loja.php">Minha Loja</a>
                                <a href="../php/logout.php">Sair</a>
                            </div>
                        </li>
                        <?php else: ?>
                        <li><a href="cadastro.html">Cadastrar/Entrar</a></li>
                        <?php endif; ?>

                    </ul>
                </nav>

<!-- NAVBAR padrão -->
<div class="navbar">
    <div class="logo">
        <a href="index.php"><img src="assets/img/logo.png" alt="Logo Desapeguei"></a>
    </div>

    <div class="barra-pesquisa">
        <form action="busca.php" method="GET">
            <input type="search" name="q" placeholder="Buscar produtos...">
        </form>
    </div>

    <nav>
        <ul>
            <li><a href="index.php">Início</a></li>
            <li class="dropdown">
                <a href="#" class="dropbtn"><?php echo htmlspecialchars($usuario['nome']); ?></a>
                <div class="dropdown-content">
                    <a href="produtos_usuario.php">Produtos à venda</a>
                    <a href="logout.php">Sair</a>
                </div>
            </li>
        </ul>
    </nav>

    <img src="assets/img/menu.png" class="menuCelular" onclick="menuCelular()">
</div>

<!-- Conteúdo da página -->
<div class="container">
    <h1 class="titulo-categoria">Minha Conta</h1>

    <div class="login-box">
        <h1>Olá, <?php echo htmlspecialchars($usuario['nome']); ?>!</h1>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>


        <a href="produtos_usuario.php" class="btn">Ver meus produtos</a>
        <a href="logout.php" class="btn">Sair da conta</a>
    </div>
</div>

<!-- Rodapé -->

<script src="assets/js/app.js"></script>
</body>
</html>
