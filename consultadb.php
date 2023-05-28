<?php
include 'conexao.php';
$consulta = $cn->query('select * from tbl_autor');
$exibe = $consulta->fetch(PDO::FETCH_ASSOC);

// Obtém o nome do produto do banco de dados
$nomeProduto = $exibe['nm_autor'];

// Carrega o conteúdo da página index.php
$html = file_get_contents('index.php');

// Localiza o trecho de código JSON dentro do HTML
$inicioJson = strpos($html, '<script id="__NEXT_DATA__"');
$fimJson = strpos($html, '</script>', $inicioJson);
$jsonString = substr($html, $inicioJson, $fimJson - $inicioJson);

// Decodifica o JSON em um array associativo no PHP
$data = json_decode($jsonString, true);

// Atualiza o campo "title" no array associativo com o nome do produto
$data['props']['pageProps']['product']['title'] = $nomeProduto;

// Converte o array associativo de volta para JSON
$jsonAtualizado = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

// Substitui o trecho de código JSON atualizado no HTML
$html = substr_replace($html, $jsonAtualizado, $inicioJson, $fimJson - $inicioJson);

// Exibe o HTML atualizado
echo $html;

echo 'NOME: ' . $exibe['nm_autor'].'<br>' ;
echo 'ID: ' . $exibe['cd_autor'];
?>
