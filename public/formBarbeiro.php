<?php
// Importa o arquivo de conexão com o banco de dados
require_once "./conexao.php";
// Importa funções auxiliares do sistema
require_once "./funcoes.php";
// Inicia a sessão para acessar informações do usuário logado
session_start();

// Pega o ID do usuário logado, se existir na sessão
$idusuario = $_SESSION['idusuario'] ?? null;

// Se o ID for enviado pela URL (GET), usa ele; senão, usa o ID da sessão
$id = isset($_GET['id']) ? $_GET['id'] : $idusuario;

// Busca no banco de dados as informações do barbeiro e do usuário pelo ID
$barbeiro = pesquisarBarbeiroId($conexao, $id);
$usuario = pesquisarUsuarioId($conexao, $id);

// Se encontrar o barbeiro e o usuário, significa que está editando
if ($barbeiro && $usuario) {
    $id = $barbeiro['id_barbeiro'];       // ID do barbeiro no banco
    $idusuario = $usuario['idusuario'];   // ID do usuário vinculado
    $nome = $barbeiro['nome'];            // Nome do barbeiro
    $email = $usuario['email'];           // E-mail cadastrado
    $telefone = $barbeiro['telefone'];    // Telefone do barbeiro
    $cpf = $barbeiro['cpf'];              // CPF do barbeiro
    $data_nascimento = $barbeiro['data_nascimento']; // Data de nascimento
    $data_admissao = $barbeiro['data_admissao'];     // Data de admissão na barbearia
    $senha_cliente = "";                  // Senha não é exibida por segurança
    $botao = "Editar";                    // Define o texto do botão como "Editar"
} else {
    // Se não encontrou registro, é um novo cadastro
    $id = 0;
    $nome = "";
    $email = "";
    $telefone = "";
    $cpf = "";
    $data_nascimento = "";
    $data_admissao = date('Y-m-d'); // Define a data atual como padrão
    $senha_cliente = "";
    $botao = "Cadastrar";            // Define o texto do botão como "Cadastrar"
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Ícone da página -->
    <link rel="icon" type="image/png" href="logo2.png">
    <!-- O título muda conforme o tipo de ação (Cadastrar/Editar) -->
    <title><?php echo $botao ?></title>
</head>

<body>
    <!-- Cabeçalho principal da página -->
    <h1><?php echo $botao ?> Barbeiro</h1>

    <!-- Formulário que envia os dados para salvarBarbeiro.php -->
    <form action="salvarBarbeiro.php" method="post" enctype="multipart/form-data">

        <!-- Campos ocultos com os IDs do barbeiro e usuário -->
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">

        <!-- Campo: Nome do barbeiro -->
        Nome: <br>
        <input type="text" name="nome" value="<?php echo $nome; ?>" required> <br><br>

        <!-- Campo: Email -->
        Email: <br>
        <input type="email" name="email" value="<?php echo $email; ?>" required> <br><br>

        <!-- Campo: Telefone -->
        Telefone: <br>
        <input type="text" name="telefone" value="<?php echo $telefone; ?>" required> <br><br>

        <!-- Campo: CPF -->
        Cpf: <br>
        <input type="text" name="cpf" value="<?php echo $cpf; ?>" maxlength="11" required> <br><br>

        <!-- Campo: Data de nascimento (limita para não aceitar datas futuras) -->
        Data de Nascimento: <br>
        <input type="date" name="data_nascimento" value="<?php echo $data_nascimento; ?>" required max="<?= date('Y-m-d') ?>"> <br><br>

        <!-- Campo: Data de admissão na barbearia -->
        Data de Admissao: <br>
        <input type="date" name="data" value="<?php echo $data_admissao; ?>" required><br><br>

        <!-- Campo: Senha (nunca pré-preenchida por segurança) -->
        Senha: <br>
        <input type="password" name="senha" value="" required> <br><br>

        <!-- Botão de envio do formulário -->
        <input type="submit" value="<?php echo $botao; ?>">
    </form>
</body>

</html>
