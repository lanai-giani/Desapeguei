<?php
session_start();
echo '<pre>';
print_r($_SESSION['usuario']);
echo '</pre>';

// 1. Verificar se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../cadastro.html");
    exit;
}

require 'conexao.php';

$titulo = $_POST['titulo'] ?? '';
$descricao = $_POST['descricao'] ?? '';
$estado = $_POST['estado'] ?? '';
$categoria = $_POST['categoria'] ?? '';
$subcategoria = $_POST['subcategoria'] ?? '';
$preco = $_POST['preco'] ?? '';
$usuario_id = $_SESSION['usuario']['id'] ?? null; 

function normalizarSubcategoria($str) {
    $str = strtolower($str);
    $str = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
    $str = preg_replace('/[^a-z0-9\s]/', '', $str);
    $str = str_replace(' ', '_', $str);
    return $str;
}

// Normaliza o valor da subcategoria
$subcategoria = normalizarSubcategoria($subcategoria);

if (!$titulo || !$descricao || !$estado || !$categoria || !$subcategoria || $preco === '' || !$usuario_id) {
    die("Preencha todos os campos.");
}

$imagens = [];
if (!empty($_FILES['fotos']['name'][0])) {
    $diretorio = '../uploads/';
    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0777, true);
    }

    foreach ($_FILES['fotos']['tmp_name'] as $key => $tmp_name) {
        $nomeOriginal = $_FILES['fotos']['name'][$key];
        $nomeFinal = uniqid() . '_' . basename($nomeOriginal);
        $destino = $diretorio . $nomeFinal;

        if (move_uploaded_file($tmp_name, $destino)) {
            $imagens[] = $nomeFinal;
        }
    }
}

try {
    $stmt = $pdo->prepare("INSERT INTO anuncios (usuario_id, titulo, descricao, estado, categoria, subcategoria, preco, imagens, data_criacao)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");

    $stmt->execute([
        $usuario_id,
        $titulo,
        $descricao,
        $estado,
        $categoria,
        $subcategoria,
        $preco,
        implode(',', $imagens)
    ]);

    header("Location: ../categorias/{$categoria}.php");
    exit;

} catch (PDOException $e) {
    echo "Erro ao salvar anúncio: " . $e->getMessage();
}
?>
