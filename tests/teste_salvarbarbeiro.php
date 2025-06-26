<?php
require_once "conexao.php";      
require_once "funcoes.php";   

<<<<<<< HEAD
$nome = "paulo";
$email = "gcfdw@gmail.com";
$telefone = "45545"; 
$cpf = "32145623511";
$data_nascimento = "2000-01-01";
$data_admissao = "2000-01-02";
=======
$nome = "iagoio";
$email = "kaio@dfkakdail.com";
$telefone = "87999900000";
$cpf = "321.456.235-11";
$data_nascimento = "2000-08-15";
$data_admissao = "2022-01-10";
>>>>>>> 65d4d3f12220b8438005b5daf57450df89f33ce6
$senha = "123456";

salvarBarbeiro($conexao, $nome, $email, $telefone, $cpf, $data_nascimento, $data_admissao, $senha);
?>