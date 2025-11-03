<?php
require_once "conexao.php";
require_once "funcoes.php";
session_start();



$avaliacoes = $_POST['avaliacao'];
$comentario = $_POST['comentario'];
$idusuario = $_POST['idusuario'];

$nome_arquivo = $_FILES['foto']['name'];
$caminho_temporario = $_FILES['foto']['tmp_name'];

//pegar a extensão do arquivo
$extensao = pathinfo($nome_arquivo, PATHINFO_EXTENSION);

//gerar um novo nome
$novo_nome = uniqid() . "." . $extensao;

// lembre-se de criar a pasta e de ajustar as permissões.
$caminho_destino = "../img/avaliacao/" . $novo_nome;

// move a foto para o servidor
move_uploaded_file($caminho_temporario, $caminho_destino);

salvarAvaliacao($conexao, $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico, $foto);

header("Location: ./cliente/index.php");
exit;