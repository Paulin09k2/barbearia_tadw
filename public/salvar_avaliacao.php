<?php
require_once 'conexao.php';
require_once 'funcoes.php';
session_start();

// Pega os dados do formulário
$servico_id = intval($_POST['servico_id_servico'] ?? 0);
$barbeiro_id = intval($_POST['barbeiro_id_barbeiro'] ?? 0);
$estrela = intval($_POST['estrela'] ?? 0);
$comentario = trim($_POST['comentario'] ?? '');
$idusuario_form = intval($_POST['id_cliente'] ?? 0);
$foto = $_FILES['foto'] ?? null;

// Valida se o usuário está logado
if (!$idusuario_form) {
    echo "<script>alert('Erro: Usuário não identificado. Faça login novamente.'); window.location.href='./login.php';</script>";
    exit;
}

// Busca o ID do cliente a partir do ID do usuário
$cliente = pesquisarClienteId($conexao, $idusuario_form);
if (!$cliente || !isset($cliente['id_cliente'])) {
    echo "<script>alert('Erro: Cliente não encontrado. Contate o administrador.'); window.history.back();</script>";
    exit;
}
$id_cliente = intval($cliente['id_cliente']);

// Validações básicas
if (!$servico_id || !$barbeiro_id || !$estrela) {
    echo "<script>alert('Erro: Todos os campos obrigatórios devem ser preenchidos.'); window.history.back();</script>";
    exit;
}

if ($estrela < 1 || $estrela > 5) {
    echo "<script>alert('Erro: A nota deve estar entre 1 e 5.'); window.history.back();</script>";
    exit;
}

// Processa a foto se foi enviada
$foto_nome = '';
if ($foto && $foto['error'] === UPLOAD_ERR_OK) {
    $nome_arquivo = basename($foto['name']);
    $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));

    // Valida extensão
    if (!in_array($extensao, ['jpg', 'jpeg', 'png'])) {
        echo "<script>alert('Erro: Apenas arquivos JPG e PNG são aceitos.'); window.history.back();</script>";
        exit;
    }

    // Valida tamanho (2MB)
    if ($foto['size'] > 2 * 1024 * 1024) {
        echo "<script>alert('Erro: Arquivo muito grande. Máximo 2MB.'); window.history.back();</script>";
        exit;
    }

    // Cria nome único para a foto
    $foto_nome = 'avaliacao_' . time() . '_' . uniqid() . '.' . $extensao;
    $caminho_destino = 'img/avaliacoes/' . $foto_nome;

    // Cria diretório se não existir
    if (!is_dir('img/avaliacoes')) {
        mkdir('img/avaliacoes', 0755, true);
    }

    // Move arquivo para o destino
    if (!move_uploaded_file($foto['tmp_name'], $caminho_destino)) {
        echo "<script>alert('Erro ao fazer upload da imagem.'); window.history.back();</script>";
        exit;
    }
}

// Salva a avaliação no banco de dados
$resultado = salvarAvaliacao($conexao, $estrela, $comentario, $barbeiro_id, $servico_id, $foto_nome, $id_cliente);

if ($resultado) {
    echo "<script>alert('Avaliação salva com sucesso!'); window.location.href='./cliente/index.php';</script>";
} else {
    echo "<script>alert('Erro ao salvar avaliação. Tente novamente.'); window.history.back();</script>";
}

exit;
