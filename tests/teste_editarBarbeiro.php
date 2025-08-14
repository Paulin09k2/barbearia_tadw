<?php
require_once "./conexao.php";
require_once "./funcoes.php";

$nome = "Kaio";
$email = "kaio@gmail.com";
$telefone = "645165651";
$cpf = "11122233394";
$data_nascimento = "2000-01-01";
$data_admissao = "2000-01-02";
$id_barbeiro = 6;

$resultado = editarBarbeiro($conexao, $nome, $email, $telefone, $cpf, $data_nascimento, $data_admissao, $id_barbeiro);

echo $resultado ? "Barbeiro editado com sucesso!" : "Erro ao editar barbeiro.";
?>
