<?php
require_once '../config/database.php';

$sql = <<<SQL
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
SQL;

try {
    $database = new Database();
    $pdo = $database->getConnection();
    $pdo->exec($sql);
    echo "Tabela 'perfil' criada ou já existe.";
} catch (PDOException $e) {
    echo "Erro ao criar tabela: " . $e->getMessage();
}
