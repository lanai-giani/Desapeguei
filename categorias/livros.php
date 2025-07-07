<?php
session_start();
require_once __DIR__ . '/../php/conexao.php';

if (isset($_SESSION['usuario'])) {
    echo "<script>localStorage.setItem('usuarioLogado', 'true');</script>";
} else {
    echo "<script>localStorage.removeItem('usuarioLogado');</script>";
}

$categoria = 'livros';
$subcategoria = $_GET['subcategoria'] ?? '';

if ($subcategoria) {
    $stmt = $pdo->prepare("SELECT * FROM anuncios WHERE categoria = ? AND subcategoria = ?");
    $stmt->execute([$categoria, $subcategoria]);
} else {
    $stmt = $pdo->prepare("SELECT * FROM anuncios WHERE categoria = ?");
    $stmt->execute([$categoria]);
}

$anuncios = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Livros | Desapeguei</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
</head>
<body>

<div class="banner">
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="../index.php"><img src="../assets/img/logoTeste.png" alt="desapeguei" width="180"></a>
            </div>
            <form class="barra-pesquisa" action="../php/buscar.php" method="GET">
                    <input type="search" name="q" placeholder="O que você procura?">
            </form>
            <nav>
                <ul id="menuItens">
                    <li><a href="../index.php">Início</a></li>
                    <li><a href="../vender.php">Vender</a></li>
                    <?php if (isset($_SESSION['usuario'])): ?>
                        <li class="dropdown">
                            <a href="../php/minha_conta.php" class="dropbtn">Minha Conta</a>
                            <div class="dropdown-content">
                                <a href="../php/minha_loja.php">Minha Loja</a>
                                <a href="../php/logout.php">Sair</a>
                            </div>
                        </li>
                    <?php else: ?>
                        <li><a href="../cadastro.html">Cadastrar/Entrar</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            <a href="../php/carrinho.php" id="btnCarrinho">
                <img src="../assets/img/carrinho (2).png" alt="Carrinho" width="30px" height="30px">
            </a>
            <img src="../assets/img/menu.png" alt="" class="menuCelular" onclick="menuCelular()">
        </div>
    </div>
</div>

<div class="pagina-busca">
    <div class="container">
        <h1 class="titulo">Livros</h1>
        
        <div class="filtros">
            <a href="livros.php" class="btn-filtro <?= empty($_GET['subcategoria']) ? 'ativo' : '' ?>">Todos</a>
            <a href="livros.php?subcategoria=romance" class="btn-filtro <?= ($_GET['subcategoria'] ?? '') === 'romance' ? 'ativo' : '' ?>">Romance</a>
            <a href="livros.php?subcategoria=ficcao" class="btn-filtro <?= ($_GET['subcategoria'] ?? '') === 'ficcao' ? 'ativo' : '' ?>">Ficção</a>
            <a href="livros.php?subcategoria=didatico" class="btn-filtro <?= ($_GET['subcategoria'] ?? '') === 'didatico' ? 'ativo' : '' ?>">Didáticos</a>
            <a href="livros.php?subcategoria=hq" class="btn-filtro <?= ($_GET['subcategoria'] ?? '') === 'hq' ? 'ativo' : '' ?>">HQ</a>
            <a href="livros.php?subcategoria=biografia" class="btn-filtro <?= ($_GET['subcategoria'] ?? '') === 'biografia' ? 'ativo' : '' ?>">Biografia</a>
            <a href="livros.php?subcategoria=terror" class="btn-filtro <?= ($_GET['subcategoria'] ?? '') === 'terror' ? 'ativo' : '' ?>">Terror</a>
        </div>

        <div class="linha produtos-container">
            <?php if (count($anuncios) > 0): ?>
                <?php foreach ($anuncios as $anuncio): ?>
                    <?php
                        $imagens = explode(',', $anuncio['imagens']);
                        $imagem_principal = $imagens[0] ?? 'placeholder.png';
                    ?>
                    <div class="col-4 produto" onclick="window.location.href='../php/produto.php?id=<?= $anuncio['id'] ?>'">
                        <div class="produto-conteudo">
                            <img src="../uploads/<?= htmlspecialchars($imagem_principal) ?>" alt="<?= htmlspecialchars($anuncio['titulo']) ?>">
                            <h4><?= htmlspecialchars($anuncio['titulo']) ?></h4>
                            <p>R$ <?= number_format($anuncio['preco'], 2, ',', '.') ?></p>
                            <p><?= htmlspecialchars($anuncio['descricao']) ?></p>
                        </div>

                        <form action="../php/adicionar_carrinho.php" method="POST" class="form-adicionar" onclick="event.stopPropagation();">
                            <input type="hidden" name="id_anuncio" value="<?= $anuncio['id'] ?>">
                            <button type="submit" class="btn btn-adicionar-carrinho">Adicionar ao carrinho</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="nenhum-resultado">
                    <h2>Nenhum produto encontrado</h2>
                    <p>Não há anúncios nesta categoria ainda.</p>
                    <a href="../index.php" class="btn">Voltar à página inicial</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<footer class="rodape">
    <div class="container">
        <div class="linha">
            <div class="rodape-col-1"> 
                <h3>Baixe o desapeguei no seu Smartphone</h3>
                <div class="app-logo">
                    <img src="../assets/img/google.png" alt="">
                    <img src="../assets/img/apple.png" alt="">
                </div>
            </div>
            <div class="rodape-col-2"> 
                <img src="../assets/img/logoTeste.png" alt="">
                <p>Desapeguei</p>
            </div>
            <div class="rodape-col-3"> 
                <h3>Mais informações:</h3>
                <ul>
                    <li>Blogs</li>
                    <li>Política de privacidade</li>
                    <li>Contatos</li>
                </ul>
            </div>
            <div class="rodape-col-4">
                <h3>Nossas redes sociais:
</h3>
                <ul>
                    <li>Facebook</li>
                    <li>Instagram</li>
                    <li>Twitter</li>
                    <li>TikTok</li>
                </ul>
            </div>
        </div>
        <hr>
        <p class="direitos"> &#169; Todos os direitos reservados a Desapeguei </p>
    </div>
</footer>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="../assets/js/app.js"></script>

</body>
</html>