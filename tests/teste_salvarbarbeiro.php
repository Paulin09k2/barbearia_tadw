<?php
require_once "conexao.php";      
require_once "funcoes.php";   

$nome = "iagoio";
$email = "kaio@dfkakdail.com";
$telefone = "87999900000";
$cpf = "321.456.235-11";
$data_nascimento = "2000-08-15";
$data_admissao = "2022-01-10";
$senha = "123456";

salvarBarbeiro($conexao, $nome, $email, $telefone, $cpf, $data_nascimento, $data_admissao, $senha);
?>