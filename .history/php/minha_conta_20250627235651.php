<?php
session_start();
require_once __DIR__ . '/../php/conexao.php';
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}
$apelido = $_SESSION['usuario']['apelido'] ?: $_SESSION['usuario']['nome'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Minha Conta | Desapeguei</title>
    <link rel="stylesheet" href="assets/css/minha_conta.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <header class="top-bar">
        <div class="logo" onclick="window.location.href='index.php'">Desapeguei</div>
        <input type="text" placeholder="O que você procura?">
        <nav>
            <a href="index.php">Início</a>
            <a href="vender.php">Vender</a>
            <a href="minha_conta.php">Minha Conta</a>
        </nav>
        <div class="cart-icon"><i class="fas fa-shopping-cart"></i></div>
    </header>

    <main class="conta-container">
        <div class="perfil">
            <div class="foto"></div>
            <div class="info">
                <span id="apelidoDisplay"><?php echo htmlspecialchars($apelido); ?></span>
                <i class="fas fa-pen edit-icon" onclick="editarNome()"></i>
                <input type="text" id="apelidoInput" style="display:none;" value="<?php echo htmlspecialchars($apelido); ?>">
                <button id="salvarBtn" style="display:none;" onclick="salvarApelido()">Salvar</button>
                <p><?php echo $cidade; ?></p>
            </div>
        </div>

        <div class="abas">
            <button onclick="mostrarAba('loja')">minha loja</button>
            <button onclick="mostrarAba('enderecos')">meus endereços</button>
            <button onclick="mostrarAba('vendidos')">vendidos</button>
        </div>

        <div class="conteudo" id="conteudo">
            <!-- conteúdo será trocado via JS -->
        </div>
    </main>

    <script>
        function editarNome() {
            document.getElementById('apelidoDisplay').style.display = 'none';
            document.querySelector('.edit-icon').style.display = 'none';
            document.getElementById('apelidoInput').style.display = 'inline';
            document.getElementById('salvarBtn').style.display = 'inline';
        }

        function salvarApelido() {
            const novoApelido = document.getElementById('apelidoInput').value;
            document.getElementById('apelidoDisplay').textContent = novoApelido;
            document.getElementById('apelidoDisplay').style.display = 'inline';
            document.querySelector('.edit-icon').style.display = 'inline';
            document.getElementById('apelidoInput').style.display = 'none';
            document.getElementById('salvarBtn').style.display = 'none';

            // Aqui você pode fazer um fetch/ajax para salvar no banco (sem mudar nome real)
        }

        function mostrarAba(aba) {
            const conteudo = document.getElementById('conteudo');
            if (aba === 'loja') {
                conteudo.innerHTML = "<h2>Meus produtos à venda</h2><p>Aqui aparecem os produtos que você cadastrou.</p>";
            } else if (aba === 'enderecos') {
                conteudo.innerHTML = `
                    <h2>Meus Endereços</h2>
                    <form>
                        <input type="text" placeholder="Rua, número, bairro"><br><br>
                        <input type="text" placeholder="Cidade"><br><br>
                        <input type="text" placeholder="Estado"><br><br>
                        <button type="submit">Salvar Endereço</button>
                    </form>`;
            } else if (aba === 'vendidos') {
                conteudo.innerHTML = "<h2>Produtos Vendidos</h2><p>Aqui aparecerão seus produtos vendidos.</p>";
            }
        }

        // Carregar "minha loja" por padrão
        mostrarAba('loja');
    </script>
</body>
</html>