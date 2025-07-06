<?php
session_start();
require_once 'conexao.php';

$busca = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING);

if (!$busca) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM anuncios WHERE titulo LIKE ? OR descricao LIKE ?");
$termo = '%' . $busca . '%';
$stmt->execute([$termo, $termo]);
$resultados = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultados da busca por "<?= htmlspecialchars($busca) ?>"</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="banner">
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="../index.php">
                    <img src="../assets/img/logoTeste.png" alt="desapeguei" width="180px">
                </a>
            </div>

            <form class="barra-pesquisa" action="buscar.php" method="GET">
                <input type="search" name="q" placeholder="O que você procura?" value="<?= htmlspecialchars($busca) ?>">
            </form>

            <nav>
                <ul id="menuItens">
                    <li><a href="../index.php">Início</a></li>
                    <li><a href="../vender.php">Vender</a></li>
                    <?php if (isset($_SESSION['usuario'])): ?>
                        <li class="dropdown">
                            <a href="php/minha_conta.php" class="dropbtn">Minha Conta</a>
                            <div class="dropdown-content">
                                <a href="../php/minha_loja.php">Minha Loja</a>
                                <a href="php/logout.php">Sair</a>
                            </div>
                        </li>
                    <?php else: ?>
                        <li><a href="cadastro.html">Cadastrar/Entrar</a></li>
                    <?php endif; ?>
                </ul>
            </nav>

            <a href="carrinho.php">
                <img src="../assets/img/carrinho (2).png" alt="Carrinho" width="30px" height="30px">
            </a>

            <img src="assets/img/menu.png" alt="menu" class="menuCelular" onclick="menuCelular()">
        </div>
    </div>
</div>

<!-- ✅ Resultados da busca -->
<div class="pagina-busca">
    <div class="container">
        <div class="cabecalho-busca">
            <h1>Resultados da busca por: <span>"<?= htmlspecialchars($busca) ?>"</span></h1>
            <p class="total-resultados"><?= count($resultados) ?> itens encontrados</p>
        </div>

        <?php if (count($resultados) > 0): ?>
            <div class="filtros-ordem">
                <div class="filtros-container">
                    <button class="btn-filtro ativo">Todos</button>
                    <button class="btn-filtro">Mais recentes</button>
                    <button class="btn-filtro">Menor preço</button>
                    <button class="btn-filtro">Maior preço</button>
                </div>
            </div>

            <div class="resultados-container">
                <div class="grade-produtos">
                    <?php foreach ($resultados as $produto): ?>
                        <div class="produto-card">
                            <a href="produto.php?id=<?= $produto['id'] ?>">
                                <div class="produto-imagem-container">
                                    <img src="../uploads/<?= htmlspecialchars(explode(',', $produto['imagens'])[0]) ?>" alt="<?= htmlspecialchars($produto['titulo']) ?>" class="produto-imagem">
                                </div>
                                <div class="produto-info">
                                    <h3 class="produto-titulo"><?= htmlspecialchars($produto['titulo']) ?></h3>
                                    <p class="produto-preco">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="nenhum-resultado">
                <h2>Nenhum produto encontrado</h2>
                <p>Não encontramos resultados para "<?= htmlspecialchars($busca) ?>". Tente outros termos.</p>
                <a href="../index.php" class="btn">Voltar à página inicial</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="assets/js/app.js"></script>
</body>
</html>