<?php
require_once "conexao.php";
require_once "funcoes.php";
session_start();

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $avaliacoes = $_POST['avaliacao'] ?? null;
    $comentario = $_POST['comentario'] ?? '';
    $idusuario = $_POST['idusuario'] ?? null;

    if (!$avaliacoes || !$idusuario) {
        die("Avaliação ou usuário não informado.");
    }

    // Verifica se um arquivo foi enviado
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $nome_arquivo = $_FILES['foto']['name'];
        $caminho_temporario = $_FILES['foto']['tmp_name'];

        // pegar a extensão do arquivo e validar
        $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
        $extensoes_validas = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($extensao, $extensoes_validas)) {
            die("Extensão de arquivo inválida. Apenas JPG, PNG e GIF são permitidos.");
        }

        // gerar um novo nome único
        $novo_nome = uniqid() . "." . $extensao;

        // pasta de destino
        $caminho_pasta = "./img/avaliacao/";

        // Verifica se a pasta existe, se não, cria
        if (!is_dir($caminho_pasta)) {
            if (!mkdir($caminho_pasta, 0755, true)) {
                die("Erro ao criar a pasta de destino.");
            }
        }

        // verifica se a pasta tem permissão de escrita
        if (!is_writable($caminho_pasta)) {
            die("A pasta '$caminho_pasta' não tem permissão de escrita.");
        }

        $caminho_destino = $caminho_pasta . $novo_nome;

        // Move o arquivo para a pasta de destino
        if (!move_uploaded_file($caminho_temporario, $caminho_destino)) {
            die("Erro ao mover o arquivo para a pasta de destino.");
        }

    } else {
        // Se nenhum arquivo enviado, define como NULL
        $caminho_destino = null;
    }

    // Salva a avaliação no banco
    // Aqui você deve ajustar os parâmetros de acordo com sua função
    salvarAvaliacao(
    $conexao,
    $estrela,
    $comentario,
    $barbeiro_id_barbeiro,
    $servico_id_servico,
    $foto
);

    // Redireciona após salvar
    header("Location: ./cliente/index.php");
    exit;

} else {
    die("Acesso inválido.");
}
