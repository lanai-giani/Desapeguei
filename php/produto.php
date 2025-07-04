<?php
session_start();
require_once __DIR__ . '/conexao.php';

// Validação segura do ID do produto
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: index.php');
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM anuncios WHERE id = ?");
    $stmt->execute([$id]);
    $produto = $stmt->fetch();

    if (!$produto) {
        header('Location: 404.php'); // Página de erro personalizada
        exit;
    }

    $imagens = explode(',', $produto['imagens']);
} catch (PDOException $e) {
    error_log("Erro ao buscar produto: " . $e->getMessage());
    header('Location: erro.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($produto['titulo']) ?> | Desapeguei</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="vender_style">

<!-- Navbar Melhorada -->
<!-- Navbar Padronizada -->
<div class="navbar">
    <div class="logo">
        <a href="../index.php"><img src="../assets/img/logoTeste.png" alt="Desapeguei" width="180"></a>
    </div>

    <form class="barra-pesquisa" action="buscar.php" method="GET">
        <input type="search" name="q" placeholder="O que você procura?" value="">
    </form>

    <nav>
        <ul id="menuItens">
            <li><a href="../index.php">Início</a></li>
            <li><a href="../vender.php">Vender</a></li>
            <li class="dropdown">
                <a href="#">Minha Conta</a>
                <div class="dropdown-content">
                    <a href="#">Meus Endereços</a>
                    <a href="#">Minha Loja</a>
                    <a href="../php/logout.php">Sair</a>
                </div>
            </li>
        </ul>
    </nav>

    <a href="../php/carrinho.php">
        <img src="../assets/img/carrinho (2).png" alt="Carrinho" width="30" height="30">
    </a>

    <img src="assets/img/menu.png" alt="Menu" class="menuCelular" onclick="menuCelular()">
</div>


<!-- Conteúdo Principal -->
<main class="produto-detalhes-container">
    <!-- Galeria Melhorada -->
    <section class="galeria">
        <div class="imagem-principal">
            <img id="imagemPrincipal" src="../uploads/<?= htmlspecialchars($imagens[0]) ?>" 
                 alt="<?= htmlspecialchars($produto['titulo']) ?>" 
                 loading="lazy">
        </div>
        <div class="miniaturas">
            <?php foreach ($imagens as $index => $img): ?>
                <img src="../uploads/<?= htmlspecialchars($img) ?>" 
                     alt="Miniatura <?= $index + 1 ?>" 
                     class="<?= $index === 0 ? 'ativa' : '' ?>" 
                     onclick="mudarImagem(this)"
                     loading="lazy">
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Informações do Produto -->
    <section class="info">
        <h1><?= htmlspecialchars($produto['titulo']) ?></h1>

        <div class="preco">
            <span class="promocional">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></span>
            <?php if (!empty($produto['preco_original']) && $produto['preco_original'] > $produto['preco']): ?>
                <span class="original">De: R$ <?= number_format($produto['preco_original'], 2, ',', '.') ?></span>
                <span class="desconto"><?= calcularDesconto($produto['preco_original'], $produto['preco']) ?>% OFF</span>
            <?php endif; ?>
        </div>

        <form action="../php/adicionar_carrinho.php" method="POST" class="form-comprar">
            <input type="hidden" name="id_anuncio" value="<?= $produto['id'] ?>">
            
            
            <button type="submit" class="btn-carrinho">
                <i class="fas fa-shopping-cart"></i> Adicionar ao Carrinho
            </button>
        </form>

        <div class="descricao">
            <h2>Descrição do Produto:</h2>
            <p><?= nl2br(htmlspecialchars($produto['descricao'])) ?></p>
        </div>

        <div class="detalhes">
            <h2>Detalhes:</h2>
            <ul>
                <?php if (!empty($produto['condicao'])): ?>
                    <li><strong>Condição:</strong> <?= htmlspecialchars($produto['condicao']) ?></li>
                <?php endif; ?>
                <?php if (!empty($produto['marca'])): ?>
                    <li><strong>Marca:</strong> <?= htmlspecialchars($produto['marca']) ?></li>
                <?php endif; ?>
                <li><strong>Vendido por:</strong> <?= htmlspecialchars($produto['vendedor_nome'] ?? 'Loja Desapeguei') ?></li>
            </ul>
        </div>
    </section>
</main>

<script>
    function mudarImagem(img) {
        // Atualiza imagem principal
        document.getElementById('imagemPrincipal').src = img.src;
        
        // Atualiza classe ativa
        document.querySelectorAll('.miniaturas img').forEach(el => {
            el.classList.remove('ativa');
        });
        img.classList.add('ativa');
        
        // Efeito visual
        img.parentElement.scroll({
            left: img.offsetLeft - (img.parentElement.offsetWidth / 2) + (img.offsetWidth / 2),
            behavior: 'smooth'
        });
    }
</script>

<script src="assets/js/app.js"></script>
</body>
</html>