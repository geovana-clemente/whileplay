<?php
// Script para criar banco e todas as tabelas do sistema WhilePlay

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
    
    // Ler e executar o SQL completo do arquivo users_table.sql
    $sqlFile = '../users_table.sql';
    if (file_exists($sqlFile)) {
        $sql = file_get_contents($sqlFile);
        
        // Dividir em comandos separados
        $commands = array_filter(array_map('trim', explode(';', $sql)));
        
        foreach ($commands as $command) {
            if (!empty($command) && !preg_match('/^(--|\/\*|\*\/|CREATE\s+DATABASE|USE\s+while_play)/i', trim($command))) {
                try {
                    $pdo->exec($command);
                } catch (PDOException $e) {
                    // Ignorar erros de tabelas já existentes
                    if (!strpos($e->getMessage(), 'already exists')) {
                        throw $e;
                    }
                }
            }
        }
        echo "<p style='color: green;'>✓ Todas as tabelas do sistema criadas/verificadas!</p>";
    } else {
        echo "<p style='color: orange;'>⚠ Arquivo SQL não encontrado, criando tabela básica...</p>";
        
        // Criar apenas tabela perfil básica se o arquivo SQL não existir
        $sql = "
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
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
        $pdo->exec($sql);
        echo "<p style='color: green;'>✓ Tabela 'perfil' criada/verificada!</p>";
    }
    
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