<?php
// Importa o arquivo de conexão com o banco de dados
require_once './conexao.php';

// Importa o arquivo com as funções auxiliares usadas no sistema
require_once './funcoes.php';

// Recebe o ID da avaliação enviada pelo formulário via método POST
// Se não existir, define como null
$idavaliacao = $_POST['idavaliacao'] ?? null;

// Verifica se o ID foi recebido
if ($idavaliacao) {
    // Chama a função que exclui a avaliação do banco de dados, passando a conexão e o ID
    $resultado = excluirAvaliacao($conexao, $idavaliacao);

    // Exibe uma mensagem informando o resultado da exclusão
    // e redireciona de volta para a página de avaliações do painel admin
    echo "<script>alert('{$resultado['mensagem']}'); window.location.href='./admin/avaliacao.php';</script>";
} else {
    // Caso o ID não tenha sido enviado, exibe uma mensagem de erro
    // e redireciona para a página de avaliações
    echo "<script>alert('ID inválido.'); window.location.href='./admin/avaliacao.php';</script>";
}
?>
