<?php
// Se estiver editando, essas variáveis recebem dados do formulário anterior (via POST).
// Caso contrário, ficam vazias para o cadastro de um novo serviço.
$id_servico     = $_POST['id_servico'] ?? '';        // ID do serviço (usado na edição)
$nome_servico   = $_POST['nome_servico'] ?? '';      // Nome do serviço
$descricao      = $_POST['descricao'] ?? '';         // Descrição do serviço
$preco          = $_POST['preco'] ?? '';             // Valor do serviço
$tempo_estimado = $_POST['tempo_estimado'] ?? '';    // Duração estimada do serviço em minutos

// Define o texto do botão e do título conforme o contexto (cadastrar ou editar)
$botao = empty($id_servico) ? 'Cadastrar' : 'Atualizar';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $botao; ?> Serviço</title> <!-- Título muda conforme ação -->
</head>
<body>

    <!-- Cabeçalho dinâmico conforme ação -->
    <h1><?= $botao; ?> Serviço</h1>
    <a href="./admin/servico.php">Voltar à lista</a> <!-- Link para retornar à lista de serviços -->
    <hr>

    <!-- Formulário de cadastro/edição -->
    <form action="./salvarServico.php" method="POST">
        <!-- Campo oculto: usado apenas quando está editando -->
        <input type="hidden" name="id_servico" value="<?= htmlspecialchars($id_servico); ?>">

        <!-- Campo: nome do serviço -->
        <label for="nome_servico">Nome do Serviço:</label><br>
        <input type="text" id="nome_servico" name="nome_servico" 
               value="<?= htmlspecialchars($nome_servico); ?>" required>
        <br>

        <!-- Campo: descrição -->
        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao" rows="4"><?= htmlspecialchars($descricao); ?></textarea>
        <br>

        <!-- Campo: preço -->
        <label for="preco">Preço (R$):</label><br>
        <input type="number" id="preco" name="preco" step="0.01" min="0" 
               value="<?= htmlspecialchars($preco); ?>" required>
        <br>

        <!-- Campo: tempo estimado em minutos -->
        <label for="tempo_estimado">Tempo Estimado (minutos):</label><br>
        <input type="number" id="tempo_estimado" name="tempo_estimado" min="5" max="480" 
               value="<?= htmlspecialchars($tempo_estimado); ?>" required>
        <br>

        <!-- Botão principal (Cadastrar ou Atualizar) -->
        <button type="submit"><?= $botao; ?></button>
    </form>

</body>
</html>
