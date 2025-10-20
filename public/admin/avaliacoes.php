<?php
// Exibe a quantidade de agendamentos por barbeiro

require_once __DIR__ . "/../../tests/conexao.php";
require_once __DIR__ . "/../../tests/funcoes.php";

$sql = "SELECT b.nome AS barbeiro, COUNT(a.id_agendamento) AS total_agendamentos
        FROM agendamento a
        INNER JOIN barbeiro b ON a.barbeiro_id_barbeiro = b.id_barbeiro
        GROUP BY b.id_barbeiro, b.nome";

$result = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Agendamentos por Barbeiro</title>
</head>
<body>
    <h2>Quantidade de cortes agendados por barbeiro</h2>
    <table border="1">
        <tr>
            <th>Barbeiro</th>
            <th>Total de Agendamentos</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['barbeiro']; ?></td>
            <td><?php echo $row['total_agendamentos']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
