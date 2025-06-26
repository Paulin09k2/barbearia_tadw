<?php
    require_once "../conexao.php";
    require_once "../funcoes.php";

    $nome_servico = "corte";
    $descricao = "maquina e tesoura";
    $preco = "30reais";
    $tempo_estimado = "30minutos";

    salvarServico($conexao,$nome_servico, $descricao, $preco, $tempo_estimado);
?>