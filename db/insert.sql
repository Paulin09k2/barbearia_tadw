
USE `barbearia` ;
INSERT INTO usuario (senha, email, tipo_usuario) VALUES
('1234', 'joao@elite.com', '2'),
('1234', 'maria@elite.com', '1'),
('1234', 'pedro@elite.com', '2'),
('1234', 'ana@elite.com', '1'),
('1234', 'carlos@elite.com', '2'),
('1234', 'luiza@elite.com', '1'),
('1234', 'rafael@elite.com', '2'),
('1234', 'juliana@elite.com', '1'),
('1234', 'marcos@elite.com', '2'),
('1234', 'camila@elite.com', '1');

INSERT INTO barbeiro (nome, telefone, cpf, data_nascimento, data_admissao, usuario_idusuario) VALUES
('João Silva', '62999999999', '11111111111', '1990-05-10', '2020-01-15', 1),
('Pedro Santos', '62988888888', '22222222222', '1988-03-22', '2019-03-10', 3),
('Carlos Lima', '62977777777', '33333333333', '1995-07-08', '2021-05-25', 5),
('Rafael Souza', '62966666666', '44444444444', '1992-09-12', '2022-02-14', 7),
('Marcos Almeida', '62955555555', '55555555555', '1985-11-30', '2018-08-01', 9),
('Tiago Rocha', '62944444444', '66666666666', '1993-01-18', '2021-01-20', 1),
('André Costa', '62933333333', '77777777777', '1996-04-05', '2023-03-12', 3),
('Lucas Pereira', '62922222222', '88888888888', '1998-10-22', '2022-07-15', 5),
('Gustavo Nunes', '62911111111', '99999999999', '1991-02-17', '2020-09-01', 7),
('Eduardo Melo', '62900000000', '00000000000', '1994-06-25', '2024-04-10', 9);

INSERT INTO cliente (nome, telefone, endereco, data_nascimento, usuario_idusuario) VALUES
('Maria Oliveira', '62999990000', 'Rua A, 123', '2000-04-12', 2),
('Ana Costa', '62988887777', 'Rua B, 45', '1998-10-05', 4),
('Luiza Pereira', '62977776666', 'Rua C, 88', '2001-02-25', 6),
('Juliana Souza', '62966665555', 'Rua D, 10', '1999-11-14', 8),
('Camila Silva', '62955554444', 'Rua E, 200', '2002-03-19', 10),
('Paulo Lima', '62944443333', 'Rua F, 32', '1997-07-09', 2),
('Rodrigo Rocha', '62933332222', 'Rua G, 99', '1996-12-01', 4),
('Fernanda Nunes', '62922221111', 'Rua H, 15', '2003-09-21', 6),
('Beatriz Melo', '62911110000', 'Rua I, 67', '1995-06-02', 8),
('Guilherme Santos', '62900009999', 'Rua J, 21', '2000-08-18', 10);

INSERT INTO agendamento (data_agendamento, status, cliente_id_cliente, barbeiro_id_barbeiro) VALUES
('2025-10-07 09:00:00', 'confirmado', 1, 1),
('2025-10-07 10:00:00', 'pendente', 2, 2),
('2025-10-07 11:00:00', 'confirmado', 3, 3),
('2025-10-07 12:00:00', 'cancelado', 4, 4),
('2025-10-07 13:00:00', 'pendente', 5, 5),
('2025-10-07 14:00:00', 'confirmado', 6, 1),
('2025-10-07 15:00:00', 'confirmado', 7, 2),
('2025-10-07 16:00:00', 'pendente', 8, 3),
('2025-10-07 17:00:00', 'confirmado', 9, 4),
('2025-10-07 18:00:00', 'pendente', 10, 5);

INSERT INTO servico (nome_servico, descricao, preco, tempo_estimado) VALUES
('Corte Clássico', 'Corte de cabelo tradicional masculino', 35.00, 30),
('Barba Completa', 'Aparar, desenhar e hidratar a barba', 25.00, 20),
('Corte Degradê', 'Corte moderno com transição suave', 40.00, 35),
('Sobrancelha', 'Design masculino com navalha', 15.00, 10),
('Hidratação Capilar', 'Tratamento capilar completo', 30.00, 25),
('Pezinho', 'Acabamento rápido e preciso', 10.00, 5),
('Relaxamento', 'Tratamento para reduzir o volume do cabelo', 45.00, 40),
('Pintura Capilar', 'Coloração capilar masculina', 60.00, 50),
('Luzes Masculinas', 'Mechas sutis e modernas', 70.00, 60),
('Corte + Barba', 'Pacote completo de corte e barba', 50.00, 45);

INSERT INTO agenda_servico (agendamento_id_agendamento, servico_id_servico) VALUES
(1, 1),
(2, 3),
(3, 2),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

INSERT INTO avaliacao (estrela, comentario, barbeiro_id_barbeiro, servico_id_servico, foto) VALUES
(5, 'Excelente atendimento!', 1, 1, 'foto1.jpg'),
(4, 'Corte muito bom, mas demorou um pouco.', 2, 3, 'foto2.jpg'),
(5, 'Barba impecável!', 3, 2, 'foto3.jpg'),
(3, 'Esperava mais do corte.', 4, 4, 'foto4.jpg'),
(5, 'Atendimento top!', 5, 5, 'foto5.jpg'),
(4, 'Muito bom serviço.', 1, 6, 'foto6.jpg'),
(5, 'Melhor barbeiro da cidade!', 2, 7, 'foto7.jpg'),
(3, 'Preço alto, mas bom resultado.', 3, 8, 'foto8.jpg'),
(4, 'Gostei do corte e do ambiente.', 4, 9, 'foto9.jpg'),
(5, 'Perfeito como sempre!', 5, 10, 'foto10.jpg');
