<?php
session_start();
// Importa o arquivo de conexão com o banco de dados
require_once './conexao.php';

// Importa o arquivo com as funções auxiliares usadas no sistema
require_once './funcoes.php';

// Aceita id por POST (formulário admin) ou GET (link na área do cliente)
$idavaliacao = $_POST['idavaliacao'] ?? $_GET['id'] ?? null;

// Define destino padrão (admin)
$redirect = './admin/avaliacao.php';

// Se o usuário estiver logado e for cliente, redireciona para painel do cliente
$idusuario = $_SESSION['idusuario'] ?? null;
if ($idusuario) {
    $tipo = tipoUsuario($conexao, $idusuario);
    if (!empty($tipo) && isset($tipo['tipo_usuario']) && (int)$tipo['tipo_usuario'] === 1) {
        $redirect = './cliente/index.php';
    }
}

if (!$idavaliacao) {
    echo "<script>alert('ID inválido.'); window.location.href='{$redirect}';</script>";
    exit;
}

// Verifica permissão: se for cliente, só pode excluir suas próprias avaliações
if ($idusuario) {
    $tipo = tipoUsuario($conexao, $idusuario);
    // Busca id_cliente do usuário, se for cliente
    $cliente = pesquisarClienteId($conexao, $idusuario);
    $id_cliente_logado = $cliente['id_cliente'] ?? null;

    // Busca dono da avaliação
    $sql = "SELECT cliente_id_cliente FROM avaliacao WHERE idavaliacao = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $idavaliacao);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $linha = mysqli_fetch_assoc($res);
        mysqli_stmt_close($stmt);
        $avaliacao_dono = $linha['cliente_id_cliente'] ?? null;
    } else {
        $avaliacao_dono = null;
    }

    // Se for cliente e não for dono, negar
    if (!empty($tipo) && isset($tipo['tipo_usuario']) && (int)$tipo['tipo_usuario'] === 1) {
        if ($avaliacao_dono === null || $id_cliente_logado === null || (int)$avaliacao_dono !== (int)$id_cliente_logado) {
            echo "<script>alert('Permissão negada. Você só pode excluir suas próprias avaliações.'); window.location.href='{$redirect}';</script>";
            exit;
        }
    }
}

// Executa exclusão
$resultado = excluirAvaliacao($conexao, $idavaliacao);

// Redireciona conforme resultado
if (is_array($resultado) && isset($resultado['mensagem'])) {
    $mensagem = addslashes($resultado['mensagem']);
} else {
    $mensagem = 'Operação concluída.';
}

echo "<script>alert('{$mensagem}'); window.location.href='{$redirect}';</script>";
exit;
