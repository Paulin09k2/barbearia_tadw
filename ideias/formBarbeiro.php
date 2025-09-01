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
   <h2>Cadastrar Barbeiro</h2>
    <form method="post" action="processa.php">
        <input type="hidden" name="acao" value="salvarBarbeiro">
        Nome: <input type="text" name="nome" required><br>
        Email: <input type="email" name="email" required><br>
        Telefone: <input type="text" name="telefone" required><br>
        CPF: <input type="text" name="cpf" required><br>
        Data de Nascimento: <input type="date" name="data_nascimento" required><br>
        Data de Admissão: <input type="date" name="data_admissao" required><br>
        Senha: <input type="password" name="senha_barbeiro" required><br>
        <button type="submit">Salvar Barbeiro</button>
    </form>

    <h3>Barbeiros cadastrados</h3>
    <ul>
        <?php
        $barbeiros = listarBarbeiro($conexao);
        foreach($barbeiros as $b){
            echo "<li>ID: {$b['id_barbeiro']} | Nome: {$b['nome']} | Email: {$b['email']}</li>";
        }
        ?>
    </ul>

    <hr>
</body>
</html>