<?php
    require_once "../conexao.php";
    require_once "../funcoes.php";

    $nome = "Fulano";
    $cpf = "321.456.234-11";
    $telefone = "(11) 91234-5678";
    $email = ""
    $data_nascimento = "1990-01-01";
    $data_cadastro = "2023-10-01";
    $senha_cliente = "senha123";
    $endereco = "Rua 1";

    salvarCliente($conexao, $nome, $cpf, $endereco, $telefone, $email, $data_nascimento, $data_cadastro, $senha_cliente);
?>