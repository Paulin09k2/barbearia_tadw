<?php
require_once "conexao.php";      
require_once "../funcoes.php";   


$nome = "Kaio";
$email = "kaio@email.com";
$telefone = "87999998888";
$endereco = "Rua 1, Bairro Central";
$data_nascimento = "2000-08-15";
$data_cadastro = "8900-06-17";


salvarCliente($conexao, $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro);
?>
