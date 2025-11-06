<?php

// Importa o arquivo de conexão com o banco de dados (cria a variável $conexao).
require_once './conexao.php';

// Importa o arquivo com funções auxiliares (onde estão salvarBarbeiro e editarBarbeiro).
require_once './funcoes.php';

// Inicia ou continua a sessão (necessária para manter informações do usuário logado).
session_start();


// --- Captura dos dados enviados pelo formulário (método POST) ---

$id = $_POST['id'] ?? null;                 // ID do barbeiro (nulo = novo cadastro)
$idusuario = $_POST['idusuario'] ?? null;   // ID do usuário vinculado
$nome = trim($_POST['nome']);               // Nome do barbeiro
$email = trim($_POST['email']);             // E-mail (pode ser usado para login)
$telefone = trim($_POST['telefone']);       // Telefone do barbeiro
$data_nascimento = $_POST['data_nascimento']; // Data de nascimento
$data_admissao = $_POST['data'];            // Data de admissão (provavelmente data de contratação)
$senha = trim($_POST['senha']);             // Senha do barbeiro (caso seja usada para login)
$cpf = trim($_POST['cpf']);                 // CPF do barbeiro
$id_barbeiro = $id;                         // Define $id_barbeiro com o mesmo valor de $id (usado na função)


// Linha comentada — usada antes para depuração (mostrar o valor da variável).
// var_dump(value: $data_admissao);


// --- Verifica se o barbeiro já existe (edição) ou é novo (cadastro) ---
if ($id && $idusuario) {
  // ===== Editar barbeiro existente =====
  // Chama a função editarBarbeiro() passando os dados atualizados.
  $resposta = editarBarbeiro(
    $conexao,
    $nome,
    $telefone,
    $cpf,
    $data_nascimento,
    $data_admissao,
    $idusuario,
    $id_barbeiro
  );

} else {
  // ===== Cadastrar novo barbeiro =====
  // Chama salvarBarbeiro() com os dados recebidos do formulário.
  $resposta = salvarBarbeiro(
    $conexao,
    $nome,
    $telefone,
    $cpf,
    $data_nascimento,
    $data_admissao,
    $idusuario
  );
}


// --- Redireciona o usuário após salvar ou editar ---
header("Location: ./admin/index.php");
