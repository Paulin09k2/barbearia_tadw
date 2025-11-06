<?php
require_once '../conexao.php';
require_once '../funcoes.php';
session_start();
$id_agendamento = $_POST['id_agendamento'] ?? 0;
$id_cliente = $_POST['id_cliente'] ?? 0;

$filtros = [
    'status'  => $_GET['status'] ?? '',
    'data'    => $_GET['data'] ?? '',
    'cliente' => $_GET['cliente'] ?? ''
];

$resposta = excluirAgendamento($conexao,  $id_cliente, $id_agendamento);
$agendamentos = listarAgendamento($conexao, $filtros);

if (isset($_SESSION['mensagem'])) {
    echo "<script>alert('{$_SESSION['mensagem']}');</script>";
    unset($_SESSION['mensagem']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Agendamentos - Barbearia Elite</title>
    <style>
        /* ======= ESTILO GERAL ======= */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0a0a14, #1b1b2f);
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        a {
            color: #f5b100;
            text-decoration: none;
            margin: 20px 0;
            display: inline-block;
            transition: 0.3s;
        }

        a:hover {
            color: #fff;
            text-decoration: underline;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            background-color: #111827;
            border-radius: 10px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.6);
            padding: 30px;
            margin-bottom: 40px;
        }

        h1 {
            text-align: center;
            color: #f5b100;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 25px;
        }

        /* ======= FILTROS ======= */
        form.filtros {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-bottom: 25px;
        }

        input, select, button {
            padding: 10px 12px;
            border-radius: 6px;
            border: 1px solid #333;
            background-color: #1e293b;
            color: #fff;
            font-size: 0.95em;
        }

        input::placeholder {
            color: #aaa;
        }

        select option {
            background: #111827;
            color: #fff;
        }

        button {
            background-color: #f5b100;
            color: #111;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #fff;
            color: #111;
        }

        /* ======= TABELA ======= */
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0,0,0,0.4);
        }

        th, td {
            padding: 14px;
            text-align: center;
        }

        th {
            background-color: #f5b100;
            color: #111;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        tr:nth-child(even) {
            background-color: #1e293b;
        }

        tr:nth-child(odd) {
            background-color: #111827;
        }

        tr:hover {
            background-color: #334155;
            transition: 0.3s;
        }

        td {
            color: #ddd;
        }

        /* ======= BOTÕES DE AÇÃO ======= */
        .acoes {
            display: flex;
            justify-content: center;
            gap: 6px;
        }

        .editar {
            background-color: #3b82f6;
            color: #fff;
        }

        .cancelar {
            background-color: #dc2626;
            color: #fff;
        }

        .editar:hover {
            background-color: #60a5fa;
        }

        .cancelar:hover {
            background-color: #ef4444;
        }

        /* ======= RESPONSIVO ======= */
        @media (max-width: 768px) {
            form.filtros {
                flex-direction: column;
                align-items: center;
            }

            table {
                font-size: 13px;
            }

            th, td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    
  <a href="index.php">← Voltar para a página inicial</a>

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
