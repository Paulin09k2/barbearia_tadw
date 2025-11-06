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
    /* ====== ESTILO GERAL ====== */
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #0a0a0a; /* fundo preto uniforme */
      color: #fff;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h1 {
      color: #fff;
      margin-top: 40px;
      text-transform: uppercase;
      letter-spacing: 2px;
    }

    a {
      color: #fff;
      text-decoration: none;
      margin-top: 20px;
      display: inline-block;
      background-color: transparent;
      border: 1px solid #fff;
      padding: 8px 16px;
      border-radius: 6px;
      transition: 0.3s;
    }

    a:hover {
      background-color: #fff;
      color: #000;
    }

    p {
      margin: 10px 0 30px;
      font-size: 1.1em;
    }

    /* ====== TABELA ====== */
    table {
      border-collapse: collapse;
      width: 90%;
      max-width: 1000px;
      background: #121212; /* fundo da tabela mais claro que o fundo */
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 0 25px rgba(255, 255, 255, 0.05);
      margin-bottom: 40px;
    }

    th, td {
      padding: 15px;
      text-align: center;
    }

    th {
      background-color: #1f1f1f;
      color: #fff;
      text-transform: uppercase;
      font-weight: bold;
      letter-spacing: 1px;
    }

    tr:nth-child(even) {
      background-color: #181818;
    }

    tr:nth-child(odd) {
      background-color: #121212;
    }

    tr:hover {
      background-color: #2a2a2a;
      transition: 0.3s;
    }

    td {
      color: #ddd;
    }

    /* ====== BOTÃO EXCLUIR ====== */
    button {
      background-color: #fff;
      border: none;
      padding: 8px 15px;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
      color: #111;
      transition: 0.3s;
    }

    button:hover {
      background-color: #ccc;
      color: #000;
    }

    /* ====== RESPONSIVIDADE ====== */
    @media (max-width: 768px) {
      table {
        width: 100%;
        font-size: 14px;
      }
      th, td {
        padding: 10px;
      }
    }
  </style>
</head>
<body>

  <a href="./index.php">← Voltar para a página Admin</a>
  <h1>Gerenciar Avaliações</h1>
  <p>Nota média geral: ⭐ <?= $mediaGeral; ?></p>

  <table>
      <tr>
          <th>ID</th>
          <th>Cliente</th>
          <th>Barbeiro</th>
          <th>Serviço</th>
          <th>Nota</th>
          <th>Comentário</th>
          <th>Ações</th>
      </tr>

      <?php foreach ($avaliacoes as $a): ?>
          <tr>
              <td><?= $a['idavaliacao']; ?></td>
              <td><?= htmlspecialchars($a['nome_cliente']); ?></td>
              <td><?= htmlspecialchars($a['nome_barbeiro']); ?></td>
              <td><?= htmlspecialchars($a['nome_servico']); ?></td>
              <td>⭐ <?= $a['estrela']; ?></td>
              <td><?= htmlspecialchars($a['comentario']); ?></td>
              <td>
                  <form method="POST" action="../excluirAvaliacao.php" onsubmit="return confirm('Deseja realmente excluir esta avaliação?');">
                      <input type="hidden" name="idavaliacao" value="<?= $a['idavaliacao']; ?>">
                      <button type="submit">Excluir</button>
                  </form>
              </td>
          </tr>
      <?php endforeach; ?>
  </table>

</body>
</html>
