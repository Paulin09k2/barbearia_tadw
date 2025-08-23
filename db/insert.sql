-- ============================
-- 1) CLIENTES
-- ============================
INSERT INTO cliente (id_cliente, nome, email, telefone, endereco, data_nascimento, senha_cliente) VALUES
(1,'João Silva','joao.silva@email.com','11999990001','Rua A, 123','1990-05-10','123456'),
(2,'Maria Souza','maria.souza@email.com','11999990002','Rua B, 456','1985-08-21','senha123'),
(3,'Carlos Pereira','carlos.pereira@email.com','11999990003','Av. Central, 100','1992-11-15','senha456'),
(4,'Ana Oliveira','ana.oliveira@email.com','11999990004','Rua das Flores, 55','1995-02-02','senha789'),
(5,'Pedro Santos','pedro.santos@email.com','11999990005','Rua Nova, 321','1988-09-30','pedro123'),
(6,'Juliana Lima','juliana.lima@email.com','11999990006','Rua Verde, 12','1991-07-07','juliana321'),
(7,'Lucas Almeida','lucas.almeida@email.com','11999990007','Rua Azul, 900','1994-01-20','lucas456'),
(8,'Fernanda Costa','fernanda.costa@email.com','11999990008','Av. Paulista, 2000','1993-03-11','fernanda789'),
(9,'Bruno Rocha','bruno.rocha@email.com','11999990009','Rua São Paulo, 87','1996-06-25','bruno321'),
(10,'Patrícia Melo','patricia.melo@email.com','11999990010','Rua Minas, 500','1990-10-12','patricia123');

-- ============================
-- 2) BARBEIROS
-- ============================
INSERT INTO barbeiro (id_barbeiro, nome, email, telefone, cpf, data_nascimento, data_admissao, senha_barbeiro) VALUES
(1,'André Barbosa','andre.barbosa@barbearia.com','11988880001','12345678901','1987-04-15','2020-01-10','andre123'),
(2,'Rafael Gomes','rafael.gomes@barbearia.com','11988880002','12345678902','1990-06-20','2021-03-05','rafael456'),
(3,'Diego Martins','diego.martins@barbearia.com','11988880003','12345678903','1985-02-18','2019-07-12','diego789'),
(4,'Marcos Silva','marcos.silva@barbearia.com','11988880004','12345678904','1992-12-01','2022-09-01','marcos321'),
(5,'Felipe Araújo','felipe.araujo@barbearia.com','11988880005','12345678905','1993-05-25','2023-01-15','felipe123'),
(6,'Rodrigo Nunes','rodrigo.nunes@barbearia.com','11988880006','12345678906','1988-11-30','2018-04-10','rodrigo456'),
(7,'Eduardo Vieira','eduardo.vieira@barbearia.com','11988880007','12345678907','1991-09-22','2020-11-20','eduardo789'),
(8,'Thiago Ferreira','thiago.ferreira@barbearia.com','11988880008','12345678908','1989-07-14','2021-08-03','thiago321'),
(9,'Leandro Ramos','leandro.ramos@barbearia.com','11988880009','12345678909','1994-03-08','2022-02-25','leandro123'),
(10,'Gustavo Pires','gustavo.pires@barbearia.com','11988880010','12345678910','1990-10-10','2017-05-15','gustavo456');

-- ============================
-- 3) SERVIÇOS
-- ============================
INSERT INTO servico (id_servico, nome_servico, descricao, preco, tempo_estimado) VALUES
(1,'Corte Simples','Corte de cabelo básico',30.00,30),
(2,'Corte Degradê','Corte moderno com degradê',40.00,40),
(3,'Barba Completa','Aparar e modelar a barba',25.00,25),
(4,'Sobrancelha','Design de sobrancelha masculina',15.00,15),
(5,'Corte + Barba','Pacote completo corte e barba',50.00,60),
(6,'Hidratação Capilar','Tratamento com hidratação profunda',35.00,45),
(7,'Platinado','Descoloração e tonalização',120.00,120),
(8,'Pintura de Cabelo','Aplicação de tintura',80.00,90),
(9,'Relaxamento','Tratamento para soltar os fios',70.00,60),
(10,'Massagem Capilar','Massagem relaxante no couro cabeludo',20.00,20);

-- ============================
-- 4) AGENDAMENTOS
-- ============================
INSERT INTO agendamento (id_agendamento, data_agendamento, status, cliente_id_cliente, barbeiro_id_barbeiro) VALUES
(1,'2025-06-15 10:00:00','pendente',1,1),
(2,'2025-06-15 11:00:00','confirmado',2,2),
(3,'2025-06-16 09:30:00','cancelado',3,3),
(4,'2025-06-16 14:00:00','pendente',4,4),
(5,'2025-06-17 15:00:00','confirmado',5,5),
(6,'2025-06-17 16:00:00','pendente',6,6),
(7,'2025-06-18 13:00:00','confirmado',7,7),
(8,'2025-06-18 17:00:00','pendente',8,8),
(9,'2025-06-19 10:30:00','cancelado',9,9),
(10,'2025-06-19 11:30:00','confirmado',10,10);

-- ============================
-- 5) AGENDA_SERVICO
-- ============================
INSERT INTO agenda_servico (agendamento_id_agendamento, servico_id_servico) VALUES
(1,1),(1,3),
(2,2),
(3,5),
(4,1),(4,4),
(5,6),
(6,2),(6,3),
(7,7),
(8,8),
(9,9),
(10,5),(10,10);

-- ============================
-- 6) AVALIAÇÕES
-- ============================
INSERT INTO avaliacao (idavaliacao, estrela, comentario, barbeiro_id_barbeiro, servico_id_servico, foto) VALUES
(1,5,'Ótimo atendimento!',1,1,NULL),
(2,4,'Corte muito bom.',2,2,NULL),
(3,3,'Poderia ser mais rápido.',3,3,NULL),
(4,5,'Excelente trabalho!',4,5,NULL),
(5,4,'Gostei bastante.',5,6,NULL),
(6,2,'Não ficou como eu queria.',6,7,NULL),
(7,5,'Perfeito, recomendo!',7,8,NULL),
(8,3,'Regular, nada demais.',8,9,NULL),
(9,4,'Muito bom, voltarei.',9,10,NULL),
(10,5,'O melhor barbeiro da região!',10,1,NULL);
