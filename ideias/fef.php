<?php
require_once "../tests/conexao.php";
require_once "../tests/funcoes.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Serviços - Barbearia Elite</title>
<style>
    body {
        font-family: "Poppins", sans-serif;
        background-color: #f6f8fa;
        margin: 0;
        padding: 0;
    }

    header {
        background-color: #0b132b;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 40px;
    }

    header h1 {
        font-size: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    header h1::before {
        content: "💈";
    }

    nav a {
        color: white;
        margin: 0 10px;
        text-decoration: none;
        font-weight: 500;
    }

    nav a:hover {
        text-decoration: underline;
    }

    .container {
        padding: 40px;
    }

    h2 {
        font-size: 26px;
        color: #111;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-top: 20px;
    }

    th, td {
        text-align: left;
        padding: 12px 10px;
        border-bottom: 1px solid #eee;
    }

    th {
        background-color: #fafafa;
        font-weight: 600;
    }

    .acoes a {
        text-decoration: none;
        font-weight: 600;
        margin-right: 10px;
    }

    .editar {
        color: #007bff;
    }

    .excluir {
        color: #dc3545;
    }

    .btn-novo {
        display: inline-block;
        background: #0b132b;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        float: right;
    }

</style>
</head>
<body>

<header>
    <h1>Barbearia Elite</h1>
    <nav>
        <a href="index.php">Início</a>
        <a href="#">Agendamento</a>
        <a href="#">Contato</a>
    </nav>
</header>

<div class="container">
    <h2>Lista de Serviços</h2>
    <a href="#" class="btn-novo">Novo Serviço</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome do Serviço</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Tempo Estimado (min)</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($servicos) > 0): ?>
                <?php foreach ($servicos as $s): ?>
                    <tr>
                        <td><?= $s['id_servico'] ?></td>
                        <td><?= htmlspecialchars($s['nome_servico']) ?></td>
                        <td><?= htmlspecialchars($s['descricao']) ?></td>
                        <td>R$ <?= number_format($s['preco'], 2, ',', '.') ?></td>
                        <td><?= $s['tempo_estimado'] ?> min</td>
                        <td class="acoes">
                            <a href="editar_servico.php?id=<?= $s['id_servico'] ?>" class="editar">Editar</a>
                            <a href="excluir_servico.php?id=<?= $s['id_servico'] ?>" class="excluir" onclick="return confirm('Tem certeza que deseja excluir este serviço?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align:center;">Nenhum serviço cadastrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>