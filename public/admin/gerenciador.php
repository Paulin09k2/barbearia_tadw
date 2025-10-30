<?php
require_once '../conexao.php';
require_once '../funcoes.php';
session_start();
$id_agendamento = $_POST['id_agendamento'] ?? 0;
$id_cliente = $_POST['id_cliente'] ?? 0;
// --- FILTROS ---
$filtros = [
    'status'  => $_GET['status'] ?? '',
    'data'    => $_GET['data'] ?? '',
    'cliente' => $_GET['cliente'] ?? ''
];

$resposta = excluirAgendamento($conexao,  $id_cliente, $id_agendamento);
// --- LISTAGEM ---
$agendamentos = listarAgendamento($conexao, $filtros);

if (isset($_SESSION['mensagem'])) {
    echo "<script>alert('{$_SESSION['mensagem']}');</script>";
    unset($_SESSION['mensagem']);
}
// echo "<pre>;";
// print_r($agendamentos);
// echo "</pre>;"
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Agendamentos</title>
    <!-- <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 0; }
        .container { width: 90%; margin: 40px auto; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #333; }
        form.filtros { display: flex; justify-content: center; gap: 10px; margin-bottom: 20px; }
        input, select, button { padding: 8px 10px; border-radius: 5px; border: 1px solid #ccc; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 10px; border-bottom: 1px solid #ddd; text-align: center; }
        th { background: #eee; }
        tr:hover { background: #f3f3f3; }
        .acoes button { margin: 0 4px; padding: 6px 12px; border: none; border-radius: 5px; cursor: pointer; }
        .editar { background-color: #007bff; color: #fff; }
        .cancelar { background-color: #dc3545; color: #fff; }
    </style> -->
</head>
<body>
    
  <a href="index.php">Voltar para a pagina inicial</a>
    <div class="container">
        <h1>Gerenciar Agendamentos</h1>

        <!-- FILTROS -->
        <form method="GET" class="filtros">
            <input type="text" name="cliente" placeholder="Nome do cliente" value="<?= htmlspecialchars($filtros['cliente']) ?>">
            <input type="date" name="data" value="<?= htmlspecialchars($filtros['data']) ?>">
            <select name="status">
                <option value="">Todos os status</option>
                <option value="pendente" <?= $filtros['status'] === 'pendente' ? 'selected' : '' ?>>Pendente</option>
                <option value="confirmado" <?= $filtros['status'] === 'confirmado' ? 'selected' : '' ?>>Confirmado</option>
                <option value="cancelado" <?= $filtros['status'] === 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
            </select>
            <button type="submit">Filtrar</button>
        </form>

        <!-- LISTAGEM -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Serviços</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($agendamentos)) {
                    foreach ($agendamentos as $ag) {
                        echo "<tr>";
                        echo "<td>{$ag['id_agendamento']}</td>";
                        echo "<td>" . htmlspecialchars($ag['cliente_nome'] ?? '') . "</td>";
                        echo "<td>" . date('d/m/Y H:i', strtotime($ag['data_agendamento'])) . "</td>";
                        echo "<td>" . ucfirst($ag['status']) . "</td>";
                        echo "<td>" . htmlspecialchars($ag['servicos'] ?? '—') . "</td>";
                        echo "<td class='acoes'>
                                <form action='../formAgendamento.php' method='GET' style='display:inline;'>
                                    <input type='hidden' name='id_agendamento' value='{$ag['id_agendamento']}'>
                                    <input type='hidden' name='id_servico' value='{$ag['id_servico']}'>

                                    <button type='submit' class='editar'>Editar</button>
                                </form>
                                <form action='' method='POST' style='display:inline;' onsubmit=\"return confirm('Tem certeza que deseja cancelar este agendamento?');\">
                                    <input type='hidden' name='id_agendamento' value='{$ag['id_agendamento']}'>
                                    <input type='hidden' name='id_cliente' value='{$ag['id_cliente']}'>

                                    <button type='submit' class='cancelar'>Cancelar</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Nenhum agendamento encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
