<?php
require_once "conexao.php";
require_once "funcoes.php";

$nome = "Kaio3";
$email = "kaio2@gmail.com";
$telefone = "645168651"; 
$cpf = "11122293344";
$data_nascimento = "2000-01-01";
$data_admissao = "2000-01-02";
$senha = "123459";

// Passe a senha como último parâmetro
$resultado = salvarBarbeiro($conexao, $nome, $email, $telefone, $cpf, $data_nascimento, $data_admissao, $senha);

if ($resultado) {
    echo "Barbeiro salvo com sucesso!";
} else {
    echo "Erro ao salvar barbeiro.";
}
?>