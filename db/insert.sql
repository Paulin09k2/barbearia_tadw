USE `barbearia`;

-- 🔹 1. Inserir o Admin Supremo
INSERT INTO usuario (senha, email, tipo_usuario)
VALUES ("$2y$10$HSwrRIyAbu8vWGkmrq6DJeBi98hi5DCo1QkjxFajk6RPKModnYXSK", 'admin@barbearia.com', '2');
-- senha : admin123
SET @id_admin := LAST_INSERT_ID();

--INSERT INTO barbeiro (nome, telefone, cpf, data_nascimento, data_admissao, usuario_idusuario)
--VALUES ('Admin Supremo', '(11) 99999-9999', '00000000000', '1990-01-01', CURDATE(), @id_admin);

-- 🔹 2. Inserir os demais usuários
INSERT INTO usuario (senha, email, tipo_usuario) VALUES
('1234', 'joao@elite.com', '2'),   -- id = 2
('1234', 'maria@elite.com', '1'),  -- id = 3
('1234', 'pedro@elite.com', '2'),  -- id = 4
('1234', 'ana@elite.com', '1'),    -- id = 5
('1234', 'carlos@elite.com', '2'), -- id = 6
('1234', 'luiza@elite.com', '1'),  -- id = 7
('1234', 'rafael@elite.com', '2'), -- id = 8
('1234', 'juliana@elite.com', '1'),-- id = 9
('1234', 'marcos@elite.com', '2'), -- id = 10
('1234', 'camila@elite.com', '1'); -- id = 11

-- 🔹 3. Inserir barbeiros (vinculados aos usuários tipo 2)
INSERT INTO barbeiro (nome, telefone, cpf, data_nascimento, data_admissao, usuario_idusuario) VALUES
('João Silva', '62999999999', '11111111111', '1990-05-10', '2020-01-15', 2),
('Pedro Santos', '62988888888', '22222222222', '1988-03-22', '2019-03-10', 4),
('Carlos Lima', '62977777777', '33333333333', '1995-07-08', '2021-05-25', 6),
('Rafael Souza', '62966666666', '44444444444', '1992-09-12', '2022-02-14', 8),
('Marcos Almeida', '62955555555', '55555555555', '1985-11-30', '2018-08-01', 10);

-- 🔹 4. Inserir clientes (vinculados aos usuários tipo 1)
INSERT INTO cliente (nome, telefone, endereco, data_nascimento, usuario_idusuario) VALUES
('Maria Oliveira', '62999990000', 'Rua A, 123', '2000-04-12', 3),
('Ana Costa', '62988887777', 'Rua B, 45', '1998-10-05', 5),
('Luiza Pereira', '62977776666', 'Rua C, 88', '2001-02-25', 7),
('Juliana Souza', '62966665555', 'Rua D, 10', '1999-11-14', 9),
('Camila Silva', '62955554444', 'Rua E, 200', '2002-03-19', 11);

-- 🔹 5. Inserir serviços
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

-- 🔹 6. Inserir agendamentos (clientes 1–5 com barbeiros 1–5)
INSERT INTO agendamento (data_agendamento, status, cliente_id_cliente, barbeiro_id_barbeiro) VALUES
('2025-10-07 09:00:00', 'confirmado', 1, 1),
('2025-10-07 10:00:00', 'pendente', 2, 2),
('2025-10-07 11:00:00', 'confirmado', 3, 3),
('2025-10-07 12:00:00', 'cancelado', 4, 4),
('2025-10-07 13:00:00', 'pendente', 5, 5);

-- 🔹 7. Vincular serviços aos agendamentos
INSERT INTO agenda_servico (agendamento_id_agendamento, servico_id_servico) VALUES
(1, 1),
(2, 3),
(3, 2),
(4, 4),
(5, 5);

-- 🔹 8. Inserir avaliações
INSERT INTO avaliacao (estrela, comentario, foto, barbeiro_id_barbeiro, servico_id_servico, cliente_id_cliente) VALUES
(1, 'Atendimento ruim e demorado.', 'avaliacao1.jpg', 1, 1, 1),
(2, 'Corte razoável, mas poderia ser melhor.', 'avaliacao2.jpg', 2, 2, 2),
(3, 'Serviço ok, nada excepcional.', 'avaliacao3.jpg', 3, 3, 3),
(4, 'Bom atendimento e corte satisfatório.', 'avaliacao4.jpg', 4, 4, 4),
(5, 'Excelente serviço! Recomendo a todos.', 'avaliacao5.jpg', 5, 5, 5);
