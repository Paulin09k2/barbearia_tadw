<?php
require_once './conexao.php';
require_once './funcoes.php';

$idavaliacao = $_POST['idavaliacao'] ?? null;

if ($idavaliacao) {
    $resultado = excluirAvaliacao($conexao, $idavaliacao);
    echo "<script>alert('{$resultado['mensagem']}'); window.location.href='./admin/avaliacao.php';</script>";
} else {
    echo "<script>alert('ID inválido.'); window.location.href='./admin/avaliacao.php';</script>";
}
?>
