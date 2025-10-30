<?php

require_once './conexao.php';
require_once './funcoes.php';
session_start();

$id = $_POST['id'] ?? null;
$idusuario = $_POST['idusuario'] ?? null;
$nome = trim($_POST['nome']);
$email = trim($_POST['email']);
$telefone = trim($_POST['telefone']);
$data_nascimento = $_POST['data_nascimento'];
$data_admissao = $_POST['data'];
$senha = trim($_POST['senha']);
$cpf = trim($_POST['cpf']);
$id_barbeiro = $id;

// var_dump(value: $data_admissao);

if ($id && $idusuario) {
  // Editar barbeiro existente
  $resposta = editarBarbeiro($conexao, $nome, $telefone, $cpf, $data_nascimento, $data_admissao, $idusuario, $id_barbeiro);
} else {
  //     // Cadastrar novo barbeiro
  $resposta = salvarBarbeiro(
    $conexao,
    $nome,
    $telefone,
    $cpf,
    $data_nascimento,
    $data_admissao,
    $idusuario
  );
}
header("Location: ./admin/index.php");
