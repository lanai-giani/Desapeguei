<?php
session_start();
require_once 'conexao.php';

// Verifica se há carrinho
$carrinho = $_SESSION['carrinho'] ?? [];

$anuncios = [];
$total = 0;

if (!empty($carrinho)) {
    // Prepara os placeholders (?, ?, ?) dinamicamente
    $placeholders = implode(',', array_fill(0, count($carrinho), '?'));

    $stmt = $pdo->prepare("SELECT * FROM anuncios WHERE id IN ($placeholders)");
    $stmt->execute($carrinho);
    $anuncios = $stmt->fetchAll();
    
    // Calcula o total
    foreach ($anuncios as $item) {
        $total += $item['preco'];
    }
}

// Processa remoção de item
if (isset($_POST['remover'])) {
    $id_remover = $_POST['id_remover'];
    if (($key = array_search($id_remover, $carrinho)) !== false) {
        unset($carrinho[$key]);
        $_SESSION['carrinho'] = array_values($carrinho); // Reindexa o array
        header("Location: carrinho.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meu Carrinho | Desapeguei</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="vender_style">
        <div class="navbar">
        <div class="logo">
            <a href="../index.php"><img src="../assets/img/logoTeste.png" alt="desapeguei" width="180"></a>
        </div>
        <form class="barra-pesquisa" action="buscar.php" method="GET">
            <input type="search" name="q" placeholder="O que você procura?">
        </form>
                <nav>
                    <ul id="menuItens">
                        <li><a href="../index.php">Início</a></li>
                        <li><a href="../vender.php">Vender</a></li>
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

        <a href="../php/carrinho.php" id="btnCarrinho">
            <img src="../assets/img/carrinho (2).png" alt="Carrinho" width="30px" height="30px">
        </a>

        <img src="../assets/img/menu.png" alt="" class="menuCelular" onclick="menuCelular()">
    </div>


    <div class="container carrinho-container">
        <h1 class="titulo-carrinho">Meu Carrinho</h1>

        <?php if (empty($anuncios)): ?>
            <p class="carrinho-vazio">Seu carrinho está vazio.</p>
            <a href="../index.php" class="btn">Continuar comprando</a>
        <?php else: ?>
            <form action="carrinho.php" method="post">
                <div class="check-all">
                    <input type="checkbox" id="selecionar-todos" class="check-item">
                    <label for="selecionar-todos">Selecionar todos os itens</label>
                </div>

                <div class="lista-carrinho">
                    <?php foreach ($anuncios as $item): ?>
                        <div class="produto-carrinho">
                            <div class="produto-check">
                                <input type="checkbox" name="itens_selecionados[]" value="<?= $item['id'] ?>" class="check-item" checked>
                            </div>
                            <?php
                                $imagem = explode(',', $item['imagens'])[0] ?? 'placeholder.png';
                            ?>
                            <img src="../uploads/<?= htmlspecialchars($imagem) ?>" alt="<?= htmlspecialchars($item['titulo']) ?>">
                            <h4><?= htmlspecialchars($item['titulo']) ?></h4>
                            <p class="preco-produto">R$ <?= number_format($item['preco'], 2, ',', '.') ?></p>
                            <p class="descricao-produto"><?= htmlspecialchars($item['descricao']) ?></p>
                            
                            <form method="post" class="form-remover">
                                <input type="hidden" name="id_remover" value="<?= $item['id'] ?>">
                                <button type="submit" name="remover" class="btn-remover">Remover</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="resumo-carrinho">
                    <div class="total-carrinho">
                        <span>Total:</span>
                        <span class="valor-total">R$ <?= number_format($total, 2, ',', '.') ?></span>
                    </div>
                    
                    <div class="acoes-carrinho">
                        <a href="../index.php" class="btn btn-continuar">Continuar comprando</a>
                        <button type="submit" class="btn-finalizar">Finalizar compra</button>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>

    <script>
        // Selecionar/deselecionar todos os itens
        document.getElementById('selecionar-todos').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.check-item:not(#selecionar-todos)');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            calcularTotal();
        });

        // Calcular total quando itens são selecionados/deselecionados
        document.querySelectorAll('.check-item:not(#selecionar-todos)').forEach(checkbox => {
            checkbox.addEventListener('change', calcularTotal);
        });

        function calcularTotal() {
            let total = 0;
            document.querySelectorAll('.check-item:not(#selecionar-todos)').forEach(checkbox => {
                if (checkbox.checked) {
                    const precoText = checkbox.closest('.produto-carrinho').querySelector('.preco-produto').textContent;
                    const preco = parseFloat(precoText.replace('R$ ', '').replace('.', '').replace(',', '.'));
                    total += preco;
                }
            });
            
            document.querySelector('.valor-total').textContent = 'R$ ' + total.toLocaleString('pt-BR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }
    </script>
</body>
</html>