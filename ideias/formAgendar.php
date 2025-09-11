<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agendamento</title>

</head>
<body>
  <form action="#" method="POST">
    <h2>Agendar Compromisso</h2>

    <label for="nome">Nome Completo</label>
    <input type="text" id="nome" name="nome" required>

    <br><label for="email">E-mail</label>
    <input type="email" id="email" name="email" required>

    <br><label for="telefone">Telefone</label>
    <input type="tel" id="telefone" name="telefone" required>

    <br><label for="data">Data do Agendamento</label>
    <input type="date" id="data" name="data" required>

    <br><label for="hora">Hora</label>
    <input type="time" id="hora" name="hora" required>

    <br><label for="servico">Serviço</label>
    <select id="servico" name="servico" required>
      <option value="">Selecione um serviço</option>
      <option value="consulta">CoDnsulta</option>
      <option value="retorno">Retorno</option>
      <option value="exame">Exame</option>
      <option value="outro">Outro</option>
    </select>

    <br><label for="observacoes">Observações</label><br>
    <textarea id="observacoes" name="observacoes" rows="4" ></textarea>

    <br><button type="submit">Confirmar Agendamento</button>
  </form>
</body>
</html>
