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
    
    echo "<h3>Criando tabelas essenciais...</h3>";
    
    // Criar tabela user (compatibilidade)
    $pdo->exec("
    CREATE TABLE IF NOT EXISTS user (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(255) NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        senha VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
    echo "<p style='color: green;'>✓ Tabela 'user' criada/verificada!</p>";
    
// ...existing code...
        
        $stmt = $pdo->prepare("INSERT INTO perfil (nome_completo, username, email, senha) VALUES (?, ?, ?, ?)");
        
        foreach ($usuarios as $usuario) {
            $stmt->execute($usuario);
        }
        
        echo "<p style='color: green;'>✓ " . count($usuarios) . " usuários de teste inseridos!</p>";
        
        // Inserir também na tabela user se existir
        try {
            $stmtUser = $pdo->prepare("INSERT INTO user (nome, email, senha) VALUES (?, ?, ?)");
            foreach ($usuarios as $usuario) {
                $stmtUser->execute([$usuario[0], $usuario[2], $usuario[3]]);
            }
            echo "<p style='color: green;'>✓ Usuários também inseridos na tabela 'user'!</p>";
        } catch (Exception $e) {
            // Tabela user pode não existir, não é problema
        }

    echo "<hr>";
    echo "<h3>✅ Configuração completa!</h3>";
    echo "<p>O sistema está pronto para uso.</p>";
    
    // Mostrar resumo dos dados
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM perfil");
    $totalPerfil = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    echo "<p><strong>Usuários:</strong> {$totalPerfil}</p>";
    
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