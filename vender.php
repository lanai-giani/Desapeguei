<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Anunciar Produto | desapeguei</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="vender_style">

    <div class="navbar">
        <div class="logo">
            <a href="index.php"><img src="assets/img/logoTeste.png" alt="desapeguei" width="180"></a>
        </div>

        <form class="barra-pesquisa" action="php/buscar.php" method="GET">
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
        <img src="assets/img/menu.png" alt="Menu" class="menuCelular" onclick="menuCelular()">
    </div>

    <div class="container">
        <h1 class="titulo-vender">Anunciar Produto</h1>
        
        <form id="formAnuncio" class="form-anuncio" action="php/processa_anuncio.php" method="POST" enctype="multipart/form-data">
            <!-- Fotos -->
            <div class="input-group foto-section">
                <label for="fotos">Fotos</label>
                <div class="foto-instructions">Adicione até 5 fotos do produto</div>
                <input type="file" id="fotos" name="fotos[]" multiple accept="image/*">
                <div id="preview-fotos" class="preview-container"></div>
            </div>
            
            <!-- Título -->
            <div class="input-group">
                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" placeholder="ex: 'vestido farm sensação' ou 'blusa adidas grito da moda'" required>
            </div>
        
            <!-- Descrição -->
            <div class="input-group">
                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" rows="4" placeholder="ex: vestido floral farm, coleção borboletas, em seda colorida, ótimo acabamento, você vai amar. faz muito frio em sp, quase não usei." required></textarea>
                <div class="char-counter"><span id="char-count">0</span> de 350 caracteres</div>
            </div>
            
            <!-- Estado do Produto -->
            <div class="input-group estado-produto">
                <label>Estado do produto</label>
                <div class="radio-group">
                    <input type="radio" id="usado" name="estado" value="usado" checked>
                    <label for="usado">Produto usado</label>
                    
                    <input type="radio" id="novo" name="estado" value="novo">
                    <label for="novo">Produto novo</label>
                </div>
            </div>
            
            <!-- Categoria -->
            <div class="input-group">
                <label for="categoria">Categoria</label>
                <select id="categoria" name="categoria" required>
                    <option value="">Selecione...</option>
                    <option value="vestuario">Vestuário</option>
                    <option value="calcados">Calçados</option>
                    <option value="eletronicos">Eletrônicos</option>
                    <option value="bolsas">Bolsas</option>
                    <option value="livros">Livros</option>
                    <option value="beleza">Beleza e cuidados</option>
                    <option value="acessorios">Acessórios</option>
                    <option value="kids">Kids</option>
                </select>
            </div>
            <div class="input-group">
                <label for="subcategoria">Subcategoria</label>
                <select id="subcategoria" name="subcategoria" required>
                    <option value="">Selecione uma categoria primeiro...</option>
                </select>
            </div>
            <!-- Preço -->
            <div class="input-group preco-section">
                <label for="preco">Preço</label>
                <div class="preco-input">
                    <span>R$</span>
                    <input type="number" id="preco" name="preco" step="0.01" min="0" required>
                </div>
            </div>
            
            <button type="submit" class="btn btn-anunciar">Publicar Anúncio</button>
        </form>
    </div>

 
    <script src="assets/js/app.js"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const descricao = document.getElementById('descricao');
        const charCount = document.getElementById('char-count');

        descricao.addEventListener('input', function () {
            charCount.textContent = this.value.length;
        });

        <?php if (!isset($_SESSION['usuario'])) : ?>
            alert('Você precisa estar logado para vender!');
            window.location.href = 'cadastro.html';
        <?php endif; ?>
    });
</script>

</body>
</html>