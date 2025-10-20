<?php
// Formulário para editar serviços

require_once __DIR__ . "/../../tests/conexao.php";
require_once __DIR__ . "/../../tests/funcoes.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM servico WHERE id_servico = $id";
    $result = mysqli_query($conexao, $sql);
    $servico = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_servico'];
    $nome = $_POST['nome_servico'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $tempo = $_POST['tempo_estimado'];

    $sql = "UPDATE servico SET nome_servico='$nome', descricao='$descricao', preco='$preco', tempo_estimado='$tempo' WHERE id_servico=$id";
    mysqli_query($conexao, $sql);

    header("Location: editar_servicos.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Serviço</title>
</head>
<body>
    <h2>Editar Serviço</h2>
    <form method="POST">
        <input type="hidden" name="id_servico" value="<?php echo $servico['id_servico']; ?>">
        Nome: <input type="text" name="nome_servico" value="<?php echo $servico['nome_servico']; ?>"><br>
        Descrição: <input type="text" name="descricao" value="<?php echo $servico['descricao']; ?>"><br>
        Preço: <input type="number" step="0.01" name="preco" value="<?php echo $servico['preco']; ?>"><br>
        Tempo Estimado (min): <input type="number" name="tempo_estimado" value="<?php echo $servico['tempo_estimado']; ?>"><br>
        <input type="submit" value="Salvar">
    </form>
</body>
</html>
