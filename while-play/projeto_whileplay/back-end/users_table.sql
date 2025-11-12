
CREATE DATABASE IF NOT EXISTS while_play;
USE while_play;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS perfil (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_completo VARCHAR(255) NOT NULL,
    username VARCHAR(100) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    biografia TEXT,
    foto_url VARCHAR(255),
    status ENUM('ativo', 'inativo', 'banido') DEFAULT 'ativo',
    token_recuperacao VARCHAR(255),
    ultimo_login DATETIME,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_username (username)
);

CREATE TABLE IF NOT EXISTS assinaturas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    cidade VARCHAR(100),
    endereco VARCHAR(255),
    telefone VARCHAR(20),
    cpf VARCHAR(14),
    status ENUM('ativa', 'inativa', 'cancelada') DEFAULT 'ativa',
    data_assinatura DATETIME DEFAULT CURRENT_TIMESTAMP,
    data_cancelamento DATETIME,
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE CASCADE,
    INDEX idx_usuario_id (usuario_id)
);

CREATE TABLE IF NOT EXISTS pagamento (
    id_pagamento INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    nome_do_cartao VARCHAR(300),
    numero_do_cartao VARCHAR(150),
    data_de_vencimento DATE,
    codigo DECIMAL(4,0),
    status ENUM('pago', 'pendente', 'recusado') DEFAULT 'pendente',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS roteiros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    categoria ENUM('Mais bem avaliados', 'Lançados recentemente') NOT NULL,
    caminho_imagem VARCHAR(255),
    visualizacoes INT DEFAULT 0,
    assinatura_id INT,
    usuario_id INT,
    publicado TINYINT(1) DEFAULT 0,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (assinatura_id) REFERENCES assinaturas(id) ON DELETE SET NULL,
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE SET NULL,
    INDEX idx_categoria (categoria)
);

CREATE TABLE IF NOT EXISTS personagens (
    id_sobre INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    descricao TEXT,
    mais_bem_avaliados VARCHAR(100),
    lancados_recentemente VARCHAR(100),
    caminho_imagem VARCHAR(255),
    usuario_id INT,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS publicar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    sinopse TEXT,
    tipo ENUM('roteiro', 'personagem') NOT NULL,
    arquivo_url VARCHAR(255),
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    publicado TINYINT(1) DEFAULT 0,
    status ENUM('rascunho', 'publicado', 'rejeitado') DEFAULT 'rascunho',
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS suportes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    mensagem TEXT,
    resposta TEXT,
    data_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
    data_resposta DATETIME,
    status ENUM('aberto', 'respondido', 'fechado') DEFAULT 'aberto',
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS biblioteca (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    nome VARCHAR(255),
    descricao TEXT,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS cadastro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP,
    ip_cadastro VARCHAR(45),
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS login (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    data_login DATETIME DEFAULT CURRENT_TIMESTAMP,
    ip_login VARCHAR(45),
    sucesso TINYINT(1) DEFAULT 1,
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS premios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    descricao VARCHAR(255),
    valor DECIMAL(10,2),
    data_premio DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE CASCADE
);

-- Inserts
INSERT INTO perfil (nome_completo, username, email, senha) VALUES
('Admin Teste', 'admin', 'admin@teste.com', '$2y$10$hashdeexemplo');

INSERT INTO pagamento (usuario_id, nome_do_cartao, numero_do_cartao, data_de_vencimento, codigo, status) VALUES
(1, 'Livia Mayumi hayashida', '12345678909', '2001-08-09', '0987', 'pago'),
(1, 'Diego gomes', '12864712547', '1980-09-12', '1234', 'pendente'),
(1, 'Geovanna lenient', '2314567890', '1999-12-21', '3242', 'pendente'),
(1, 'Victor do Vale', '9876543210', '2009-07-29', '6785', 'pago');