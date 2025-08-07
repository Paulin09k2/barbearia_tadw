<?php
require_once "../conexao.php";
require_once "../funcoes.php";

$nome = "Kaio Atualizado";
$email = "kaio@novoemail.com";
$telefone = "11988887777";
$cpf = "11122233344";
$data_nascimento = "1991-01-01";
$data_admissao = "2025-02-01";
$id_barbeiro = 1;

$resultado = editarBarbeiro($conexao, $nome, $email, $telefone, $cpf, $data_nascimento, $data_admissao, $id_barbeiro);

echo $resultado ? "Barbeiro editado com sucesso!" : "Erro ao editar barbeiro.";
?>
