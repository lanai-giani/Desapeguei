<?php
session_start();
require_once __DIR__ . '/../php/conexao.php';

$categoria = 'acessorios';

$stmt = $pdo->prepare("SELECT * FROM anuncios WHERE categoria = ?");
$stmt->execute([$categoria]);
$anuncios = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Vestuário | desapeguei</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
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
                <li><a href="../index.php">Início</a></li>
                <li><a href="#">Produtos</a></li>
                <li><a href="../php/verifica_venda.php">Vender</a></li>
                <?php if (isset($_SESSION['usuario'])): ?>
                    <li class="dropdown">
                        <a href="../php/minha_conta.php" class="dropbtn">Minha Conta</a>
                        <div class="dropdown-content">
                            <a href="../php/logout.php">Sair</a>
                        </div>
                    </li>
                <?php else: ?>
                    <li><a href="../cadastro.html">Cadastrar/Entrar</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <img src="../assets/img/carrinho (2).png" alt="Carrinho" width="30" height="30">
        <img src="../assets/img/menu.png" alt="" class="menuCelular" onclick="menuCelular()">
    </div>

    <div class="container">
        <h1 class="titulo-categoria">Acessórios</h1>

        </div>

        <div class="linha produtos-container">
            <?php if (count($anuncios) > 0): ?>
                <?php foreach ($anuncios as $anuncio): ?>
                    <div class="col-4 produto">
                        <?php
                            $imagens = explode(',', $anuncio['imagens']);
                            $imagem_principal = $imagens[0] ?? 'assets/img/placeholder.png';
                        ?>
                        <img src="../uploads/<?= htmlspecialchars($imagem_principal) ?>" alt="<?= htmlspecialchars($anuncio['titulo']) ?>">
                        <h4><?= htmlspecialchars($anuncio['titulo']) ?></h4>
                        <p>R$ <?= number_format($anuncio['preco'], 2, ',', '.') ?></p>
                        <p><?= htmlspecialchars($anuncio['descricao']) ?></p>
                        <button class="btn">Comprar</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Não há anúncios nessa categoria ainda.</p>
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
                    <p>fvfdvf</p>
                </div>

                <div class="rodape-col-3"> 
                    <h3>Mais informações</h3>
                    <ul>
                        <li>Blogs</li>
                        <li>Política de privacidade</li>
                        <li>Contatos</li>
                    </ul>
                </div>

                <div class="rodape-col-4">
                    <h3>Nossas redes sociais</h3>
                    <ul>
                        <li>Facebook</li>
                        <li>Instagram</li>
                        <li>Twitter</li>
                        <li>TikTok</li>
                    </ul>
                </div>
            </div>
            <hr>
            <p class="direitos"> &#169; Todos os direitos reservados a desapeguei </p>
        </div>
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../assets/js/app.js"></script>

</body>
</html>
