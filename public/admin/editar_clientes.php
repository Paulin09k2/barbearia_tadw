<?php
// Lista e permite editar clientes cadastrados

require_once __DIR__ . "/../../tests/conexao.php";
require_once __DIR__ . "/../../tests/funcoes.php";

$sql = "SELECT id_cliente, nome, telefone, endereco FROM cliente";
$result = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Clientes</title>
</head>
<body>
    <h2>Clientes Cadastrados</h2>
    <table border="1">
        <tr>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Endereço</th>
            <th>Ações</th>
        </tr>
        <?php while($cliente = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $cliente['nome']; ?></td>
            <td><?php echo $cliente['telefone']; ?></td>
            <td><?php echo $cliente['endereco']; ?></td>
            <td>
                <a href="form_editar_cliente.php?id=<?php echo $cliente['id_cliente']; ?>">Editar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
