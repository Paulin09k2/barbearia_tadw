  <?php
require_once '../conexao.php';
require_once '../funcoes.php';

$avaliacoes = listarAvaliacoes($conexao);
$mediaGeral = calcularMediaAvaliacoes($conexao);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Avaliacao</title>
</head>
<body>
<a href="./index.php">Voltar para a pagina Admin</a>
<h1>Gerenciar Avaliações</h1>
<p>Nota média geral: ⭐ <?= $mediaGeral; ?></p>

<table border="1" cellpadding="8">
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