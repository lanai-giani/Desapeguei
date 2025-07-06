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

                <form class="barra-pesquisa" action="php/buscar.php" method="GET">
                    <input type="search" name="q" placeholder="O que você procura?">
                </form>

                <nav>
                    <ul id="menuItens">
                        <li><a href="#">Início</a></li>
                        <li><a href="vender.php">Vender</a></li>
                        <?php if (isset($_SESSION['usuario'])): ?>
                        <li class="dropdown">
                            <a href="#" class="dropbtn">Minha Conta</a>
                            <div class="dropdown-content">
                                <a href="php/minha_loja.php">Minha Loja</a>
                                <a href="php/logout.php">Sair</a>
                            </div>
                        </li>
                        <?php else: ?>
                        <li><a href="cadastro.html">Cadastrar/Entrar</a></li>
                        <?php endif; ?>

                    </ul>
                </nav>

                <a href="php/carrinho.php">
                    <img src="assets/img/carrinho (2).png" alt="Carrinho" width="30px" height="30px">
                </a>


                <img src="assets/img/menu.png" alt="" class="menuCelular" onclick="menuCelular()">
            </div>

            <div class="linha">
                <div class="col-2">
                    <h1>Desapegue com propósito</h1>
                    <p>
                        Dê uma nova vida às suas peças esquecidas e descubra achados incríveis de quem também escolheu desapegar.
                        Compre e venda com propósito — aqui, cada escolha faz a diferença.
                    </p>
                    <br><a href="" class="btn">Mais informações: &#10157;</a>
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
        <button class="carrossel-btn prev-btn hidden" aria-label="Categorias anteriores">&lt;</button>
        
        <div class="carrossel-inner">
            
            <div class="col-3 categoria-img">
                <a href="categorias/vestuario.php">
                    <img src="assets/img/vestuario.jpg" alt="Vestuário">
                </a>
                <p class="categoria-nome">Vestuário</p>      
            </div>

            <div class="col-3 categoria-img">
                    <a href="categorias/calcados.php">
                        <img src="assets/img/calcado.jpg" alt="Calçados">
                    </a>
                    <p class="categoria-nome">Calçados</p>  
            </div>

            <div class="col-3 categoria-img">
                <a href="categorias/bolsas.php">
                <img src="assets/img/bolsa.jpg" alt="Bolsas">
                </a>
                <p class="categoria-nome">Bolsas</p>
            </div>

            <div class="col-3 categoria-img">
                <a href="categorias/beleza.php">
                <img src="assets/img/beleza.jpg" alt="Beleza e cuidados">
                </a>
                <p class="categoria-nome">Beleza e cuidados</p>
            </div>

            <div class="col-3 categoria-img hidden-categoria">
                <a href="categorias/livros.php">
                <img src="assets/img/livros.jpg" alt="Livros">
                </a>
               <p class="categoria-nome">Livros</p>
            </div>

            <div class="col-3 categoria-img hidden-categoria">
                <a href="categorias/eletronicos.php">
                <img src="assets/img/eletronico2.jpg" alt="Eletrônicos">
                </a>
                <p class="categoria-nome">Eletrônicos</p>
            </div>

            <div class="col-3 categoria-img hidden-categoria">
                <a href="categorias/kids.php">
                <img src="assets/img/kids.jpg" alt="Kids">
                </a>
                <p class="categoria-nome">Kids</p>
            </div>

            <div class="col-3 categoria-img hidden-categoria">
                <a href="categorias/acessorios.php">
                <img src="assets/img/acessorio.jpg" alt="acessorios">
                </a>
                <p class="categoria-nome">Acessórios</p>
            </div>

        </div>
        
        <button class="carrossel-btn next-btn" aria-label="Próximas categorias">&gt;</button>
    </div>
</div>

        <div class="corpo-categorias">
            <h2 class="titulo">Livros em destaque</h2>
            <div class="linha">
                <div class="col-4">
                    <img src="assets/img/livro 1.jpg" alt="">
                    <h4>Orgulho e preconceito</h4>
                    <p>R$ 25,00</p>
                </div>
                <div class="col-4">
                    <img src="assets/img/livro 2.jpg" alt="">
                    <h4>Helena</h4>
                    <p>R$ 20,00</p>
                </div>
                <div class="col-4">
                    <img src="assets/img/livro 3.jpg" alt="">
                    <h4>BTK Profile:Máscara da maldade </h4>
                    <p>R$ 67,00</p>
                </div>
                <div class="col-4">
                    <img src="assets/img/livro 4.jpg" alt="">
                    <h4>Sofia Copola Archive</h4>
                    <p>R$ 119,99</p>
                </div>
                <div class="col-4">
                    <img src="assets/img/livro 5.jpg" alt="">
                    <h4>Persuasão</h4>
                    <p>R$54,90</p>
                </div>
                <div class="col-4">
                    <img src="assets/img/livro 6.jpg" alt="">
                    <h4>Valley of the dolls</h4>
                    <p>R$ 58,00</p>
                </div>
                <div class="col-4">
                    <img src="assets/img/livro 7.jpg" alt="">
                    <h4>My Year of Rest and Relaxation</h4>
                    <p>R$ 82,50</p>
                </div>
                <div class="col-4">
                    <img src="assets/img/livro 8.jpg" alt="">
                    <h4>A little princess</h4>
                    <p>R$ 29,99</p>
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
                        <h1>Seja um vendedor e ganhe descontos incríveis!</h1>
                        <small>Transforme o que está parado no seu guarda-roupa em dinheiro e ainda ganhe desconto!
                                Desapegue do que você não usa mais e aproveite para renovar seu estilo com economia.</small>
                        <br><br><a href="vender.php" class="btn">Anuncie seu produto aqui!</a>
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
        <script src="assets/js/app.js"></script>

    </div>
</body>
</html>
