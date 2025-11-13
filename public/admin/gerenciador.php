<?php
require_once '../conexao.php';
require_once '../funcoes.php';
session_start();

// Obtém os dados de POST (para cancelar)
$id_agendamento = $_POST['id_agendamento'] ?? 0;
$id_cliente = $_POST['id_cliente'] ?? 0;

// Define os filtros via GET
$filtros = [
    'status'  => $_GET['status'] ?? '',
    'data'    => $_GET['data'] ?? '',
    'cliente' => $_GET['cliente'] ?? ''
];

// Cancela agendamento (caso enviado via POST)
$resposta = excluirAgendamento($conexao,  $id_cliente, $id_agendamento);

// Lista agendamentos com filtros
$agendamentos = listarAgendamento($conexao, $filtros);

// Exibe mensagem de sessão (se existir)
if (isset($_SESSION['mensagem'])) {
    echo "<script>alert('{$_SESSION['mensagem']}');</script>";
    unset($_SESSION['mensagem']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Gerenciar Agendamentos - Barbearia Elite</title>

  <style>
    /* ===== VARIÁVEIS DE ESTILO ===== */
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
      font-family: 'Poppins', sans-serif;
    }

    /* ===== GERAL ===== */
    html,body{
      height:100%;
      background: radial-gradient(circle at 10% 10%, rgba(255,205,0,0.03), transparent 10%), var(--bg);
      color:#e6eef6;
      margin:0;
      padding:0;
      display:flex;
      flex-direction:column;
      align-items:center;
    }

    a {
      color:var(--accent);
      text-decoration:none;
      margin:24px 0;
      font-weight:600;
      transition:.3s;
    }

    a:hover{
      color:var(--accent-dark);
      transform:translateY(-2px);
    }

    h1{
      margin:20px 0 6px 0;
      font-size:24px;
      color:#fff;
      text-transform:uppercase;
      letter-spacing:1px;
    }

    p{
      color:var(--muted);
      font-size:15px;
      margin-bottom:22px;
    }

    /* ===== CONTAINER PRINCIPAL ===== */
    .container{
      width:90%;
      max-width:var(--maxw);
      background:var(--card);
      border-radius:var(--radius);
      box-shadow:0 6px 24px rgba(2,6,23,0.6);
      padding:24px;
      margin-bottom:40px;
      overflow-x:auto;
    }

    /* ===== FORMULÁRIO DE FILTROS ===== */
    form.filtros{
      display:flex;
      flex-wrap:wrap;
      justify-content:center;
      gap:10px;
      margin-bottom:25px;
    }

    input,select,button{
      padding:10px 12px;
      border-radius:6px;
      border:1px solid #333;
      background-color:#1e293b;
      color:#fff;
      font-size:0.95em;
    }

    select option{ background:#111827; color:#fff; }

    button{
      background:var(--accent);
      color:#000;
      border:none;
      border-radius:8px;
      font-weight:600;
      cursor:pointer;
      transition:.3s;
    }

    button:hover{
      background:var(--accent-dark);
      transform:scale(1.05);
    }

    /* ===== TABELA ===== */
    table{
      width:100%;
      border-collapse:collapse;
      border-radius:var(--radius);
      overflow:hidden;
      min-width:800px;
    }

    th,td{
      padding:14px;
      text-align:center;
    }

    th{
      background:var(--accent);
      color:#000;
      text-transform:uppercase;
      font-weight:700;
      letter-spacing:1px;
    }

    tr:nth-child(even){ background-color:#1a222c; }
    tr:nth-child(odd){ background-color:#121a23; }

    tr:hover{
      background-color:#1f2a38;
      transition:0.3s;
    }

    td{
      color:var(--muted);
      font-size:15px;
    }

    /* ===== BOTÕES DE AÇÃO ===== */
    .acoes{
      display:flex;
      justify-content:center;
      gap:8px;
    }

    .editar{
      background:#3b82f6;
      color:#fff;
      border:none;
      padding:8px 12px;
      border-radius:8px;
    }

    .editar:hover{ background:#60a5fa; }

    .cancelar{
      background:#e24b4b;
      color:#fff;
      border:none;
      padding:8px 12px;
      border-radius:8px;
    }

    .cancelar:hover{ background:#f05555; }

    /* ===== RESPONSIVIDADE ===== */
    @media(max-width:880px){
      .container{ padding:16px; }
      table{ min-width:600px; }
      th,td{ padding:10px; font-size:13px; }
    }

    @media(max-width:560px){
      table{ min-width:520px; }
    }
  </style>
</head>

<body>
  <a href="index.php">← Voltar ao Painel</a>

  <h1>Gerenciar Agendamentos</h1>
</form>

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
            echo "<tr>
                    <td>{$ag['id_agendamento']}</td>
                    <td>" . htmlspecialchars($ag['cliente_nome'] ?? '') . "</td>
                    <td>" . date('d/m/Y H:i', strtotime($ag['data_agendamento'])) . "</td>
                    <td>" . ucfirst($ag['status']) . "</td>
                    <td>" . htmlspecialchars($ag['servicos'] ?? '—') . "</td>
                    <td class='acoes'>
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
                    </td>
                  </tr>";
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
