<?php
require_once "conexao.php";
require_once "funcoes.php";


$id_servico = 1; 
$nome_servico = "Corte de Cabelo";  
$descricao_servico = "Corte de cabelo masculino com máquina e tesoura";
$preco = "50.00";
$tempo_estimado = 30;

editarServico($conexao, $nome_servico, $descricao_servico, $preco, $tempo_estimado, $id_servico)


?>