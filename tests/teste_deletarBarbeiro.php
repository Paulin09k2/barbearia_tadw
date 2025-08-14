<?php
require_once "../conexao.php";
require_once "../funcoes.php";

$id_barbeiro = 5;

if (!$conexao) {
    die("Erro na conexão com o banco de dados.");
}

if (isset($id_barbeiro) && is_numeric($id_barbeiro)) {
    $resultado = deletarBarbeiro($conexao, $id_barbeiro);
    echo $resultado ? "Barbeiro deletado com sucesso!" : "Erro ao deletar barbeiro.";
} else {
    echo "ID do barbeiro inválido.";
}
?>