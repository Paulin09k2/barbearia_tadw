<?php
// Importa o arquivo de conexão com o banco de dados
require_once "conexao.php";

// Importa o arquivo com as funções auxiliares
require_once "funcoes.php";

// Inicia a sessão para usar variáveis globais de sessão
session_start();

// Verifica se o formulário foi enviado via método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Captura a avaliação enviada pelo formulário (quantidade de estrelas, por exemplo)
    $avaliacoes = $_POST['avaliacao'] ?? null;

    // Captura o comentário textual do formulário
    $comentario = $_POST['comentario'] ?? '';

    // Captura o ID do usuário que fez a avaliação
    $idusuario = $_POST['idusuario'] ?? null;

    // Verifica se os campos obrigatórios foram preenchidos
    if (!$avaliacoes || !$idusuario) {
        // Interrompe a execução se faltar algum dado essencial
        die("Avaliação ou usuário não informado.");
    }

    // Verifica se um arquivo de imagem foi enviado junto com o formulário
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        // Armazena o nome original do arquivo
        $nome_arquivo = $_FILES['foto']['name'];

        // Armazena o caminho temporário onde o PHP guarda o arquivo até ser movido
        $caminho_temporario = $_FILES['foto']['tmp_name'];

        // Extrai a extensão do arquivo (por exemplo, jpg, png, gif)
        $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));

        // Lista de extensões de imagem permitidas
        $extensoes_validas = ['jpg', 'jpeg', 'png', 'gif'];

        // Verifica se a extensão do arquivo é válida
        if (!in_array($extensao, $extensoes_validas)) {
            // Interrompe a execução se o tipo de arquivo for inválido
            die("Extensão de arquivo inválida. Apenas JPG, PNG e GIF são permitidos.");
        }

        // Cria um novo nome único para o arquivo para evitar conflitos
        $novo_nome = uniqid() . "." . $extensao;

        // Define a pasta onde o arquivo será salvo
        $caminho_pasta = "./img/avaliacao/";

        // Verifica se a pasta de destino existe
        if (!is_dir($caminho_pasta)) {
            // Cria a pasta se ela não existir, com permissões adequadas
            if (!mkdir($caminho_pasta, 0755, true)) {
                // Interrompe caso ocorra erro ao criar a pasta
                die("Erro ao criar a pasta de destino.");
            }
        }

        // Verifica se a pasta tem permissão de escrita
        if (!is_writable($caminho_pasta)) {
            // Interrompe se a pasta não permitir salvar arquivos
            die("A pasta '$caminho_pasta' não tem permissão de escrita.");
        }

        // Define o caminho completo onde o arquivo será armazenado
        $caminho_destino = $caminho_pasta . $novo_nome;

        // Move o arquivo da pasta temporária para a pasta de destino
        if (!move_uploaded_file($caminho_temporario, $caminho_destino)) {
            // Interrompe se ocorrer erro ao mover o arquivo
            die("Erro ao mover o arquivo para a pasta de destino.");
        }

    } else {
        // Caso nenhum arquivo tenha sido enviado, define o caminho como nulo
        $caminho_destino = null;
    }

    // Chama a função responsável por salvar a avaliação no banco de dados
    // Passa as informações necessárias (nota, comentário, barbeiro, serviço, etc.)
    salvarAvaliacao(
        $conexao,
        $avaliacoes,
        $comentario,
        $_POST['barbeiro_id_barbeiro'] ?? null,
        $_POST['servico_id_servico'] ?? null,
        $caminho_destino,
        $idusuario
    );

    // Redireciona o usuário de volta para a página principal após salvar
    header("Location: ./cliente/index.php");
    exit;

} else {
    // Caso o acesso ao arquivo não seja feito por POST, exibe mensagem de erro 
    die("Acesso inválido.");
}
?>