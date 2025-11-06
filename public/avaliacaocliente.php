<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"> <!-- Define o padrão de caracteres (suporte a acentos e cedilha) -->
    <title>Tabela de Avaliações</title> <!-- Título exibido na aba do navegador -->
</head>
<body>

<!-- Título principal da página -->
<h2>Lista de Avaliações</h2>

<!-- Criação da tabela com borda -->
<table border="1">
    <!-- Cabeçalho da tabela: define o nome das colunas -->
    <tr>
        <th>ID</th> <!-- Identificador da avaliação -->
        <th>Comentário</th> <!-- Texto da avaliação -->
        <th>Imagem</th> <!-- Imagem enviada junto à avaliação -->
        <th>Usuário</th> <!-- ID do usuário que fez a avaliação -->
        <th>Serviço</th> <!-- ID do serviço avaliado -->
        <th>Profissional</th> <!-- ID do barbeiro/profissional avaliado -->
    </tr>

    <!-- Linha 1: exemplo de avaliação -->
    <tr>
        <td>1</td> <!-- ID da avaliação -->
        <td>Atendimento ruim e demorado.</td> <!-- Comentário do cliente -->
        <td><img src="avaliacao1.jpg" alt="Avaliação 1" width="100"></td> <!-- Imagem pequena da avaliação -->
        <td>1</td> <!-- ID do usuário -->
        <td>1</td> <!-- ID do serviço -->
        <td>1</td> <!-- ID do profissional -->
    </tr>

    <!-- Linha 2 -->
    <tr>
        <td>2</td>
        <td>Corte razoável, mas poderia ser melhor.</td>
        <td><img src="avaliacao2.jpg" alt="Avaliação 2" width="100"></td>
        <td>2</td>
        <td>2</td>
        <td>2</td>
    </tr>

    <!-- Linha 3 -->
    <tr>
        <td>3</td>
        <td>Serviço ok, nada excepcional.</td>
        <td><img src="avaliacao3.jpg" alt="Avaliação 3" width="100"></td>
        <td>3</td>
        <td>3</td>
        <td>3</td>
    </tr>

    <!-- Linha 4 -->
    <tr>
        <td>4</td>
        <td>Bom atendimento e corte satisfatório.</td>
        <td><img src="avaliacao4.jpg" alt="Avaliação 4" width="100"></td>
        <td>4</td>
        <td>4</td>
        <td>4</td>
    </tr>

    <!-- Linha 5 -->
    <tr>
        <td>5</td>
        <td>Excelente serviço! Recomendo a todos.</td>
        <td><img src="avaliacao5.jpg" alt="Avaliação 5" width="100"></td>
        <td>5</td>
        <td>5</td>
        <td>5</td>
    </tr>
</table>

</body>
</html>
