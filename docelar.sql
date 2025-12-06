use docelar;
CREATE TABLE USUARIO (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    cidade VARCHAR(50) NOT NULL,
    estado CHAR(2) NOT NULL,
    tipo_usuario ENUM('Adotante', 'ONG') NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE ANIMAL (

    id_animal INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    especie ENUM('Cachorro', 'Gato', 'Outro') NOT NULL,
    sexo ENUM('Macho', 'Fêmea') NOT NULL,
    data_nascimento DATE, 
    porte ENUM('Pequeno', 'Médio', 'Grande') NOT NULL,
    raca VARCHAR(50),
    descricao TEXT,
    status_adocao ENUM('Disponível', 'Reservado', 'Adotado') NOT NULL DEFAULT 'Disponível',
    cidade VARCHAR(50) NOT NULL,
    estado CHAR(2) NOT NULL,
    id_ong_abrigo INT NOT NULL, -- FK para o USUARIO (ONG/Abrigo) responsável
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (id_ong_abrigo) REFERENCES USUARIO(id_usuario)
);

ALTER TABLE ANIMAL ADD COLUMN foto VARCHAR(255);

CREATE TABLE RESERVA (
    id_reserva INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_animal INT NOT NULL,
    data_reserva TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES USUARIO(id_usuario),
    FOREIGN KEY (id_animal) REFERENCES ANIMAL(id_animal)
);


INSERT INTO ANIMAL
(nome, especie, sexo, data_nascimento, porte, raca, descricao, status_adocao, cidade, estado, id_ong_abrigo, data_cadastro, foto)
VALUES
('Sansão', 'Cachorro', 'Macho', '2019-02-05', 'Grande', 'Rottweiler',
'Dócil com pessoas, carinhoso, gosta muito de brincar, porém não se dá bem com outros cachorros.',
'Disponível', 'Nova Iguaçu', 'RJ', 4, '2025-12-03 08:12:25', 'uploads/img_69301b1983a2f9.31218412.jpg'),

('Pituca', 'Cachorro', 'Fêmea', '2020-07-06', 'Médio', 'Vira Lata',
'Brincalhona, muito divertida e gosta de dormir bastante.',
'Disponível', 'Nilópolis', 'RJ', 4, '2025-12-03 08:21:54', 'uploads/img_69301d52a94865.23741161.jpg'),

('SOL', 'Cachorro', 'Fêmea', '2017-01-01', 'Médio', 'Não informado',
'Calma, já é uma senhorinha mas adora brincar, não desgruda da Lua(Filha dela).',
'Disponível', 'Belo Horizonte', 'MG', 5, '2025-12-03 08:41:49', 'uploads/img_693021fd782805.58602295.jpg'),

('Lua', 'Cachorro', 'Fêmea', '2022-11-22', 'Pequeno', 'Não informado',
'Tímida, tem um pouco de medo de barulhos altos, mas se chegar com calma ela ama carinho. Vive acompanhada da Sol(Sua Mãe).',
'Disponível', 'Belo Horizonte', 'MG', 5, '2025-12-03 08:45:22', 'uploads/img_693022d2aa5395.38215221.jpg');

INSERT INTO USUARIO 
(id_usuario, nome, email, senha_hash, telefone, cidade, estado, tipo_usuario, data_cadastro)
VALUES
(4, 'SOS Dog', 'SosdogONG@gmail.com',
'$2y$10$oVGJHXMPitsrTqPwIbeB9.sD3Rbm8rbUeT1U8.uIwt.xdJHDSIoTq',
'41 974490395', 'São Paulo', 'SP', 'ONG', '2025-12-03 08:09:11'),

(5, 'CEFET Animal', 'CEFETAnimal@gmail.com',
'$2y$10$4lYNmNXUeOwivOWYkTTZ0uhe9CJyTzoIJ9IPRFCUfyM6WxKdrZLkq',
'31 988785467', 'Belo Horizonte', 'MG', 'ONG', '2025-12-03 08:37:36');


-- Índices para otimização de consultas
-- -----------------------------------------------------
CREATE INDEX idx_usuario_email ON USUARIO (email);
CREATE INDEX idx_animal_status ON ANIMAL (status_adocao);
CREATE INDEX idx_animal_localizacao ON ANIMAL (cidade, estado);
CREATE INDEX idx_adocao_status ON ADOCAO (status_transacao);


select * from usuario;
select * from animal;
SELECT nome, foto FROM ANIMAL WHERE id_animal = 1;
delete from animal where id_animal=3;
SET FOREIGN_KEY_CHECKS = 0;
SET FOREIGN_KEY_CHECKS = 1;

