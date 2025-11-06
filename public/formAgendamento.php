<?php
require_once "./conexao.php";
require_once "./funcoes.php";
session_start();

// --- Verifica se o cliente está logado ---
if (!isset($_SESSION['idusuario'])) {
    $_SESSION['mensagem'] = "⚠️ Faça login para enviar uma avaliação.";
    header("Location: login.php");
    exit;
}

// --- Captura o ID do cliente logado ---
$id_cliente = $_SESSION['idusuario'];

// --- Verifica se o formulário foi enviado via POST ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // --- Coleta os dados enviados ---
    $estrela = $_POST['estrela'] ?? $_POST['avaliacao'] ?? 0; // aceita "estrela" ou "avaliacao"
    $comentario = trim($_POST['comentario'] ?? '');
    $barbeiro_id_barbeiro = $_POST['barbeiro_id'] ?? 0;
    $servico_id_servico = $_POST['servico_id'] ?? 0;

    // --- Validação ---
    if (empty($estrela) || empty($barbeiro_id_barbeiro) || empty($servico_id_servico)) {
        $_SESSION['mensagem'] = "⚠️ Preencha todos os campos obrigatórios da avaliação.";
        header("Location: ./cliente/index.php");
        exit;
    }

    // --- Upload de imagem (opcional) ---
    $foto = null;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $nome_arquivo = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $ext = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
        $permitidas = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($ext, $permitidas)) {
            $_SESSION['mensagem'] = "❌ Tipo de imagem inválido. Use JPG, PNG ou GIF.";
            header("Location: ./cliente/index.php");
            exit;
        }

        $novo_nome = uniqid('avaliacao_') . "." . $ext;
        $pasta = "./uploads/";
        if (!is_dir($pasta)) mkdir($pasta, 0755, true);
        $foto = $pasta . $novo_nome;

        if (!move_uploaded_file($tmp, $foto)) {
            $_SESSION['mensagem'] = "⚠️ Erro ao salvar a imagem.";
            header("Location: ./cliente/index.php");
            exit;
        }
    }

    // --- Salva a avaliação no banco ---
    $ok = salvarAvaliacao(
        $conexao,
        $estrela,
        $comentario,
        $barbeiro_id_barbeiro,
        $servico_id_servico,
        $foto,
        $id_cliente
    );

    $_SESSION['mensagem'] = $ok
        ? "✅ Avaliação registrada com sucesso!"
        : "❌ Erro ao salvar sua avaliação.";

    header("Location: ./cliente/index.php");
    exit;

} else {
    $_SESSION['mensagem'] = "⚠️ Acesso inválido.";
    header("Location: ./cliente/index.php");
    exit;
}
