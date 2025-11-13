<?php
require_once '../conexao.php';
require_once '../funcoes.php';

// Inicia a sessão para armazenar mensagens e dados do usuário
session_start();

// Obtém o ID do agendamento enviado por POST (caso o usuário cancele)
$id_agendamento = $_POST['id_agendamento'] ?? 0;

// Obtém o ID do cliente enviado por POST
$id_cliente = $_POST['id_cliente'] ?? 0;

// Define os filtros de pesquisa a partir dos parâmetros GET
$filtros = [
    'status'  => $_GET['status'] ?? '',
    'data'    => $_GET['data'] ?? '',
    'cliente' => $_GET['cliente'] ?? ''
];

// Executa a função para excluir (ou cancelar) agendamento, se for enviado via POST
$resposta = excluirAgendamento($conexao, $id_cliente, $id_agendamento);

// Busca todos os agendamentos com base nos filtros definidos
$agendamentos = listarAgendamento($conexao, $filtros);

// Exibe uma mensagem de alerta, se existir mensagem na sessão
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
    :root{
      --bg:#0f141b;
      --card:#121a23;
      --muted:#bfc8d2;
      --accent:#ffcd00;
      --accent-dark:#d6b800;
      --surface:#1c2530;
      --radius:12px;
      --maxw:1100px;
      --gap:18px;
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }

    html,body{
      height:100%;
      background: radial-gradient(circle at 10% 10%, rgba(255,205,0,0.03), transparent 10%), var(--bg);
      color:#e6eef6;
      margin:0;
      padding:0;
    }

    .wrap{
      max-width:var(--maxw);
      margin:30px auto;
      padding:24px;
      display:grid;
      grid-template-columns: 260px 1fr;
      gap:var(--gap);
      align-items:start;
    }

    /* NAV */
    nav{
      background:var(--card);
      padding:18px;
      border-radius:var(--radius);
      box-shadow: 0 6px 18px rgba(2,6,23,0.6);
      position:sticky;
      top:20px;
      height:fit-content;
    }

    nav ul{
      list-style:none;
      padding:0;
      margin:0;
      display:flex;
      flex-direction:column;
      gap:8px;
    }

    nav a{
      display:block;
      padding:10px 12px;
      color:var(--muted);
      text-decoration:none;
      border-radius:8px;
      font-weight:600;
      transition: all .15s ease;
    }

    nav a:hover{
      color:#071017;
      background:var(--accent);
      transform:translateX(4px);
    }

    /* PAINEL PRINCIPAL */
    .panel {
      background: linear-gradient(180deg, rgba(255,255,255,0.02), transparent);
      padding:22px;
      border-radius:var(--radius);
      box-shadow: 0 8px 30px rgba(1,6,16,0.6);
    }

    .panel h1 {
      color: var(--accent);
      margin-top: 0;
      text-transform: uppercase;
      font-size: 22px;
      letter-spacing: 1px;
      text-align:center;
    }

    /* FILTROS */
    form.filtros {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 10px;
      margin-bottom: 20px;
    }

    input, select, button {
      padding: 10px 12px;
      border-radius: 8px;
      border: 1px solid rgba(255,255,255,0.1);
      background-color: var(--surface);
      color: #fff;
      font-size: 0.9em;
    }

    input::placeholder {
      color: var(--muted);
    }

    button {
      background-color: var(--accent);
      color: #000;
      font-weight: bold;
      border: none;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background-color: var(--accent-dark);
    }

    /* TABELA DE AGENDAMENTOS */
    table {
      width: 100%;
      border-collapse: collapse;
      border-radius: var(--radius);
      overflow: hidden;
      box-shadow: 0 0 20px rgba(0,0,0,0.4);
    }

    th, td {
      padding: 12px;
      text-align: center;
    }

    th {
      background-color: var(--accent);
      color: #000;
      text-transform: uppercase;
      font-size: 0.85em;
      letter-spacing: 1px;
    }

    tr:nth-child(even) {
      background-color: rgba(255,255,255,0.02);
    }

    tr:nth-child(odd) {
      background-color: rgba(255,255,255,0.05);
    }

    tr:hover {
      background-color: rgba(255,255,255,0.08);
      transition: 0.3s;
    }

    td {
      color: var(--muted);
      font-size: 0.95em;
    }

    /* BOTÕES DE AÇÃO */
    .acoes {
      display: flex;
      justify-content: center;
      gap: 6px;
    }

    .editar {
      background-color: #3b82f6;
      color: #fff;
      border: none;
      padding: 6px 10px;
      border-radius: 6px;
      font-size: 0.85em;
    }

    .editar:hover {
      background-color: #60a5fa;
    }

    .cancelar {
      background-color: #dc2626;
      color: #fff;
      border: none;
      padding: 6px 10px;
      border-radius: 6px;
      font-size: 0.85em;
    }

    .cancelar:hover {
      background-color: #ef4444;
    }

    /* MODO RESPONSIVO */
    @media (max-width: 880px){
      .wrap{
        grid-template-columns: 1fr;
        padding:16px;
      }

      nav{
        display:flex;
        overflow:auto;
      }

      nav ul{
        flex-direction:row;
        gap:6px;
      }

      nav a{
        white-space:nowrap;
      }

      table {
        font-size: 12px;
      }
    }
  </style>
</head>

<body>
  <div class="wrap">
    <!-- MENU LATERAL -->
    <nav>
      <ul>
        <li><a href="index.php">Início</a></li>
        <li><a href="gerenciador.php">Gerenciar</a></li>
        <li><a href="avaliacao.php">Avaliações</a></li>
        <li><a href="adicionarServico.php">Serviços</a></li>
        <li><a href="../sair.php">Sair</a></li>
      </ul>
    </nav>

    <!-- CONTEÚDO PRINCIPAL -->
    <div class="panel">
      <h1>Gerenciar Agendamentos</h1>

      <!-- FILTROS -->
      <form method="GET" class="filtros">
        <input type="text" name="cliente" placeholder="Nome do cliente"
               value="<?= htmlspecialchars($filtros['cliente']) ?>">

        <input type="date" name="data"
               value="<?= htmlspecialchars($filtros['data']) ?>">

        <select name="status">
          <option value="">Todos os status</option>
          <option value="pendente" <?= $filtros['status'] === 'pendente' ? 'selected' : '' ?>>Pendente</option>
          <option value="confirmado" <?= $filtros['status'] === 'confirmado' ? 'selected' : '' ?>>Confirmado</option>
          <option value="cancelado" <?= $filtros['status'] === 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
        </select>

        <button type="submit">Filtrar</button>
      </form>

      <!-- LISTAGEM DE AGENDAMENTOS -->
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

                          <form action='' method='POST' style='display:inline;'
                                onsubmit=\"return confirm('Tem certeza que deseja cancelar este agendamento?');\">
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
  </div>
</body>
</html>
