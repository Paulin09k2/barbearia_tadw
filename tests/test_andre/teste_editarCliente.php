<?php
require_once "../conexao.php";
require_once "../funcoes.php";

$nome ="Fulano";
$email = "fulano@gmail.com";
$telefone = "123456789";
$endeeco = "ifGoiano";
$data_nascimento = "15/2/97";
$data_cadastro = "20/05/25";
$senha_cliente = "1234";

editarCliente($conexao,$nome, $email,$telefone, $endeeco,$data_nascimento, $data_cadastro, $senha_cliente);
?>