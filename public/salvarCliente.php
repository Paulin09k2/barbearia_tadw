<?php
// Importa o arquivo de conexão com o banco de dados (define $conexao).
require_once "./conexao.php";

// Importa o arquivo com as funções auxiliares (como salvarUsuario, salvarCliente, etc.).
require_once "./funcoes.php";

// --- Coleta os dados enviados via formulário (método POST) ---
$id = $_POST['id'];                         // ID do cliente (0 = novo cadastro)
$nome = $_POST['nome'];                     // Nome do cliente
$email = $_POST['email'];                   // E-mail do cliente
$telefone = $_POST['telefone'];             // Telefone
$endereco = $_POST['endereco'];             // Endereço
$data_nascimento = $_POST['data_nascimento']; // Data de nascimento
$data_cadastro = $_POST['data_cadastro'];     // Data de cadastro
$senha_cliente = $_POST['senha_cliente'];     // Senha do cliente
$idusuario = $_POST['idusuario'];             // ID do usuário vinculado (em caso de atualização)

if($senha_cliente == ""){
    $_SESSION['erro']="Senha não pode ser vazia";
    header("Location: ./cadastroCliente.php");
}
// --- Verifica se é um novo cadastro ou atualização ---
if ($id == 0) {
    // ===== Novo cadastro =====

    // Primeiro, cria o registro na tabela de usuários.
    // O terceiro parâmetro ('1') indica o tipo de usuário (1 = cliente).
    $usuario = salvarUsuario($conexao, $email, $senha_cliente, '1');
    
    // Se a criação do usuário falhar, exibe mensagem de erro.
    if ($usuario === null) {
        echo "<script>alert('Erro ao salvar usuário.');</script>";
    } else {
        // Se o usuário foi criado com sucesso, guarda o ID retornado.
        $idusuario = $usuario;

        // Agora cria o registro do cliente vinculado ao ID do usuário.
        salvarCliente(
            $conexao,
            $nome,
            $telefone,
            $endereco,
            $data_nascimento,
            $data_cadastro,
            $idusuario
        );
    }

    // Após o cadastro, redireciona para a página inicial.
    header("Location: index.php");

} else {
    // ===== Atualização de cadastro =====

    // Atualiza os dados do usuário (tabela de login/usuário).
    $usuario = editarUsuario($conexao, $email, $senha_cliente, 1, $idusuario);

    // Atualiza os dados do cliente (informações pessoais).
    editarCliente(
        $conexao,
        $nome,
        $telefone,
        $endereco,
        $data_nascimento,
        $idusuario
    );

    // Após atualizar, redireciona para o painel do cliente.
    header("Location: ./cliente/index.php");
}

// Encerra o script completamente (garante que nada mais será executado).
exit;
