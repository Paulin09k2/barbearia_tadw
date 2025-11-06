<?php
// Importa os arquivos necessários: conexão com o banco e funções auxiliares
require_once "./conexao.php";
require_once "./funcoes.php";

// Inicia a sessão (necessário para acessar dados do usuário logado)
session_start();

// Recupera o ID do usuário logado a partir da sessão
$idusuario = $_SESSION['idusuario'];

// Busca todas as informações completas do cliente vinculado ao usuário logado
$usuario = listarCompletoCliente($conexao, $idusuario);

// Extrai o ID do cliente do resultado retornado pelo banco
$id_cliente = $usuario[0]['id_cliente'];

// --- VERIFICA O TIPO DE USUÁRIO (1 = cliente comum, 2 = barbeiro/admin) ---
$tipo = tipoUsuario($conexao, idusuario: $idusuario);

// --- PEGA O ID DO AGENDAMENTO (CASO ESTEJA EDITANDO UM) ---
// Se não existir o parâmetro "id_agendamento" na URL, assume valor 0 (novo agendamento)
$id = $_GET['id_agendamento'] ?? 0;
$botao = "Cadastrar"; // Texto padrão do botão

// --- VALORES PADRÃO PARA O FORMULÁRIO ---
$id_agendamento = 0;
$data_agendamento = "";
$status = "pendente";
$cliente_id = $id_cliente;  // Por padrão, o agendamento pertence ao cliente logado
$barbeiro_id = "";
$servico_id = $_GET['id_servico'] ?? ""; // Pode vir pré-selecionado via GET

// --- SE FOR UMA EDIÇÃO DE AGENDAMENTO EXISTENTE ---
if ($id > 0) {
    // Busca o agendamento no banco de dados
    $sql = "SELECT id_agendamento, data_agendamento, status, cliente_id_cliente, barbeiro_id_barbeiro 
            FROM agendamento WHERE id_agendamento = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $agendamento = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);

    // Se o agendamento for encontrado, preenche os campos do formulário com os dados
    if ($agendamento) {
        $id_agendamento = $agendamento['id_agendamento'];
        // Converte a data para o formato compatível com o campo datetime-local (YYYY-MM-DDTHH:MM)
        $data_agendamento = date('Y-m-d\TH:i', strtotime($agendamento['data_agendamento']));
        $status = $agendamento['status'];
        $cliente_id = $agendamento['cliente_id_cliente'];
        $barbeiro_id = $agendamento['barbeiro_id_barbeiro'];
        $botao = "Editar"; // Muda o texto do botão
    }
}

// --- LISTA DE DADOS PARA POPULAR OS CAMPOS DO FORMULÁRIO ---
$barbeiros = listarBarbeiro($conexao);               // Lista de barbeiros disponíveis
$servicos = listarServicosDisponiveis($conexao);     // Lista de serviços disponíveis
$clientes = listarCliente($conexao);                 // Lista de clientes (usado apenas por admins)

// --- EXIBE MENSAGEM (caso exista) E LIMPA A VARIÁVEL DE SESSÃO ---
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
    // Mostra o link de "Voltar" adequado de acordo com o tipo de usuário
    if ((int)$tipo['tipo_usuario'] === 1) {
        echo '<a href="./cliente/index.php">Voltar ao Painel do Cliente</a>';
    } else {
        echo '<a href="./admin/index.php">Voltar ao Painel do Admin</a>';
    }
    ?>
    <hr>

    <!-- Formulário de agendamento -->
    <form action="./salvarAgendamento.php" method="POST">
    <?php
    // Campos ocultos com dados importantes (id, cliente, tipo de usuário)
    echo '
        <input type="hidden" name="id_agendamento" value="' . htmlspecialchars($id_agendamento ?? '') . '">
        <input type="hidden" name="id_cliente" value="' . htmlspecialchars($id_cliente ?? '') . '">
        <input type="hidden" name="tipo_usuario" value="' . htmlspecialchars($tipo['tipo_usuario'] ?? '') . '">
    ';

    // Se for barbeiro/admin, exibe o campo para escolher o cliente
    if ((int)$tipo['tipo_usuario'] === 2) {
        echo '
            <label for="id_cliente">Cliente:</label><br>
            <select name="id_cliente" id="id_cliente" required>
                <option value="">Selecione...</option>';
        foreach ($clientes as $c) {
            // Marca o cliente já vinculado (em modo edição)
            $selected = ($c['id_cliente'] == ($cliente_id ?? '')) ? "selected" : "";
            echo '<option value="' . $c['id_cliente'] . '" ' . $selected . '>' . htmlspecialchars($c['nome']) . '</option>';
        }
        echo '
            </select><br><br>';
    }

    // Campo de data e hora do agendamento
    echo '
        <label for="data_agendamento">Data e Hora:</label><br>
        <input type="datetime-local"
            id="data_agendamento"
            name="data_agendamento"
            value="' . htmlspecialchars($data_agendamento ?? '') . '"
            required
            min="' . date('Y-m-d\TH:i') . '"><br><br>

        <!-- Seleciona o barbeiro -->
        <label for="barbeiro_id">Barbeiro:</label><br>
        <select name="barbeiro_id" id="barbeiro_id" required>
            <option value="">Selecione...</option>';
    foreach ($barbeiros as $b) {
        $selected = ($b['id_barbeiro'] == ($barbeiro_id ?? '')) ? "selected" : "";
        echo '<option value="' . $b['id_barbeiro'] . '" ' . $selected . '>' . htmlspecialchars($b['nome']) . '</option>';
    }
    echo '
        </select><br><br>

        <!-- Seleciona o serviço desejado -->
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
        
    // Se for barbeiro/admin, exibe também o campo de status
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

    // Botão de envio do formulário
    echo '
        <button type="submit">' . htmlspecialchars($botao) . '</button>
    ';
    ?>
    </form>

</body>
</html>
