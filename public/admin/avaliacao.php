<?php
// Inclui o arquivo de conexão com o banco de dados
require_once '../conexao.php';

// Inclui o arquivo com funções auxiliares
require_once '../funcoes.php';

// Busca todas as avaliações no banco
$avaliacoes = listarAvaliacoes($conexao);

// Calcula a média geral das avaliações
$mediaGeral = calcularMediaAvaliacoes($conexao);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8"> <!-- Define o charset para caracteres acentuados -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsividade -->
  <title>Gerenciar Avaliações - Barbearia Elite</title> <!-- Título da aba do navegador -->

  <style>
    /* ===== VARIÁVEIS DE ESTILO ===== */
    :root{
      --bg:#0f141b;              /* Cor de fundo principal */
      --card:#121a23;            /* Fundo dos cards */
      --muted:#bfc8d2;           /* Cor de texto secundária */
      --accent:#ffcd00;          /* Cor de destaque (amarelo) */
      --accent-dark:#d6b800;     /* Cor de destaque escurecida */
      --surface:#1c2530;         /* Superfície intermediária */
      --radius:12px;             /* Raio de borda padrão */
      --maxw:1100px;             /* Largura máxima do conteúdo */
      --gap:18px;                /* Espaçamento padrão */
      font-family: 'Poppins', sans-serif; /* Fonte padrão */
    }

    /* ===== CONFIGURAÇÕES GERAIS ===== */
    html,body{
      height:100%; /* Garante altura total */
      background: radial-gradient(circle at 10% 10%, rgba(255,205,0,0.03), transparent 10%), var(--bg);
      color:#e6eef6;
      margin:0;
      padding:0;
      display:flex;
      flex-direction:column;
      align-items:center;
    }

    /* ===== CABEÇALHO E LINKS ===== */
    a {
      color:var(--accent); /* Cor do link */
      text-decoration:none; /* Remove sublinhado */
      margin:24px 0;
      font-weight:600;
      transition:.3s;
    }

    a:hover{
      color:var(--accent-dark); /* Escurece no hover */
      transform:translateY(-2px); /* Sobe levemente */
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
      overflow-x:auto; /* Permite rolagem horizontal em telas pequenas */
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

    tr:nth-child(even){
      background-color:#1a222c; /* Linha par */
    }

    tr:nth-child(odd){
      background-color:#121a23; /* Linha ímpar */
    }

    tr:hover{
      background-color:#1f2a38; /* Hover */
      transition:0.3s;
    }

    td{
      color:var(--muted);
      font-size:15px;
    }

    td.comment{
      text-align:left;
      white-space:pre-wrap; /* Mantém quebras de linha */
      word-wrap:break-word; /* Quebra textos longos */
    }

    /* ===== BOTÕES ===== */
    button{
      background:var(--accent);
      color:#000;
      border:none;
      padding:8px 14px;
      border-radius:8px;
      font-weight:600;
      cursor:pointer;
      transition:0.2s;
    }

    button:hover{
      background:var(--accent-dark);
      transform:scale(1.05);
    }

    .btn-cancel{
      background:#e24b4b;
      color:#fff;
    }

    .btn-cancel:hover{
      background:#f05555;
    }

    /* ===== RESPONSIVIDADE ===== */
    @media (max-width:880px){
      .container{ padding:16px; }
      table{ min-width:600px; }
      th,td{ padding:10px; font-size:13px; }
    }

    @media (max-width:560px){
      table{ min-width:520px; }
    }
  </style>
</head>

<body>
  <!-- Link de navegação de retorno -->
  <a href="./index.php">← Voltar ao Painel Admin</a>

  <!-- Título da página -->
  <h1>Gerenciar Avaliações</h1>

  <!-- Exibe a média geral das avaliações -->
  <p>Nota média geral: ⭐ <?= htmlspecialchars($mediaGeral); ?></p>

  <!-- Container da tabela -->
  <div class="container">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Cliente</th>
          <th>Barbeiro</th>
          <th>Serviço</th>
          <th>Nota</th>
          <th>Comentário</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        // Percorre todas as avaliações listadas
        foreach ($avaliacoes as $a): ?>
          <tr>
            <!-- Exibe o ID da avaliação -->
            <td><?= htmlspecialchars($a['idavaliacao']); ?></td>

            <!-- Exibe o nome do cliente -->
            <td><?= htmlspecialchars($a['nome_cliente']); ?></td>

            <!-- Exibe o nome do barbeiro -->
            <td><?= htmlspecialchars($a['nome_barbeiro']); ?></td>

            <!-- Exibe o nome do serviço avaliado -->
            <td><?= htmlspecialchars($a['nome_servico']); ?></td>

            <!-- Exibe a nota (com estrela) -->
            <td>⭐ <?= (int)$a['estrela']; ?></td>

            <!-- Exibe o comentário do cliente -->
            <td class="comment"><?= nl2br(htmlspecialchars($a['comentario'])); ?></td>

            <!-- Ações de exclusão -->
            <td>
              <!-- Formulário que envia o ID da avaliação para exclusão -->
              <form method="POST" action="../excluirAvaliacao.php" 
                    onsubmit="return confirm('Deseja realmente excluir esta avaliação?');">
                <input type="hidden" name="idavaliacao" 
                       value="<?= htmlspecialchars($a['idavaliacao']); ?>">
                <button type="submit" class="btn-cancel">Excluir</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
