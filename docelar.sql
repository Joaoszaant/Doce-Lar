use docelar;
CREATE TABLE USUARIO (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    cidade VARCHAR(50) NOT NULL,
    estado CHAR(2) NOT NULL,
    tipo_usuario ENUM('Adotante', 'ONG', 'Admin') NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

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

CREATE TABLE ADOCAO (
    id_adocao INT AUTO_INCREMENT PRIMARY KEY,
    id_adotante INT NOT NULL, -- FK para o USUARIO (Adotante)
    id_animal INT NOT NULL, -- FK para o ANIMAL
    data_solicitacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status_transacao ENUM('Pendente', 'Aprovada', 'Rejeitada', 'Concluída') NOT NULL DEFAULT 'Pendente',
    observacoes TEXT,
    
    FOREIGN KEY (id_adotante) REFERENCES USUARIO(id_usuario),
    FOREIGN KEY (id_animal) REFERENCES ANIMAL(id_animal),
       UNIQUE (id_adotante, id_animal)
);
CREATE TABLE REQUISITO_ADOCAO (
    id_requisito INT AUTO_INCREMENT PRIMARY KEY,
    id_animal INT NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    
    FOREIGN KEY (id_animal) REFERENCES ANIMAL(id_animal)
);

-- Índices para otimização de consultas
-- -----------------------------------------------------
CREATE INDEX idx_usuario_email ON USUARIO (email);
CREATE INDEX idx_animal_status ON ANIMAL (status_adocao);
CREATE INDEX idx_animal_localizacao ON ANIMAL (cidade, estado);
CREATE INDEX idx_adocao_status ON ADOCAO (status_transacao);


select * from usuario;
