<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desapeguei.com.br</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="banner"> 
        <!-- dddddddddddddddddddddddddddddddddddddddddddddd -->
        <div class="container">

            <div class="navbar">
                <div class="logo">
                    <img src="assets/img/logoTeste.png" alt="desapeguei" width="180px">
                </div>

                <form class="barra-pesquisa" action="#" method="GET">
                    <input type="search" name="q" placeholder="O que você procura?">
                </form>

                <nav>
                    <ul id="menuItens">
                        <li><a href="#">Início</a></li>
                        <li><a href="#">Produtos</a></li>
                        <li><a href="vender.php" id="btnVender" >Vender</a></li>
                        <?php if (isset($_SESSION['usuario'])): ?>
                        <li class="dropdown">
                            <a href="php/minha_conta.php" class="dropbtn">Minha Conta</a>
                            <div class="dropdown-content">
                        <a href="php/logout.php">Sair</a>
                        </div>
                        </li>
                        <?php else: ?>
                        <li><a href="cadastro.html">Cadastrar/Entrar</a></li>
                        <?php endif; ?>

                    </ul>
                </nav>

                <img src="assets/img/carrinho (2).png" alt="Carrinho" width="30px" height="30px">

                <img src="assets/img/menu.png" alt="" class="menuCelular" onclick="menuCelular()">
            </div>

            <div class="linha">
                <div class="col-2">
                    <h1>Escolha diminuir o consumo</h1>
                    <p>
                        Aqui, você pode vender aquelas peças que estão esquecidas no guarda-roupa há muito tempo e comprar novas ou usadas de várias marcas. <br>
                        Explore nosso site e descubra uma variedade incrível de produtos.
                    </p>
                    <br><a href="" class="btn">Mais informações &#10157;</a>
                </div>

                <div class="col-2">
                    <img src="assets/img/banner-1.png" alt="Banner principal">
                </div>
            </div>

        </div>
    </div>
<div class="corpo-categorias">
    <h2 class="titulo">Categorias</h2>
    <div class="carrossel-container">
        <!-- Botão de navegação anterior (inicialmente escondido) -->
        <button class="carrossel-btn prev-btn hidden" aria-label="Categorias anteriores">&lt;</button>
        
        <!-- Área das categorias -->
        <div class="carrossel-inner">
            <!-- Categorias visíveis -->
            <div class="col-3 categoria-img">
                <a href="vestuario.html">
                    <img src="assets/img/categoria-1.jpg" alt="Vestuário">
                </a>
                <p class="categoria-nome">Vestuário</p>
        </div>
            <div class="col-3 categoria-img">
                <img src="assets/img/categoria-2.jpg" alt="Calçados">
                <p class="categoria-nome">Calçados</p>
            </div>
            <div class="col-3 categoria-img">
                <img src="assets/img/categoria-3.jpg" alt="Eletrônicos">
                <p class="categoria-nome">Eletrônicos</p>
            </div>
            <div class="col-3 categoria-img">
                <img src="assets/img/categoria-4.webp" alt="Bolsas">
                <p class="categoria-nome">Bolsas</p>
            </div>
            
            <!-- Categorias ocultas (serão mostradas ao navegar) -->
            <div class="col-3 categoria-img hidden-categoria">
                <img src="assets/img/livro.png" alt="Livros">
                <p class="categoria-nome">Livros</p>
            </div>
            <div class="col-3 categoria-img hidden-categoria">
                <img src="assets/img/categoria-6.jpg" alt="Beleza e cuidados">
                <p class="categoria-nome">Beleza e cuidados</p>
            </div>
            <div class="col-3 categoria-img hidden-categoria">
                <img src="assets/img/categoria-7.jpg" alt="Assesórios">
                <p class="categoria-nome">Assesórios</p>
            </div>
            <div class="col-3 categoria-img hidden-categoria">
                <img src="assets/img/categoria-8.jpg" alt="Kids">
                <p class="categoria-nome">Kids</p>
            </div>
        </div>
        
        <!-- Botão de próxima categoria -->
        <button class="carrossel-btn next-btn" aria-label="Próximas categorias">&gt;</button>
    </div>
</div>

        <div class="corpo-categorias">
            <h2 class="titulo">Livros em destaque</h2>
            <div class="linha">
                <div class="col-4">
                    <img src="assets/img/produto-1.jpg" alt="">
                    <h4>O corvo</h4>
                    <p>R$ 10,00</p>
                </div>
                <div class="col-4">
                    <img src="assets/img/produto-2.jpg" alt="">
                    <h4>O corvo</h4>
                    <p>R$ 10,00</p>
                </div>
                <div class="col-4">
                    <img src="assets/img/produto-3.jpg" alt="">
                    <h4>O corvo</h4>
                    <p>R$ 10,00</p>
                </div>
                <div class="col-4">
                    <img src="assets/img/produto-4.jpg" alt="">
                    <h4>O corvo</h4>
                    <p>R$ 10,00</p>
                </div>
                <div class="col-4">
                    <img src="assets/img/produto-4.jpg" alt="">
                    <h4>O corvo</h4>
                    <p>R$ 10,00</p>
                </div>
                <div class="col-4">
                    <img src="assets/img/produto-4.jpg" alt="">
                    <h4>O corvo</h4>
                    <p>R$ 10,00</p>
                </div>
                <div class="col-4">
                    <img src="assets/img/produto-4.jpg" alt="">
                    <h4>O corvo</h4>
                    <p>R$ 10,00</p>
                </div>
                <div class="col-4">
                    <img src="assets/img/produto-4.jpg" alt="">
                    <h4>O corvo</h4>
                    <p>R$ 10,00</p>
                </div>
            </div>
        </div>

        <div class="ofertas">
            <div class="corpo-categorias">
                <div class="linha">
                    <div class="col-2">
                        <img src="assets/img/banner-2.png" alt="" class="oferta-img">
                    </div>
                    <div class="col-2">
                        <p>Ofertas exclusivas</p>
                        <h1>Seja um vendedor e ganhe descontos incríveis</h1>
                        <small>Sabe aquela peça que está parada no seu guarda-roupa que você não usa mais? Desapegue e faça ela virar dinheiro</small>
                        <br><br><a href="" class="btn">Anuncie seu produto aqui! &#8594;</a>
                    </div>
                </div>
            </div>
        </div>

        <footer class="rodape">
            <div class="container">
                <div class="linha">
                    <div class="rodape-col-1"> 
                        <h3>Baixe o desapeguei no seu Smartphone</h3>
                        <div class="app-logo">
                            <img src="assets/img/google.png" alt="">
                            <img src="assets/img/apple.png" alt="">
    
                        </div>
                    </div>

                    <div class="rodape-col-2"> 
                        <img src="assets/img/logoTeste.png" alt="">
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
        <script src="assets/js/app.js"></script>

    </div>
</body>
</html>
