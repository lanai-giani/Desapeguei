<?php
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

header('Content-Type: text/html; charset=utf-8');

$categoria = $_GET['categoria'] ?? '';

if (isset($subcategorias[$categoria])) {
    foreach ($subcategorias[$categoria] as $sub) {
        $value = strtolower(str_replace(' ', '_', $sub));
        echo "<option value=\"$value\">$sub</option>";
    }
}
