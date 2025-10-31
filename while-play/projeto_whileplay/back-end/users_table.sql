
-- Tabela de usuários (User)
CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de publicações (Publicados)
CREATE TABLE IF NOT EXISTS publicados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    sinopse TEXT,
    tipo ENUM('roteiro', 'personagem') NOT NULL,
    arquivo_url VARCHAR(255),
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    publicado TINYINT(1) DEFAULT 0,
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE CASCADE
);



-- Banco de dados
CREATE DATABASE IF NOT EXISTS while_play;
USE while_play;


-- Tabela de perfil (Perfil)
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
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_username (username)
);


-- Tabela de assinaturas (Assinatura)
CREATE TABLE IF NOT EXISTS assinatura (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    cidade VARCHAR(100),
    endereco VARCHAR(255),
    cep VARCHAR(20),
    cpf VARCHAR(14),
    status ENUM('ativa', 'inativa', 'cancelada') DEFAULT 'ativa',
    data_assinatura TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    data_cancelamento DATETIME,
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE CASCADE,
    INDEX idx_usuario_id (usuario_id)
);


-- Tabela de pagamentos (Pagamento)
CREATE TABLE IF NOT EXISTS pagamento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    nome_do_cartao VARCHAR(300),
    numero_do_cartao VARCHAR(150),
    data_de_vencimento DATE,
    codigo DECIMAL(4,0),
    status ENUM('pago', 'pendente', 'recusado') DEFAULT 'pendente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE SET NULL
);


-- Tabela de roteiros (Roteiro)
CREATE TABLE IF NOT EXISTS roteiro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    categoria ENUM('Mais bem avaliados', 'Lançados recentemente') NOT NULL,
    caminho_imagem VARCHAR(255),
    visualizacoes INT DEFAULT 0,
    assinatura_id INT,
    usuario_id INT,
    publicado TINYINT(1) DEFAULT 0,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (assinatura_id) REFERENCES assinatura(id) ON DELETE SET NULL,
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE SET NULL,
    INDEX idx_categoria (categoria)
);


-- Tabela de personagens (Personagem)
CREATE TABLE IF NOT EXISTS personagem (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    descricao TEXT,
    mais_bem_avaliados VARCHAR(100),
    lancados_recentemente VARCHAR(100),
    caminho_imagem VARCHAR(255),
    usuario_id INT,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE SET NULL
);


-- Tabela de publicações (Publicar)
CREATE TABLE IF NOT EXISTS publicar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    sinopse TEXT,
    tipo ENUM('roteiro', 'personagem') NOT NULL,
    arquivo_url VARCHAR(255),
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    publicado TINYINT(1) DEFAULT 0,
    status ENUM('rascunho', 'publicado', 'rejeitado') DEFAULT 'rascunho',
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE CASCADE
);


-- Tabela de suporte (Suporte)
CREATE TABLE IF NOT EXISTS suporte (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    mensagem TEXT,
    resposta TEXT,
    data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    data_resposta DATETIME,
    status ENUM('aberto', 'respondido', 'fechado') DEFAULT 'aberto',
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE CASCADE
);


-- Tabela de biblioteca
CREATE TABLE IF NOT EXISTS biblioteca (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    nome VARCHAR(255),
    descricao TEXT,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE CASCADE
);


-- Tabela de cadastro
CREATE TABLE IF NOT EXISTS cadastro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_cadastro VARCHAR(45),
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE CASCADE
);


-- Tabela de login
CREATE TABLE IF NOT EXISTS login (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    data_login TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_login VARCHAR(45),
    sucesso TINYINT(1) DEFAULT 1,
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE CASCADE
);


-- Tabela de prêmios
CREATE TABLE IF NOT EXISTS premio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    descricao VARCHAR(255),
    valor DECIMAL(10,2),
    data_premio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE CASCADE
);



-- Dados iniciais
INSERT INTO perfil (nome_completo, username, email, senha) VALUES
('Admin Teste', 'admin', 'admin@teste.com', '$2y$10$hashdeexemplo');


INSERT INTO pagamento (usuario_id, nome_do_cartao, numero_do_cartao, data_de_vencimento, codigo, status) VALUES
(1, 'Livia Mayumi hayashida', '12345678909', '2001-08-09', '0987', 'pago'),
(1, 'Diego Gomes', '12864712547', '1980-09-12', '1234', 'pendente'),
(1, 'Geovanna Lenient', '2314567890', '1999-12-21', '3242', 'pendente'),
(1, 'Victor do Vale', '9876543210', '2009-07-29', '6785', 'pago');
