<?php
// Inclui o arquivo de conexão com o banco de dados
require_once "./conexao.php";
// Inclui o arquivo com funções auxiliares do sistema
require_once "./funcoes.php";
// Inicia a sessão (necessário para acessar dados de login)
session_start();

// Pega o ID do usuário logado, se existir na sessão
$idusuario = $_SESSION['idusuario'] ?? null;

// Se vier um ID pela URL (via GET), usa ele; senão, usa o ID da sessão
$id = isset($_GET['id']) ? $_GET['id'] : $idusuario;

// Busca no banco os dados do usuário e do cliente
$usuario = pesquisarUsuarioId($conexao, $id);
$cliente = pesquisarClienteId($conexao, $id);

// Se encontrou o cliente e o usuário, significa que é uma edição
if ($cliente && $usuario) {
    $id = $cliente['id_cliente'];             // ID do cliente
    $idusuario = $usuario['idusuario'];       // ID do usuário vinculado
    $nome = $cliente['nome'];                 // Nome do cliente
    $email = $usuario['email'];               // E-mail do usuário (vem da tabela de usuários)
    $telefone = $cliente['telefone'];         // Telefone do cliente
    $endereco = $cliente['endereco'];         // Endereço do cliente
    $data_nascimento = $cliente['data_nascimento']; // Data de nascimento
    $data_cadastro = $cliente['data_cadastro'];     // Data de cadastro
    $senha_cliente = "";                      // Nunca exibir a senha real por segurança
    $botao = "Editar";                        // Define o texto do botão como “Editar”
} else {
    // Caso contrário, é um novo cadastro
    $id = 0;
    $nome = "";
    $email = "";
    $telefone = "";
    $endereco = "";
    $data_nascimento = "";
    $data_cadastro = date('Y-m-d');           // Define a data atual como data de cadastro
    $senha_cliente = "";
    $botao = "Cadastrar";                     // Define o texto do botão como “Cadastrar”
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8"> <!-- Define o conjunto de caracteres como UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsivo em dispositivos móveis -->
    <link rel="icon" type="image/png" href="5.png"> <!-- Ícone da aba do navegador -->
    <title><?php echo $botao ?> Cliente</title> <!-- O título muda dinamicamente entre “Cadastrar” e “Editar” -->

    <style>
        /* ======= ESTILO BARBEARIA ELITE ======= */

        /* Importa a fonte “Inter” do Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

        /* Estilos do corpo da página */
        body {
            font-family: 'Inter', sans-serif; /* Define a fonte */
            background: radial-gradient(circle at top right, #101418, #060b10); /* Fundo degradê escuro */
            color: #fff; /* Texto branco */
            margin: 0; /* Remove margens padrão */
            padding: 0; /* Remove espaçamento interno padrão */
            min-height: 100vh; /* Ocupa toda a altura da tela */
            display: flex; /* Usa flexbox para centralizar */
            justify-content: center; /* Centraliza horizontalmente */
            align-items: center; /* Centraliza verticalmente */
        }

        /* Caixa principal do formulário */
        .container {
            background-color: #0f1a27; /* Fundo azul escuro */
            padding: 40px 50px; /* Espaçamento interno */
            border-radius: 20px; /* Bordas arredondadas */
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.4); /* Sombra */
            width: 100%; /* Largura total até o máximo */
            max-width: 420px; /* Limite de largura */
        }

        /* Título do formulário */
        h1 {
            text-align: center; /* Centraliza o texto */
            color: #ffffff; /* Cor branca */
            margin-bottom: 25px; /* Espaçamento inferior */
            letter-spacing: 1px; /* Espaçamento entre letras */
        }

        /* Rótulos dos campos */
        label {
            font-weight: 600; /* Deixa em negrito */
            color: #e1e1e1; /* Cinza claro */
            display: block; /* Ocupa linha inteira */
            margin-bottom: 8px; /* Espaçamento abaixo */
        }

        /* Campos de entrada */
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"] {
            width: 100%; /* Largura total */
            padding: 14px 18px; /* Espaçamento interno */
            border-radius: 30px; /* Bordas arredondadas */
            border: none; /* Sem borda */
            outline: none; /* Remove contorno ao focar */
            background: #e1e5ea; /* Fundo cinza claro */
            color: #1a1a1a; /* Texto escuro */
            font-size: 15px; /* Tamanho da fonte */
            transition: 0.3s; /* Animação suave */
            margin-bottom: 18px; /* Espaçamento inferior */
        }

        /* Efeito ao focar no campo */
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="date"]:focus {
            background: #ffffff; /* Muda fundo para branco */
            box-shadow: 0 0 0 3px #2a5bba; /* Destaque azul */
        }

        /* Botão de enviar */
        input[type="submit"] {
            width: 105%; /* Largura total */
            padding: 14px; /* Espaçamento interno */
            border: none; /* Sem borda */
            border-radius: 30px; /* Bordas arredondadas */
            background-color: #e1e5ea; /* Cor clara */
            color: #0f1a27; /* Texto escuro */
            font-weight: 700; /* Negrito */
            font-size: 16px; /* Tamanho do texto */
            cursor: pointer; /* Muda o cursor ao passar */
            transition: all 0.3s ease; /* Animação */
        }

        /* Efeito hover no botão */
        input[type="submit"]:hover {
            background-color: #ffffff; /* Fica mais claro */
            transform: scale(1.02); /* Aumenta levemente */
        }

        /* Placeholder (texto dentro do input) */
        input::placeholder {
            color: #7a7a7a; /* Cinza médio */
        }

        /* Responsividade (para telas pequenas) */
        @media (max-width: 500px) {
            .container {
                padding: 30px;
                border-radius: 15px;
            }
        }

        /* Estilo do link "voltar" */
        a {
            display: block; /* Quebra linha */
            text-align: center; /* Centraliza */
            color: #b3b3b3; /* Cor cinza */
            text-decoration: none; /* Remove sublinhado */
            font-size: 14px;
            transition: 0.3s;
        }

        a:hover {
            color: #ffffff; /* Fica branco ao passar o mouse */
        }
    </style>
</head>

<body>
    <!-- Container principal do formulário -->
    <div class="container">
        <!-- Título muda dinamicamente (Cadastrar/Editar Cliente) -->
        <h1><?php echo $botao ?> Cliente</h1>

        <!-- Formulário que envia dados para salvarCliente.php -->
        <form action="salvarCliente.php" method="post" enctype="multipart/form-data">

            <!-- Campos ocultos com IDs -->
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">

            <!-- Campo: Nome -->
            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo $nome; ?>" placeholder="Nome" required>

            <!-- Campo: Email -->
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $email; ?>" placeholder="E-mail" required>

            <!-- Campo: Telefone -->
            <label>Telefone:</label>
            <input type="text" name="telefone" id="telefone" maxlength="15" value="<?php echo $telefone; ?>" placeholder="(00) 00000-0000" required>

            <!-- Campo: Endereço -->
            <label>Endereço:</label>
            <input type="text" name="endereco" value="<?php echo $endereco; ?>" placeholder="Endereço" required>

            <!-- Campo: Data de nascimento -->
            <label>Data de Nascimento:</label>
            <input type="date" name="data_nascimento" value="<?php echo $data_nascimento; ?>" required max="<?= date('Y-m-d') ?>">

            <!-- Campo oculto: Data de cadastro -->
            <input type="hidden" name="data_cadastro" value="<?php echo $data_cadastro; ?>">

            <!-- Campo: Senha -->
            <label>Senha:</label>
            <input type="password" name="senha_cliente" value="" placeholder="XXXX" required>

            <!-- Botão de enviar -->
            <input type="submit" value="<?php echo $botao; ?>">
            

            <!-- Link para voltar à tela de login -->
             <br><br>
            <a href="login.php">Voltar</a>
        </form>
    </div>
</body>

</html>
