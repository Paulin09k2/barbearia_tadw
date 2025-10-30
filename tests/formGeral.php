<?php
require_once "./conexao.php";
require_once "./funcoes.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Formulários da Barbearia</title>
</head>

<body>
    <h1>Formulários da Barbearia</h1>

    <!-- =================== CLIENTE =================== -->
    <h2>Cadastrar Cliente</h2>
    <form method="post" action="processa.php">
        <input type="hidden" name="acao" value="salvarCliente">
        Nome: <input type="text" name="nome" required><br>
        Email: <input type="email" name="email" required><br>
        Telefone: <input type="text" name="telefone" required><br>
        Endereço: <input type="text" name="endereco" required><br>
        Data de Nascimento: <input type="date" name="data_nascimento" required><br>
        Data de Cadastro: <input type="date" name="data_cadastro" required><br>
        Senha: <input type="password" name="senha_cliente" required><br>
        <button type="submit">Salvar Cliente</button>
    </form>

    <h3>Clientes cadastrados</h3>
    <ul>
        <?php
        $clientes = listarCliente($conexao);
        foreach ($clientes as $c) {
            echo "<li>ID: {$c['id_cliente']} | Nome: {$c['nome']} | Email: {$c['email']}</li>";
        }
        ?>
    </ul>

    <hr>

    <!-- =================== BARBEIRO =================== -->
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
        foreach ($barbeiros as $b) {
            echo "<li>ID: {$b['id_barbeiro']} | Nome: {$b['nome']} | Email: {$b['email']}</li>";
        }
        ?>
    </ul>

    <hr>

    <!-- =================== SERVIÇOS =================== -->
    <h2>Cadastrar Serviço</h2>
    <form method="post" action="processa.php">
        <input type="hidden" name="acao" value="salvarServico">
        Nome Serviço: <input type="text" name="nome_servico" required><br>
        Descrição: <input type="text" name="descricao" required><br>
        Preço: <input type="text" name="preco" required><br>
        Tempo Estimado: <input type="text" name="tempo_estimado" required><br>
        <button type="submit">Salvar Serviço</button>
    </form>



    <!-- =================== AGENDAMENTO =================== -->
    <h2>Cadastrar Agendamento</h2>
    <form method="post" action="processa.php">
        <input type="hidden" name="acao" value="salvarAgendamento">
        Data: <input type="datetime-local" name="data_agendamento" required><br>
        Status: <input type="text" name="status" required><br>
        ID Barbeiro: <input type="number" name="barbeiro_id_barbeiro" required><br>
        ID Cliente: <input type="number" name="cliente_id_cliente" required><br>
        <button type="submit">Salvar Agendamento</button>
    </form>

    <hr>

    <!-- =================== AVALIAÇÃO =================== -->
    <h2>Cadastrar Avaliação</h2>
    <form method="post" action="processa.php">
        <input type="hidden" name="acao" value="salvarAvaliacao">
        Estrelas: <input type="number" name="estrela" min="1" max="5" required><br>
        Comentário: <input type="text" name="comentario" required><br>
        ID Barbeiro: <input type="number" name="barbeiro_id_barbeiro" required><br>
        ID Serviço: <input type="number" name="servico_id_servico" required><br>
        <button type="submit">Salvar Avaliação</button>
    </form>

    <h3>Avaliações cadastradas</h3>
    <ul>
        <?php
        $avaliacoes = listarAvaliacao($conexao);
        foreach ($avaliacoes as $a) {
            echo "<li>ID: {$a['idavaliacao']} | Estrelas: {$a['estrela']} | Comentário: {$a['comentario']}</li>";
        }
        ?>
    </ul>

</body>

</html>