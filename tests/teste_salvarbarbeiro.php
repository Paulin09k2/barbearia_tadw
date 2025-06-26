<?php
    require_once "conexao.php";
    require_once "../funcoes.php";

    $nome = "Kaio";
    $email = "p@gmail.com";
    $telefone = "45545"; // Exemplo de telefone correto
    $cpf = "321.456.235-11";
    $data_nascimento = "2000-01-01";
    $data_admissao = "2000-01-02";

    $resultado = salvarBarbeiro($conexao, $nome, $email, $telefone, $cpf, $data_nascimento, $data_admissao);

    if ($resultado) {
        echo "Barbeiro salvo com sucesso!";
    } else {
        echo "Erro ao salvar barbeiro.";
    }
?>