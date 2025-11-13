<?php
session_start();
require_once '../conexao.php';
require_once '../funcoes.php';

$idusuario = $_SESSION['id_barbeiro'] ?? 0;

$barbeiro = pesquisarBarbeiroId($conexao, $idusuario);
// var_dump($barbeiro);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel do Barbeiro</title>

  <!-- Estilos adicionados -->
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

    /* HEADER / CARD */
    .panel {
      background: linear-gradient(180deg, rgba(255,255,255,0.02), transparent);
      padding:22px;
      border-radius:var(--radius);
      box-shadow: 0 8px 30px rgba(1,6,16,0.6);
    }

    .header-row{
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap:12px;
      margin-bottom:18px;
    }

    .barbeiro-info{
      display:flex;
      gap:12px;
      align-items:center;
    }

    .avatar{
      width:64px;
      height:64px;
      border-radius:12px;
      background:linear-gradient(135deg,#22313a, #1a2229);
      display:inline-flex;
      align-items:center;
      justify-content:center;
      font-weight:700;
      color:var(--muted);
      font-size:18px;
      border:1px solid rgba(255,255,255,0.02);
    }

    h1 {
      margin:0;
      font-size:20px;
      color:#fff;
    }

    p.muted {
      margin:0;
      color:var(--muted);
      font-size:13px;
    }

    /* RESUMO GRID */
    .resumo-grid{
      display:grid;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      gap:12px;
      margin-top:8px;
    }

    .card{
      background:var(--surface);
      padding:14px;
      border-radius:10px;
      text-align:center;
    }

    .card h3{
      margin:0 0 6px 0;
      font-size:16px;
      color:#fff;
    }

    .card p{
      margin:0;
      color:var(--muted);
      font-weight:700;
      font-size:18px;
    }

    /* AGENDAMENTOS */
    .agend-list{
      margin-top:18px;
      display:flex;
      flex-direction:column;
      gap:10px;
    }

    .agend-item{
      background:linear-gradient(180deg, rgba(255,255,255,0.01), transparent);
      padding:12px;
      border-radius:8px;
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap:12px;
      border:1px solid rgba(255,255,255,0.03);
    }

    .agend-item .meta{
      display:flex;
      flex-direction:column;
    }

    .small{
      font-size:13px;
      color:var(--muted);
    }

    .empty{
      color:var(--muted);
      padding:12px;
      border-radius:8px;
      background:rgba(255,255,255,0.01);
    }

    /* Responsividade */
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
    }
  </style>
</head>

<body>
  <div class="wrap">
    <nav>
      <ul>
        <li><a href="./index.php">Início</a></li>
        <li><a href="./gerenciador.php">Gerenciar</a></li>
        <li><a href="./avaliacao.php">Avaliações</a></li>
        <li><a href="./adicionarServico.php">Serviços</a></li>
        <li><a href="./adicionarbarbeiro.php">Adicionar Barbeiro</a></li>
        <?php if ($idusuario): ?>
        <?php endif; ?>
        <li><a href="../sair.php">Sair</a></li>
      </ul>
    </nav>

    <main class="panel">
      <div class="header-row">
        <div class="barbeiro-info">
          <div class="avatar">
            <?php
              // Mostra iniciais do barbeiro (se disponível) ou "B"
              if (!empty($barbeiro['nome'])) {
                  $parts = explode(' ', trim($barbeiro['nome']));
                  $iniciais = strtoupper(($parts[0][0] ?? 'B') . ($parts[1][0] ?? ''));
                  echo htmlspecialchars($iniciais, ENT_QUOTES);
              } else {
                  echo 'A';
              }
            ?>
          </div>
          <div>
            <h1>
              <?php
                // Exibe o nome do barbeiro ou mensagem padrão
                echo !empty($barbeiro['nome']) ? htmlspecialchars($barbeiro['nome'], ENT_QUOTES) : 'Administrador';
              ?>
            </h1>
            <p class="muted">Painel Administrativo</p>
          </div>
        </div>

        <div>
          <p class="small muted">Bem vindo ao painel</p>
        </div>
      </div>

      <?php
      // --- CORREÇÃO DO ERRO (linha com acesso a $barbeiro['id_barbeiro']) ---
      // Se $barbeiro existir e tiver id_barbeiro, busca o resumo.
      // Caso contrário, inicializa valores padrão para evitar "array offset on value of type null".
      if (!empty($barbeiro) && isset($barbeiro['id_barbeiro'])) {
          // Segurança extra: força inteiro
          $idBarbeiro = intval($barbeiro['id_barbeiro']);
          $resumo = obterResumoPainelBarbeiro($conexao, $idBarbeiro);
      } else {
          // Barbeiro não encontrado — evita erros posteriores criando resumo vazio
          $resumo = [
              'total_clientes' => 0,
              'total_servicos' => 0,
              'proximos_agendamentos' => []
          ];
          echo '<p class="empty">Barbeiro não encontrado. Faça login novamente ou verifique sua conta.</p>';
      }
      // --- FIM DA CORREÇÃO ---
      ?>

      <section class="resumo-grid" aria-live="polite">
        <div class="card">
          <h3>Total de Clientes</h3>
          <p><?php echo intval($resumo['total_clientes'] ?? 0); ?></p>
        </div>

        <div class="card">
          <h3>Total de Serviços</h3>
          <p><?php echo intval($resumo['total_servicos'] ?? 0); ?></p>
        </div>

        <div class="card">
          <h3>Próximos Agendamentos</h3>
          <p class="small muted"><?php echo count($resumo['proximos_agendamentos'] ?? []) > 0 ? count($resumo['proximos_agendamentos']) . ' agendamento(s)' : 'Nenhum'; ?></p>
        </div>
      </section>

      <div class="agend-list" aria-label="Próximos agendamentos">
        <h4 style="margin:0 0 8px 0;">Próximos Agendamentos:</h4>

        <?php
        if (!empty($resumo['proximos_agendamentos']) && count($resumo['proximos_agendamentos']) > 0) {
          foreach ($resumo['proximos_agendamentos'] as $ag) {
            // uso de htmlspecialchars para evitar XSS caso venham nomes/datas do DB
            $data = htmlspecialchars($ag['data_agendamento'] ?? '', ENT_QUOTES);
            $cliente = htmlspecialchars($ag['nome_cliente'] ?? 'Cliente', ENT_QUOTES);
            echo "<div class=\"agend-item\"><div class=\"meta\"><strong>$cliente</strong><span class=\"small\">$data</span></div><div class=\"small muted\">Detalhes</div></div>";
          }
        } else {
          echo '<div class="empty">Nenhum agendamento futuro encontrado.</div>';
        }
        ?>
      </div>
    </main>
  </div>
</body>
</html>
