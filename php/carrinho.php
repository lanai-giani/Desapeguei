<?php
session_start();
require_once 'conexao.php';

// Verifica se há carrinho
$carrinho = $_SESSION['carrinho'] ?? [];

$anuncios = [];

if (!empty($carrinho)) {
    // Prepara os placeholders (?, ?, ?) dinamicamente
    $placeholders = implode(',', array_fill(0, count($carrinho), '?'));

    $stmt = $pdo->prepare("SELECT * FROM anuncios WHERE id IN ($placeholders)");
    $stmt->execute($carrinho);
    $anuncios = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meu Carrinho | Desapeguei</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Meu Carrinho</h1>

        <?php if (empty($anuncios)): ?>
            <p>Seu carrinho está vazio.</p>
        <?php else: ?>
            <div class="linha produtos-container">
                <?php foreach ($anuncios as $item): ?>
                    <div class="col-4 produto">
                        <?php
                            $imagem = explode(',', $item['imagens'])[0] ?? 'placeholder.png';
                        ?>
                        <img src="../uploads/<?= htmlspecialchars($imagem) ?>" alt="<?= htmlspecialchars($item['titulo']) ?>">
                        <h4><?= htmlspecialchars($item['titulo']) ?></h4>
                        <p>R$ <?= number_format($item['preco'], 2, ',', '.') ?></p>
                        <p><?= htmlspecialchars($item['descricao']) ?></p>
                        <!-- Aqui você pode colocar botão de remover se quiser -->
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <a href="../index.php" class="btn">Continuar comprando</a>
    </div>
</body>
</html>
