<?php
// Importa o arquivo de conexão com o banco de dados
require_once "./conexao.php";
// Importa o arquivo com funções auxiliares
require_once "./funcoes.php";
// Inicia a sessão para acessar variáveis de usuário logado
session_start();

// Obtém o ID do usuário logado, se existir na sessão
$idusuario = $_SESSION['idusuario'] ?? null;

// Se houver um ID passado via URL (GET), usa ele; senão, usa o ID da sessão
$id = isset($_GET['id']) ? $_GET['id'] : $idusuario;

// Busca os dados do usuário e do cliente no banco pelo ID
$usuario = pesquisarUsuarioId($conexao, $id);
$cliente = pesquisarClienteId($conexao, $id);

// Se o cliente e o usuário existirem, significa que está editando um cadastro
if ($cliente && $usuario) {
    $id = $cliente['id_cliente'];        // ID do cliente
    $idusuario = $usuario['idusuario'];  // ID do usuário vinculado
    $nome = $cliente['nome'];            // Nome do cliente
    $email = $usuario['email'];          // E-mail cadastrado
    $telefone = $cliente['telefone'];    // Telefone do cliente
    $endereco = $cliente['endereco'];    // Endereço do cliente
    $data_nascimento = $cliente['data_nascimento']; // Data de nascimento
    $data_cadastro = $cliente['data_cadastro'];     // Data de cadastro original
    $senha_cliente = "";                 // A senha não é exibida por segurança
    $botao = "Editar";                   // Define o texto do botão
    $id = $cliente['id_cliente'];
    $idusuario = $usuario['idusuario'];
    $nome = $cliente['nome'];
    $email = $usuario['email'];
    $telefone = $cliente['telefone'];
    $endereco = $cliente['endereco'];
    $data_nascimento = $cliente['data_nascimento'];
    $data_cadastro = $cliente['data_cadastro'];
    $senha_cliente = "";
    $botao = "Editar";
} else {
    // Se não existir cadastro, define valores padrão (modo cadastro)
    $id = 0;
    $nome = "";
    $email = "";
    $telefone = "";
    $endereco = "";
    $data_nascimento = "";
    $data_cadastro = date('Y-m-d');  // Usa a data atual
    $senha_cliente = "";
    $botao = "Cadastrar";            // Define o texto do botão
}
?>

