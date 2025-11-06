<?php
// Importa o arquivo de conexão com o banco de dados (define a variável $conexao).
require_once './conexao.php';

// Importa o arquivo com funções auxiliares (onde estão as funções editarServico e salvarServico).
require_once './funcoes.php';

// Captura o valor enviado via formulário (POST) do campo id_servico, caso exista.
// Se não existir (null), significa que é um novo cadastro.
$id_servico = $_POST['id_servico'] ?? null;

// Captura e remove espaços extras do nome do serviço.
$nome_servico = trim($_POST['nome_servico']);

// Captura e remove espaços extras da descrição do serviço.
$descricao = trim($_POST['descricao']);

// Converte o valor do preço para número decimal (float).
$preco = floatval($_POST['preco']);

// Converte o tempo estimado para número inteiro.
$tempo_estimado = intval($_POST['tempo_estimado']);


// Verifica se existe um ID de serviço enviado — se sim, é uma **edição**, senão é um **novo cadastro**.
if ($id_servico) {

    // Atualiza o serviço existente chamando a função editarServico().
    // Essa função deve receber a conexão e os dados atualizados e executar o UPDATE no banco.
    $resposta = editarServico($conexao, $id_servico, $nome_servico, $descricao, $preco, $tempo_estimado);

} else {

    // Se não há ID, então é um novo serviço, e chamamos salvarServico().
    // Essa função deve executar o INSERT no banco com os dados informados.
    $resposta = salvarServico($conexao, $nome_servico, $descricao, $preco, $tempo_estimado);
}


// Exibe um alerta e redireciona para a página de serviços do painel admin.
echo "<script>alert('{$mensagem}'); window.location.href='./admin/servico.php';</script>";  // corrigir-------------------------------------------------------------
?>
