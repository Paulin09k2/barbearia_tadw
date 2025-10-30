<?php
// Se estiver editando, essas variáveis devem vir preenchidas.
// Caso contrário, ficam vazias para cadastro.
$id_servico =$_POST['id_servico'] ?? '';
$nome_servico =$_POST['nome_servico'] ?? '';
$descricao =$_POST['descricao'] ?? '';
$preco =$_POST['preco'] ?? '';
$tempo_estimado =$_POST['tempo_estimado'] ?? '';
$botao = empty($id_servico) ? 'Cadastrar' : 'Atualizar';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $botao; ?> Serviço</title>
</head>
<body>

    <h1><?= $botao; ?> Serviço</h1>
    <a href="./admin/servico.php">Voltar à lista</a>
    <hr>

    <form action="./salvarServico.php" method="POST">
        <input type="hidden" name="id_servico" value="<?= htmlspecialchars($id_servico); ?>">

        <label for="nome_servico">Nome do Serviço:</label><br>
        <input type="text" id="nome_servico" name="nome_servico" 
               value="<?= htmlspecialchars($nome_servico); ?>" required>
        <br>

        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao" rows="4"><?= htmlspecialchars($descricao); ?></textarea>
        <br>

        <label for="preco">Preço (R$):</label><br>
        <input type="number" id="preco" name="preco" step="0.01" min="0" 
               value="<?= htmlspecialchars($preco); ?>" required>
        <br>

        <label for="tempo_estimado">Tempo Estimado (minutos):</label><br>
        <input type="number" id="tempo_estimado" name="tempo_estimado" min="5" max="480" 
               value="<?= htmlspecialchars($tempo_estimado); ?>" required>
        <br>

        <button type="submit"><?= $botao; ?></button>
    </form>

</body>
</html>
