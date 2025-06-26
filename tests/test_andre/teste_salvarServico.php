<?php
    require_once "../conexao.php";
    require_once "../funcoes.php";

    $nome_servico = "corte";
    $descricao = "maquina e tesoura";
    $preco = "30.00";
    $tempo_estimado = "30";

    salvarServico($conexao,$nome_servico, $descricao, $preco, $tempo_estimado);
?>