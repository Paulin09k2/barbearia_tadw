<?php
// Lista e permite editar serviços (cortes)

require_once __DIR__ . "/../../tests/conexao.php";
require_once __DIR__ . "/../../tests/funcoes.php";

$sql = "SELECT * FROM servico";
$result = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Serviços</title>
</head>
<body>
    <h2>Serviços Registrados</h2>
    <table border="1">
        <tr>
            <th>Serviço</th>
            <th>Preço</th>
            <th>Tempo (min)</th>
            <th>Ações</th>
        </tr>
        <?php while($servico = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $servico['nome_servico']; ?></td>
            <td>R$ <?php echo number_format($servico['preco'], 2, ',', '.'); ?></td>
            <td><?php echo $servico['tempo_estimado']; ?></td>
            <td><a href="form_editar_servico.php?id=<?php echo $servico['id_servico']; ?>">Editar</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
