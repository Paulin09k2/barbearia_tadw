<?php
require_once '../conexao.php';
require_once '../funcoes.php';

$avaliacoes = listarAvaliacoes($conexao);
$mediaGeral = calcularMediaAvaliacoes($conexao);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciar Avaliações - Barbearia Elite</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

    * { box-sizing: border-box; }

    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to bottom, #0b0f16, #0d1117);
      color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
    }

    h1 {
      margin-top: 40px;
      color: #fff;
      text-transform: uppercase;
      letter-spacing: 2px;
      text-align: center;
    }

    p {
      color: #d1d5db;
      margin-bottom: 30px;
      font-size: 1.1em;
      text-align: center;
    }

    /* ===== LINK DE VOLTAR ===== */
    a {
      color: #fff;
      text-decoration: none;
      margin: 25px 0;
      display: inline-block;
      transition: 0.3s;
      font-weight: 500;
    }

    a:hover {
      color: #d1d5db;
      transform: translateY(-2px);
    }

    /* ===== CONTAINER ===== */
    .container {
      width: 90%;
      max-width: 1000px;
      background-color: #141a22;
      border-radius: 16px;
      box-shadow: 0 4px 25px rgba(255, 255, 255, 0.05);
      padding: 30px;
      margin-bottom: 50px;
      border: 1px solid #1f2937;
      overflow-x: auto;
      transition: 0.3s;
    }

    .container:hover {
      box-shadow: 0 6px 30px rgba(255, 255, 255, 0.08);
    }

    /* ===== TABELA ===== */
    table {
      width: 100%;
      border-collapse: collapse;
      border-radius: 12px;
      overflow: hidden;
      min-width: 800px;
    }

    th, td {
      padding: 14px;
      text-align: center;
    }

    th {
      background-color: #0d1b2a;
      color: #fff;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      border-bottom: 2px solid #1f2937;
    }

    tr:nth-child(even) {
      background-color: #141a22;
    }

    tr:nth-child(odd) {
      background-color: #0d1117;
    }

    tr:hover {
      background-color: #1e293b;
      transition: 0.3s;
    }

    td {
      color: #d1d5db;
      font-size: 15px;
      vertical-align: middle;
    }

    td.comment {
      text-align: left;
      color: #bfc8cc;
      max-width: 380px;
      white-space: pre-wrap;
      word-wrap: break-word;
    }

    /* ===== BOTÕES ===== */
    button {
      background-color: #fff;
      color: #0b0b0b;
      font-weight: 700;
      border: none;
      padding: 8px 15px;
      border-radius: 8px;
      cursor: pointer;
      box-shadow: 0 4px 10px rgba(255, 255, 255, 0.1);
      transition: transform 0.12s, background 0.12s;
    }

    button:hover {
      transform: translateY(-2px);
      background-color: #f0f0f0;
    }

    .btn-cancel {
      background: #e24b4b;
      color: #fff;
      padding: 8px 12px;
      border-radius: 8px;
      font-weight: 600;
      transition: 0.2s;
    }

    .btn-cancel:hover {
      background: #f05555;
      transform: scale(1.03);
    }

    /* ===== RESPONSIVO ===== */
    @media (max-width: 920px) {
      .container { padding: 20px; }
      table { min-width: 640px; }
      th, td { padding: 12px; font-size: 13px; }
    }

    @media (max-width: 560px) {
      table { min-width: 520px; }
    }
  </style>
</head>
<body>

  <a href="./index.php">← Voltar ao Painel Admin</a>

  <h1>Gerenciar Avaliações</h1>
  <p>Nota média geral: ⭐ <?= htmlspecialchars($mediaGeral); ?></p>

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
        <?php foreach ($avaliacoes as $a): ?>
          <tr>
            <td><?= htmlspecialchars($a['idavaliacao']); ?></td>
            <td><?= htmlspecialchars($a['nome_cliente']); ?></td>
            <td><?= htmlspecialchars($a['nome_barbeiro']); ?></td>
            <td><?= htmlspecialchars($a['nome_servico']); ?></td>
            <td>⭐ <?= (int)$a['estrela']; ?></td>
            <td class="comment"><?= nl2br(htmlspecialchars($a['comentario'])); ?></td>
            <td>
              <form method="POST" action="../excluirAvaliacao.php" onsubmit="return confirm('Deseja realmente excluir esta avaliação?');">
                <input type="hidden" name="idavaliacao" value="<?= htmlspecialchars($a['idavaliacao']); ?>">
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
