<?php
// Script para criar banco e tabela automaticamente

require_once '../config/database.php';

echo "<h1>Configuração do Banco de Dados - WhilePlay</h1>";

try {
    // Primeiro, conectar sem especificar o banco
    $pdo = new PDO("mysql:host=localhost", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<p style='color: green;'>✓ Conectado ao MySQL!</p>";
    
    // Criar banco de dados
    $pdo->exec("CREATE DATABASE IF NOT EXISTS while_play CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "<p style='color: green;'>✓ Banco de dados 'while_play' criado/verificado!</p>";
    
    // Conectar ao banco específico
    $pdo->exec("USE while_play");
    
    // Criar tabela user
    $sql = "
    CREATE TABLE IF NOT EXISTS user (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        senha VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    $pdo->exec($sql);
    echo "<p style='color: green;'>✓ Tabela 'user' criada/verificada!</p>";
    // Criar índice
    $pdo->exec("CREATE INDEX IF NOT EXISTS idx_user_email ON user(email)");
    echo "<p style='color: green;'>✓ Índice criado!</p>";
    
    echo "<hr>";
    echo "<h3>✅ Configuração completa!</h3>";
    echo "<p>O sistema está pronto para uso.</p>";
    
    echo "<h3>Próximos passos:</h3>";
    echo "<ol>";
    echo "<li><a href='teste_db.php'>Testar conexão com banco</a></li>";
    echo "<li><a href='../../front-end/views/teste_auth.html'>Testar sistema de autenticação</a></li>";
    echo "<li><a href='../../front-end/views/cadastro.html'>Criar primeiro usuário</a></li>";
    echo "</ol>";
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>✗ Erro ao configurar banco: " . $e->getMessage() . "</p>";
    echo "<p>Verifique se:</p>";
    echo "<ul>";
    echo "<li>O XAMPP está rodando</li>";
    echo "<li>O MySQL está ativo</li>";
    echo "<li>As credenciais em config/database.php estão corretas</li>";
    echo "</ul>";
}
?>