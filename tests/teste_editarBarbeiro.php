<?php
require_once "conexao.php";
require_once "funcoes.php";

$nome = "Kaio";
$email = "kaiio@gmail.com";
$telefone = "629932932028";
$cpf = "11122233345";
$data_nascimento = "2000-01-01";
$data_admissao = "2000-01-02";
$id_barbeiro = 6;

$resultado = editarBarbeiro($conexao, $nome, $email, $telefone, $cpf, $data_nascimento, $id_barbeiro);

echo $resultado ? "Barbeiro editado com sucesso!" : "Erro ao editar barbeiro.";
?>
