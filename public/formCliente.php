<?php
require_once "./conexao.php";
require_once "./funcoes.php";
session_start();

$idusuario = $_SESSION['idusuario'] ?? null;

// Se não vier um ID via GET, usa o ID da sessão
$id = isset($_GET['id']) ? $_GET['id'] : $idusuario;

// Busca os dados do cliente e do usuário
$usuario = pesquisarUsuarioId($conexao, $id);
$cliente = pesquisarClienteId($conexao, $id);

if ($cliente && $usuario) {
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
    $id = 0;
    $nome = "";
    $email = "";
    $telefone = "";
    $endereco = "";
    $data_nascimento = "";
    $data_cadastro = date('Y-m-d');
    $senha_cliente = "";
    $botao = "Cadastrar";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="logo2.png">
    <title><?php echo $botao ?></title>

    <style>
        /* Reset de margem e definição do fundo gradiente */
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #050d18, #0f1f33);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        /* Container do formulário com fundo escuro e sombra */
        .form-container {
            background-color: #0b1623;
            padding: 40px;
            border-radius: 20px;
            width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
        }

        /* Estilo do título principal */
        h1 {
            text-align: center;
            margin-bottom: 25px;
            color: #fff;
        }

        /* Estilo das labels dos campos */
        label {
            font-weight: bold;
            font-size: 14px;
            color: #dcdcdc;
            display: block;
            margin-bottom: 8px;
        }

        /* Estilo comum para todos os campos de input */
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"] {
            width: 100%;
            padding: 12px 18px;
            border-radius: 30px;
            border: none;
            background-color: #e8ebf0;
            margin-bottom: 20px;
            font-size: 15px;
            outline: none;
            transition: box-shadow 0.3s;
        }

        /* Efeito de foco nos campos */
        input:focus {
            box-shadow: 0 0 0 2px #f5c400;
        }

        /* Estilo do botão de submit */
        input[type="submit"] {
            width: 100%;
            padding: 14px;
            border-radius: 30px;
            border: none;
            background: linear-gradient(to right, #f5c400, #d4a100);
            color: #000;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        /* Efeito hover no botão */
        input[type="submit"]:hover {
            transform: scale(1.03);
            background: linear-gradient(to right, #ffd84d, #e6b800);
        }

        /* Estilo dos links */
        a {
            text-decoration: none;
            color: #c9c9c9;
            display: inline-block;
            margin-top: 10px;
            font-size: 14px;
        }

        /* Efeito hover nos links */
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1><?php echo $botao ?> Cliente</h1>

        <form action="salvarCliente.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">

            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo $nome; ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $email; ?>" required>

            <label>Telefone:</label>
            <input type="text" name="telefone" value="<?php echo $telefone; ?>" required>

            <label>Endereço:</label>
            <input type="text" name="endereco" value="<?php echo $endereco; ?>" required>

            <label>Data de Nascimento:</label>
            <input type="date" name="data_nascimento" value="<?php echo $data_nascimento; ?>" required max="<?= date('Y-m-d') ?>">

            <input type="hidden" name="data_cadastro" value="<?php echo $data_cadastro; ?>" required>

            <label>Senha:</label>
            <input
                type="password"
                name="senha_cliente"
                id="senha_cliente"
                placeholder="Senha"
                required
                onclick="this.type = this.type === 'password' ? 'text' : 'password';"
            >

            <input type="submit" value="<?php echo $botao; ?>">
        </form>
    </div>
</body>
</html>
