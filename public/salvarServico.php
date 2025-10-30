<?php
require_once './conexao.php';
require_once './funcoes.php';

$id_servico = $_POST['id_servico'] ?? null;
$nome_servico = trim($_POST['nome_servico']);
$descricao = trim($_POST['descricao']);
$preco = floatval($_POST['preco']);
$tempo_estimado = intval($_POST['tempo_estimado']);

if ($id_servico) {
    // Atualizar
    $resposta = editarServico($conexao, $id_servico, $nome_servico, $descricao, $preco, $tempo_estimado);

} else {
    $resposta = salvarServico($conexao, $nome_servico, $descricao, $preco, $tempo_estimado);


}

echo "<script>alert('{$mensagem}'); window.location.href='./admin/servico.php';</script>";
?>
