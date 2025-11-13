<?php
// Inicia a sessão para acessar variáveis de sessão
require_once "./conexao.php"; // Inclui o arquivo de conexão com o banco de dados
require_once "./funcoes.php"; // Inclui o arquivo com funções auxiliares
session_start(); // Inicia a sessão

// Obtém o ID do usuário logado (cliente ou barbeiro) da sessão
$idusuario = $_SESSION['idusuario'];

// Busca todas as informações completas do cliente com base no ID do usuário
$usuario = listarCompletoCliente($conexao, $idusuario);

// Pega o ID do cliente da primeira posição do array retornado
$id_cliente = $usuario[0]['id_cliente'];

// --- VERIFICA O TIPO DE USUÁRIO (1 = cliente, 2 = barbeiro/admin) ---
$tipo = tipoUsuario($conexao, idusuario: $idusuario);

// --- PEGA ID DO AGENDAMENTO (CASO SEJA EDIÇÃO) ---
$id = $_GET['id_agendamento'] ?? 0; // Se não houver, define como 0 (novo cadastro)
$botao = "Cadastrar"; // Texto padrão do botão

// --- VALORES PADRÃO PARA O FORMULÁRIO ---
$id_agendamento = 0;
$data_agendamento = "";
$status = "pendente"; // Padrão inicial do status
$cliente_id = $id_cliente;
$barbeiro_id = "";
$servico_id = $_GET['id_servico'] ?? ""; // Caso venha via URL, já preenche

// --- SE FOR EDIÇÃO (id_agendamento > 0), BUSCA DADOS EXISTENTES ---
if ($id > 0) {
    // Consulta SQL para pegar dados do agendamento específico
    $sql = "SELECT id_agendamento, data_agendamento, status, cliente_id_cliente, barbeiro_id_barbeiro 
            FROM agendamento WHERE id_agendamento = ?";
    $stmt = mysqli_prepare($conexao, $sql); // Prepara a consulta
    mysqli_stmt_bind_param($stmt, "i", $id); // Substitui o ? pelo valor do ID
    mysqli_stmt_execute($stmt); // Executa a query
    $resultado = mysqli_stmt_get_result($stmt); // Pega o resultado
    $agendamento = mysqli_fetch_assoc($resultado); // Converte para array associativo
    mysqli_stmt_close($stmt); // Fecha o statement

    // Se encontrou o agendamento, preenche os campos do formulário
    if ($agendamento) {
        $id_agendamento = $agendamento['id_agendamento'];
        // Converte a data/hora para o formato aceito pelo input datetime-local
        $data_agendamento = date('Y-m-d\TH:i', strtotime($agendamento['data_agendamento']));
        $status = $agendamento['status'];
        $cliente_id = $agendamento['cliente_id_cliente'];
        $barbeiro_id = $agendamento['barbeiro_id_barbeiro'];
        $botao = "Editar"; // Troca o texto do botão
    }
}

// --- CARREGA DADOS PARA OS SELECTS ---
$barbeiros = listarBarbeiro($conexao); // Lista todos os barbeiros
$servicos = listarServicosDisponiveis($conexao); // Lista serviços disponíveis
$clientes = listarCliente($conexao); // Lista clientes (para uso do admin)

// --- EXIBE ALERTA DE MENSAGEM (CASO EXISTE NA SESSÃO) ---
if (isset($_SESSION['mensagem'])) {
    echo "<script>alert('{$_SESSION['mensagem']}');</script>";
    unset($_SESSION['mensagem']); // Apaga a mensagem após exibir
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $botao; ?> Agendamento</title>

<style>
  /* --- ESTILO GERAL DA PÁGINA --- */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Inter", system-ui, sans-serif;
  }

  body {
    background-color: #0f1724;
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
  }

  .container {
    background-color: #121a23;
    width: 100%;
    max-width: 420px;
    padding: 40px 32px;
    border-radius: 12px;
    box-shadow: 0 0 25px rgba(0, 0, 0, 0.5);
  }

  h1 {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 25px;
    color: #fff;
  }

  label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 6px;
  }

  select,
  input[type="datetime-local"],
  input[type="text"],
  textarea {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #2b3440;
    border-radius: 6px;
    background-color: #1c2530;
    color: #fff;
    font-size: 14px;
    margin-bottom: 18px;
    transition: 0.2s;
  }

  select:focus,
  input:focus,
  textarea:focus {
    border-color: #ffcd00;
    outline: none;
    background-color: #202b36;
  }

  button[type="submit"] {
    width: 100%;
    background-color: #fff;
    border: none;
    color: #000;
    font-weight: 700;
    padding: 12px 0;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
  }

  button[type="submit"]:hover {
    background-color: #ffff;
  }

  a {
    display: inline-block;
    margin-bottom: 18px;
    color: #fff;
    text-decoration: none;
    font-size: 14px;
  }

  a:hover {
    text-decoration: underline;
  }
</style>
</head>

<body>
    <div class="container">
        <!-- Título dinâmico conforme a ação (Cadastrar/Editar) -->
        <h1><?php echo htmlspecialchars($botao); ?> Agendamento</h1>

        <?php
        // Exibe link de retorno conforme o tipo de usuário
        if ((int)$tipo['tipo_usuario'] === 1) {
            echo '<a href="./cliente/index.php">Voltar ao Painel do Cliente</a>';
        } else {
            echo '<a href="./admin/index.php">Voltar ao Painel do Admin</a>';
        }
        ?>
        <hr>

        <!-- Formulário para criar ou editar o agendamento -->
        <form action="./salvarAgendamento.php" method="POST">
            <?php
            // Campos ocultos com dados importantes
            echo '
        <input type="hidden" name="id_agendamento" value="' . htmlspecialchars($id_agendamento ?? '') . '">
        <input type="hidden" name="id_cliente" value="' . htmlspecialchars($id_cliente ?? '') . '">
        <input type="hidden" name="tipo_usuario" value="' . htmlspecialchars($tipo['tipo_usuario'] ?? '') . '">
    ';

            // Caso seja barbeiro/admin, pode escolher o cliente
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

            // Campo de data e hora do agendamento
            echo '
        <label for="data_agendamento">Data e Hora:</label><br>
        <input type="datetime-local"
            id="data_agendamento"
            name="data_agendamento"
            value="' . htmlspecialchars($data_agendamento ?? '') . '"
            required
            min="' . date('Y-m-d\TH:i') . '"><br><br>
            
        <!-- Seleção do barbeiro -->
        <label for="barbeiro_id">Barbeiro:</label><br>
        <select name="barbeiro_id" id="barbeiro_id" required>
            <option value="">Selecione...</option>';
            foreach ($barbeiros as $b) {
                $selected = ($b['id_barbeiro'] == ($barbeiro_id ?? '')) ? "selected" : "";
                echo '<option value="' . $b['id_barbeiro'] . '" ' . $selected . '>' . htmlspecialchars($b['nome']) . '</option>';
            }
            echo '
        </select><br><br>

        <!-- Seleção do serviço -->
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

            // Campo de status só aparece para barbeiro/admin
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

            // Botão de enviar
            echo '
        <button type="submit">' . htmlspecialchars($botao) . '</button>
    ';
            ?>
        </form>
</body>
</html>
