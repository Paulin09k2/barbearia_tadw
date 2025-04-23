<?php
    require_once "../conexao.php";
    require_once "../funcoes.php";

    $nome = "Kaio";
    $email = "";
    $telefone = "Rua 1";
    $cpf = "321.456.235-11";
    $data_nascimento = "2000-01-01";
    $data_admissao = "2000-01-01";

    salvarbarbeiro($conexao, $nome, $email, $telefone, $cpf, $data_nascimento, $data_admissao);

?>