<!DOCTYPE html>
<!-- Define que o documento é HTML5 -->
<html lang="pt-BR">
<!-- Inicia o documento HTML e define o idioma como português do Brasil -->

<head>
  <!-- Cabeçalho do documento (informações não exibidas diretamente na página) -->

  <meta charset="UTF-8">
  <!-- Define o conjunto de caracteres como UTF-8 (suporta acentos e caracteres especiais) -->

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Faz a página se adaptar ao tamanho da tela (responsivo) -->

  <title>Serviços</title>
  <!-- Título que aparece na aba do navegador -->

  <style>
    /* Início do estilo interno da página */

    table {
      width: 100%;
      /* A tabela ocupa toda a largura da página */
      border-collapse: collapse;
      /* Remove os espaços entre as bordas das células */
      margin: 20px 0;
      /* Margem superior e inferior de 20px */
    }

    th, td {
      border: 1px solid #ddd;
      /* Cria bordas cinza claras nas células */
      padding: 8px;
      /* Espaçamento interno em cada célula */
      text-align: left;
      /* Alinha o texto à esquerda */
    }

    th {
      background-color: #f2f2f2;
      /* Define uma cor de fundo para o cabeçalho da tabela */
    }

    h1 {
      text-align: center;
      /* Centraliza o título na tela */
      color: #333;
      /* Define uma cor cinza escura para o texto */
    }
  </style>
</head>

<body>
  <!-- Corpo da página (conteúdo visível no navegador) -->

  <h1>Serviços</h1>
  <!-- Título principal da página -->

  <table>
    <!-- Início da tabela que lista os serviços -->

    <thead>
      <!-- Cabeçalho da tabela -->
      <tr>
        <!-- Linha do cabeçalho -->
        <th>Serviço</th>
        <th>Preço</th>
        <th>Tempo Estimado</th>
        <th>Descrição</th>
      </tr>
    </thead>

    <tbody>
      <!-- Corpo da tabela com os dados dos serviços -->

      <tr>
        <!-- Cada <tr> é uma linha da tabela -->
        <td>Barba Completa</td>
        <td>R$ 25,00</td>
        <td>20 min</td>
        <td>Aparar, desenhar e hidratar a barba.</td>
      </tr>

      <tr>
        <td>Corte + Barba</td>
        <td>R$ 50,00</td>
        <td>45 min</td>
        <td>Pacote completo de corte e barba.</td>
      </tr>

      <tr>
        <td>Corte Clássico</td>
        <td>R$ 35,00</td>
        <td>30 min</td>
        <td>Corte de cabelo tradicional masculino.</td>
      </tr>

      <tr>
        <td>Corte Degradê</td>
        <td>R$ 40,00</td>
        <td>35 min</td>
        <td>Corte moderno com transição suave.</td>
      </tr>

      <tr>
        <td>Hidratação Capilar</td>
        <td>R$ 30,00</td>
        <td>25 min</td>
        <td>Tratamento capilar completo.</td>
      </tr>

      <tr>
        <td>Luzes Masculinas</td>
        <td>R$ 70,00</td>
        <td>60 min</td>
        <td>Mechas sutis e modernas.</td>
      </tr>

      <tr>
        <td>Pezinho</td>
        <td>R$ 10,00</td>
        <td>5 min</td>
        <td>Acabamento rápido e preciso.</td>
      </tr>

      <tr>
        <td>Pintura Capilar</td>
        <td>R$ 60,00</td>
        <td>50 min</td>
        <td>Coloração capilar masculina.</td>
      </tr>

      <tr>
        <td>Relaxamento</td>
        <td>R$ 45,00</td>
        <td>40 min</td>
        <td>Tratamento para reduzir o volume do cabelo.</td>
      </tr>

      <tr>
        <td>Sobrancelha</td>
        <td>R$ 15,00</td>
        <td>10 min</td>
        <td>Design masculino com navalha.</td>
      </tr>
    </tbody>
  </table>

  <!-- Link simples que leva o usuário de volta à página inicial -->
  <a href="index.php">Sair</a>

</body>
</html>
