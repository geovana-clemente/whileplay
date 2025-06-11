-- SQL para criar a tabela 'publicados' com todos os campos necessários
CREATE TABLE IF NOT EXISTS publicados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    email VARCHAR(255) NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    sinopse TEXT NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    arquivo_url VARCHAR(255),
    data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    publicado TINYINT(1) NOT NULL DEFAULT 0
);
