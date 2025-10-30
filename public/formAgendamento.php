<?php
require_once "./conexao.php";
require_once "./funcoes.php";
session_start();


$idusuario = $_SESSION['idusuario'];

$usuario = listarCompletoCliente($conexao, $idusuario);

$id_cliente = $usuario[0]['id_cliente'];

// --- VERIFICA O TIPO DE USUÁRIO (1 = cliente, 2 = barbeiro/admin) ---
$tipo = tipoUsuario($conexao, idusuario: $idusuario);

// var_dump( $tipo);
// --- PEGA ID DO AGENDAMENTO (EDIÇÃO) ---
$id = $_GET['id_agendamento'] ?? 0;
$botao = "Cadastrar";

// --- DADOS PADRÃO ---
$id_agendamento = 0;
$data_agendamento = "";
$status = "pendente";
$cliente_id = $id_cliente;
$barbeiro_id = "";
$servico_id = $_GET['id_servico'] ?? "";

// --- SE FOR EDIÇÃO ---
if ($id > 0) {
    $sql = "SELECT id_agendamento, data_agendamento, status, cliente_id_cliente, barbeiro_id_barbeiro 
            FROM agendamento WHERE id_agendamento = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $agendamento = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);

    if ($agendamento) {
        $id_agendamento = $agendamento['id_agendamento'];
        $data_agendamento = date('Y-m-d\TH:i', strtotime($agendamento['data_agendamento']));
        $status = $agendamento['status'];
        $cliente_id = $agendamento['cliente_id_cliente'];
        $barbeiro_id = $agendamento['barbeiro_id_barbeiro'];
        $botao = "Editar";
    }
}

$barbeiros = listarBarbeiro($conexao);
$servicos = listarServicosDisponiveis($conexao);
$clientes = listarCliente($conexao);

if (isset($_SESSION['mensagem'])) {
    echo "<script>alert('{$_SESSION['mensagem']}');</script>";
    unset($_SESSION['mensagem']);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title><?php echo $botao; ?> Agendamento</title>
</head>

<body>

    <h1><?php echo htmlspecialchars($botao); ?> Agendamento</h1>
    <?php
    if ((int)$tipo['tipo_usuario'] === 1){
        echo '<a href="./cliente/index.php">Voltar ao Painel do Cliente</a>';
    }else{
        echo '<a href="./admin/index.php">Voltar ao Painel do Admin</a>';
    }
    
    ?>
    <hr>

    <form action="./salvarAgendamento.php" method="POST">
    <?php
    echo '
        <input type="hidden" name="id_agendamento" value="' . htmlspecialchars($id_agendamento ?? '') . '">
        <input type="hidden" name="id_cliente" value="' . htmlspecialchars($id_cliente ?? '') . '">
        <input type="hidden" name="tipo_usuario" value="' . htmlspecialchars($tipo['tipo_usuario'] ?? '') . '">
    ';

    if ((int)$tipo['tipo_usuario'] === 2) {
        echo '
            <label for="id_cliente">Cliente:</label><br>
            <select name="id_cliente" id="id_cliente" required>
                <option value="">Selecione...</option>';
        foreach ($clientes as $c) {
            $selected = ($c['id_cliente'] == ($cliente_id ?? '')) ? "selected" : "";
            echo '<option value="' . $c['id_cliente'] . '" ' . $selected . '>' . htmlspecialchars($c['nome']) . '</option>';
        }
        echo '
            </select><br><br>';
    }

    echo '
        <label for="data_agendamento">Data e Hora:</label><br>
        <input type="datetime-local"
            id="data_agendamento"
            name="data_agendamento"
            value="' . htmlspecialchars($data_agendamento ?? '') . '"
            required
            min="' . date('Y-m-d\TH:i') . '"><br><br>

        <label for="barbeiro_id">Barbeiro:</label><br>
        <select name="barbeiro_id" id="barbeiro_id" required>
            <option value="">Selecione...</option>';
    foreach ($barbeiros as $b) {
        $selected = ($b['id_barbeiro'] == ($barbeiro_id ?? '')) ? "selected" : "";
        echo '<option value="' . $b['id_barbeiro'] . '" ' . $selected . '>' . htmlspecialchars($b['nome']) . '</option>';
    }
    echo '
        </select><br><br>

        <label for="servico_id">Serviço:</label><br>
        <select name="servico_id" id="servico_id" required>
            <option value="">Selecione...</option>';
    foreach ($servicos as $s) {
        $selected = ($s['id_servico'] == ($servico_id ?? '')) ? "selected" : "";
        echo '<option value="' . $s['id_servico'] . '" ' . $selected . '>'
            . htmlspecialchars($s['nome_servico']) . ' - R$' . number_format($s['preco'], 2, ',', '.') . '</option>';
    }
    echo '
        </select><br><br>';
        
    if ((int)$tipo['tipo_usuario'] === 2) {
        echo '
            <label for="status">Status:</label><br>
            <select name="status" id="status" required>';
        $status_options = ['pendente', 'confirmado', 'cancelado'];
        foreach ($status_options as $opcao) {
            $selected = (($status ?? '') === $opcao) ? "selected" : "";
            echo '<option value="' . $opcao . '" ' . $selected . '>' . ucfirst($opcao) . '</option>';
        }
        echo '
            </select><br><br>';
    }

    echo '
        <button type="submit">' . htmlspecialchars($botao) . '</button>
    ';
    ?>
    </form>


</body>


</html>