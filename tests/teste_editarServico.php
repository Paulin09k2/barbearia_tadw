<?php
require_once "../conexao.php";
require_once "../funcoes.php";

$id_servico = 1; 
$nome_servico = "Corte de Cabelo";  
$decriçao_servico = "Corte de cabelo masculino com máquina e tesoura";
$preco = "50.00";


editarServico($conexao, $nome_servico, $id_servico , $decriçao_servico, $preco, );

?>