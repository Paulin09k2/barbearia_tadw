<?php
    require_once "conexao.php";
    require_once "../funcoes.php";

    $nome = "Kaio";
    $cpf = "321.456.235-11";
    $endereco = "Rua 1";

    salvarCliente($conexao, $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro);

?>