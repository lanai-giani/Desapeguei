<?php
header('Content-Type: text/plain; charset=utf-8');

// Pegando a categoria vinda por GET corretamente
$categoria = $_GET['categoria'] ?? '';

$subcategorias = [
    'vestuario' => ['Camiseta', 'Vestido', 'Jaqueta', 'Calça'],
    'calcados' => ['Rasteirinha', 'Chinelo', 'Tênis', 'Bota'],
    'eletronicos' => ['Celular', 'Notebook', 'Tablet', 'Fones de ouvido'],
    'bolsas' => ['Bolsa de mão', 'Mochila', 'Pochete'],
    'livros' => ['Romance', 'Terror', 'Autoajuda', 'Didático'],
    'beleza' => ['Maquiagem', 'Skincare', 'Cabelo'],
    'acessorios' => ['Relógio', 'Óculos', 'Bijuteria'],
    'kids' => ['Roupas infantis', 'Brinquedos', 'Carrinhos']
];

if (isset($subcategorias[$categoria])) {
    foreach ($subcategorias[$categoria] as $sub) {
        $value = strtolower(str_replace(' ', '_', $sub));
        echo "<option value=\"$value\">$sub</option>\n";
    }
}else{
echo "";

}
?>