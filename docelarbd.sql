CREATE DATABASE docelar;
use docelar;
-- Script DDL (Data Definition Language) para o Banco de Dados do Site de Adoção de Animais

-- -----------------------------------------------------
-- Tabela: USUARIO
-- Armazena informações sobre todos os usuários do sistema (Adotantes, ONGs, Administradores).
-- -----------------------------------------------------
CREATE TABLE USUARIO (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NOT NULL, -- Armazena a senha criptografada (hash)
    telefone VARCHAR(20),
    cidade VARCHAR(50) NOT NULL,
    estado CHAR(2) NOT NULL,
    tipo_usuario ENUM('Adotante', 'ONG', 'Admin') NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- -----------------------------------------------------
-- Tabela: ANIMAL
-- Armazena informações detalhadas sobre os animais disponíveis para adoção.
-- -----------------------------------------------------
CREATE TABLE ANIMAL (
    id_animal INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    especie ENUM('Cachorro', 'Gato', 'Outro') NOT NULL,
    sexo ENUM('Macho', 'Fêmea') NOT NULL,
    data_nascimento DATE, -- Data de nascimento para cálculo de idade
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

-- -----------------------------------------------------
-- Tabela: ADOCAO
-- Gerencia o processo de adoção, registrando as solicitações e o histórico.
-- -----------------------------------------------------
CREATE TABLE ADOCAO (
    id_adocao INT AUTO_INCREMENT PRIMARY KEY,
    id_adotante INT NOT NULL, -- FK para o USUARIO (Adotante)
    id_animal INT NOT NULL, -- FK para o ANIMAL
    data_solicitacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status_transacao ENUM('Pendente', 'Aprovada', 'Rejeitada', 'Concluída') NOT NULL DEFAULT 'Pendente',
    observacoes TEXT,
    
    FOREIGN KEY (id_adotante) REFERENCES USUARIO(id_usuario),
    FOREIGN KEY (id_animal) REFERENCES ANIMAL(id_animal),
    
    -- Restrição para garantir que um animal não possa ser adotado mais de uma vez (em status Concluída)
    -- E um adotante não pode ter mais de uma adoção pendente para o mesmo animal
    UNIQUE (id_adotante, id_animal)
);

-- -----------------------------------------------------
-- Tabela: REQUISITO_ADOCAO
-- Permite que as ONGs definam requisitos específicos para a adoção de um animal.
-- -----------------------------------------------------
CREATE TABLE REQUISITO_ADOCAO (
    id_requisito INT AUTO_INCREMENT PRIMARY KEY,
    id_animal INT NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    
    FOREIGN KEY (id_animal) REFERENCES ANIMAL(id_animal)
);

-- -----------------------------------------------------
-- Índices para otimização de consultas
-- -----------------------------------------------------
CREATE INDEX idx_usuario_email ON USUARIO (email);
CREATE INDEX idx_animal_status ON ANIMAL (status_adocao);
CREATE INDEX idx_animal_localizacao ON ANIMAL (cidade, estado);
CREATE INDEX idx_adocao_status ON ADOCAO (status_transacao);

-- -----------------------------------------------------
-- Exemplos de Inserção de Dados (DML - Data Manipulation Language)
-- -----------------------------------------------------

-- Inserção de Usuários (ONG e Adotante)
INSERT INTO USUARIO (nome, email, senha_hash, telefone, cidade, estado, tipo_usuario) VALUES
('ONG Amiga dos Bichos', 'contato@ongamiga.org', 'hash_seguro_ong123', '11987654321', 'São Paulo', 'SP', 'ONG'),
('Maria da Silva', 'maria.silva@email.com', 'hash_seguro_maria', '21998765432', 'Rio de Janeiro', 'RJ', 'Adotante');

-- Inserção de Animais (Cadastrados pela ONG com id_usuario = 1)
INSERT INTO ANIMAL (nome, especie, sexo, data_nascimento, porte, raca, descricao, cidade, estado, id_ong_abrigo) VALUES
('Rex', 'Cachorro', 'Macho', '2023-05-10', 'Grande', 'Pastor Alemão', 'Cão dócil e brincalhão, precisa de espaço.', 'São Paulo', 'SP', 1),
('Mia', 'Gato', 'Fêmea', '2024-01-20', 'Pequeno', 'Siamês', 'Gata muito carinhosa e tranquila, ideal para apartamentos.', 'São Paulo', 'SP', 1);

-- Inserção de Requisitos de Adoção para o Rex (id_animal = 1)
INSERT INTO REQUISITO_ADOCAO (id_animal, descricao) VALUES
(1, 'Casa com quintal telado.'),
(1, 'Experiência prévia com cães de grande porte.');

-- Solicitação de Adoção da Maria (id_usuario = 2) para o Rex (id_animal = 1)
INSERT INTO ADOCAO (id_adotante, id_animal, status_transacao) VALUES
(2, 1, 'Pendente');

-- Exemplo de atualização de status (Aprovação)
-- UPDATE ADOCAO SET status_transacao = 'Aprovada' WHERE id_adocao = 1;
-- UPDATE ANIMAL SET status_adocao = 'Reservado' WHERE id_animal = 1;

SELECT * FROM usuario;