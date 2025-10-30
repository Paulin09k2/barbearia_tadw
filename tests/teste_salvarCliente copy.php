<?php
require_once "../public/conexao.php";
require_once "../public/funcoes.php";

$nome = "ulo";
$endereco = "Rua 1";
$email = "ipo@gmail.com";
$telefone = "1234567890";
$data_nascimento = "1990-01-01";
$data_cadastro = "1999-06-01";
$senha_cliente = "senha123";


// Ajuste a assinatura abaixo conforme a função salvarCliente definida em funcoes.php
if (!function_exists('salvarCliente')) {
    die('Função salvarCliente não encontrada em funcoes.php');
}
$idusuario = salvarUsuario($conexao, $email, $senha_cliente, '1');
$result = salvarCliente(
    $conexao,
    $nome,
    $telefone,
    $endereco,
    $data_nascimento,
    $data_cadastro,
    $idusuario
);

var_dump($result);
