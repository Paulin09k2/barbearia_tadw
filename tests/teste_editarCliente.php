<?php
require_once "conexao.php";
require_once "funcoes.php";


$nome = "Kaio Atualizado";
$email = "kaio_atualizado@email.com";
$telefone = "87988887777";
$endereco = "Rua Nova, Bairro Central";
$data_nascimento = "2000-08-15";
$senha_cliente = "12345kjh";
$id_cliente = 1; 

editarCliente($conexao, $nome, $email, $telefone, $endereco, $data_nascimento, $senha_cliente, $id_cliente);
?>
