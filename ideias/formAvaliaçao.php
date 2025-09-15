<?php
require_once "../tests/conexao.php";
require_once "../tests/funcoes.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
      <h2>Cadastrar Avaliação</h2>
    <form method="post" action="processa.php">
        <input type="hidden" name="acao" value="salvarAvaliacao">
        Estrelas: <input type="number" name="estrela" min="1" max="5" required><br>
        Comentário: <input type="text" name="comentario" required><br>
        ID Barbeiro: <input type="number" name="barbeiro_id_barbeiro" required><br>
        ID Serviço: <input type="number" name="servico_id_servico" required><br>
        <button type="submit">Salvar Avaliação</button>
    </form>
        <a href="index.php"><button>Sair</button></a>
    <h3>Avaliações cadastradas</h3>
    <ul>
        <?php
        $avaliacoes = listarAvaliacao($conexao);
        foreach($avaliacoes as $a){
            echo "<li>ID: {$a['idavaliacao']} | Estrelas: {$a['estrela']} | Comentário: {$a['comentario']}</li>";
        }
        ?>
    </ul>
    <link rel="stylesheet" href="desing.css">
</body>
</html>