<?php
session_start();
require_once __DIR__ . '/conexao.php';

$busca = $_GET['q'] ?? '';

if (!isset($_SESSION['usuario'])) {
    header("Location: ../cadastro.html");
    exit;
}

$usuario_id = $_SESSION['usuario']['id'];
$nomeUsuario = $_SESSION['usuario']['nome'];

if (isset($_GET['excluir'])) {
    $idAnuncio = (int)$_GET['excluir'];

    $stmt = $pdo->prepare("SELECT * FROM anuncios WHERE id = ? AND usuario_id = ?");
    $stmt->execute([$idAnuncio, $usuario_id]);
    $anuncio = $stmt->fetch();

    if ($anuncio) {

        if (!empty($anuncio['foto']) && file_exists("../uploads/" . $anuncio['foto'])) {
            unlink("../uploads/" . $anuncio['foto']);
        }

        $stmt = $pdo->prepare("DELETE FROM anuncios WHERE id = ?");
        $stmt->execute([$idAnuncio]);

        header("Location: minha_loja.php");
        exit;
    }
}

$stmt = $pdo->prepare("SELECT * FROM anuncios WHERE usuario_id = ? ORDER BY id DESC");
$stmt->execute([$usuario_id]);
$meusProdutos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minha Loja | Desapeguei</title>
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
                                <a href="minha_loja.php">Minha Loja</a>
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

<div class="corpo-categorias">
    <h2 class="titulo">Minha Loja</h2>
    <p style="text-align: center; font-size: 18px; color: var(--cor-fonte-corpo); margin-bottom: 40px;">
        Olá, <strong><?= htmlspecialchars($nomeUsuario) ?></strong>! Veja os produtos que você anunciou.
    </p>

    <div class="linha">
        <?php if (count($meusProdutos) > 0): ?>
            <?php foreach ($meusProdutos as $produto): ?>
                <div class="col-4 produto">
                    <img src="../uploads/<?= htmlspecialchars($produto['imagens']) ?>" alt="<?= htmlspecialchars($produto['titulo']) ?>">
                    <h4><?= htmlspecialchars($produto['titulo']) ?></h4>
                    <p>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
                   <form action="?excluir=<?= $produto['id'] ?>" method="GET" class="form-adicionar" onsubmit="return confirm('Tem certeza que deseja excluir este anúncio?');">
    <input type="hidden" name="excluir" value="<?= $produto['id'] ?>">
    <button type="submit" class="btn btn-adicionar-carrinho">Excluir</button>
</form>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; width: 100%; color: var(--cor-fonte-corpo-leve); font-size: 16px;">
                Você ainda não anunciou nenhum produto.
            </p>
        <?php endif; ?>
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

</body>
</html>
