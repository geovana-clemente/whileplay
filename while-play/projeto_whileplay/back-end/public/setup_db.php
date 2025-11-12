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
    
    // Criar tabela perfil (principal)
    $pdo->exec("
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
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
    echo "<p style='color: green;'>✓ Tabela 'perfil' criada/verificada!</p>";
    
    // Criar tabela pagamento
    $pdo->exec("
    CREATE TABLE IF NOT EXISTS pagamento (
        id INT AUTO_INCREMENT PRIMARY KEY,
        usuario_id INT NOT NULL,
        nome_do_cartao VARCHAR(255) NOT NULL,
        numero_do_cartao VARCHAR(20) NOT NULL,
        data_de_vencimento DATE NOT NULL,
        codigo VARCHAR(10) NOT NULL,
        status ENUM('pendente', 'pago', 'recusado', 'cancelado') DEFAULT 'pendente',
        valor DECIMAL(10, 2) DEFAULT 0.00,
        data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
    echo "<p style='color: green;'>✓ Tabela 'pagamento' criada/verificada!</p>";
    
    // Inserir dados de teste se não existirem
    echo "<h3>Inserindo dados de teste...</h3>";
    
    // Verificar se já existem usuários
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM perfil");
    $totalUsuarios = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    if ($totalUsuarios == 0) {
        // Inserir usuários de teste
        $usuarios = [
            ['Livia Mayumi Hayashida', 'livia', 'livia@example.com', password_hash('123', PASSWORD_DEFAULT)],
            ['Diego Gomes', 'diego', 'diego@example.com', password_hash('123', PASSWORD_DEFAULT)],
            ['Geovanna Clemente', 'geovanna', 'geovanna@example.com', password_hash('123', PASSWORD_DEFAULT)],
            ['Victor do Vale', 'victor', 'victor@example.com', password_hash('123', PASSWORD_DEFAULT)]
        ];
        
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
        
        // Inserir pagamentos se a tabela existir
        try {
            $stmt = $pdo->query("SELECT 1 FROM pagamento LIMIT 1");
            
            $pagamentos = [
                [1, 'Livia Mayumi Hayashida', '12345678909', '2001-08-09', '0987', 'pago'],
                [2, 'Diego Gomes', '12864712547', '1980-09-12', '1234', 'pago'],
                [3, 'Geovanna Clemente', '2314567890', '1999-12-21', '3242', 'pago'],
                [4, 'Victor do Vale', '9876543210', '2009-07-29', '6785', 'pago']
            ];
            
            $stmtPagamento = $pdo->prepare("INSERT INTO pagamento (usuario_id, nome_do_cartao, numero_do_cartao, data_de_vencimento, codigo, status) VALUES (?, ?, ?, ?, ?, ?)");
            
            foreach ($pagamentos as $pagamento) {
                $stmtPagamento->execute($pagamento);
            }
            
            echo "<p style='color: green;'>✓ " . count($pagamentos) . " pagamentos de teste inseridos!</p>";
        } catch (Exception $e) {
            // Se tabela pagamento não existe ou tem estrutura diferente, criar uma básica
            try {
                $pdo->exec("
                CREATE TABLE IF NOT EXISTS pagamento (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    usuario_id INT NOT NULL,
                    nome_do_cartao VARCHAR(255) NOT NULL,
                    numero_do_cartao VARCHAR(20) NOT NULL,
                    data_de_vencimento DATE NOT NULL,
                    codigo VARCHAR(10) NOT NULL,
                    status ENUM('pendente', 'pago', 'recusado', 'cancelado') DEFAULT 'pendente',
                    valor DECIMAL(10, 2) DEFAULT 0.00,
                    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE CASCADE
                )");
                
                echo "<p style='color: green;'>✓ Tabela 'pagamento' criada!</p>";
                
                // Inserir pagamentos
                $pagamentos = [
                    [1, 'Livia Mayumi Hayashida', '12345678909', '2001-08-09', '0987', 'pago'],
                    [2, 'Diego Gomes', '12864712547', '1980-09-12', '1234', 'pago'],
                    [3, 'Geovanna Clemente', '2314567890', '1999-12-21', '3242', 'pago'],
                    [4, 'Victor do Vale', '9876543210', '2009-07-29', '6785', 'pago']
                ];
                
                $stmtPagamento = $pdo->prepare("INSERT INTO pagamento (usuario_id, nome_do_cartao, numero_do_cartao, data_de_vencimento, codigo, status) VALUES (?, ?, ?, ?, ?, ?)");
                
                foreach ($pagamentos as $pagamento) {
                    $stmtPagamento->execute($pagamento);
                }
                
                echo "<p style='color: green;'>✓ " . count($pagamentos) . " pagamentos inseridos!</p>";
            } catch (Exception $e2) {
                echo "<p style='color: orange;'>⚠ Não foi possível criar/popular tabela pagamento: " . $e2->getMessage() . "</p>";
            }
        }
    } else {
        echo "<p style='color: orange;'>⚠ Dados de teste já existem ({$totalUsuarios} usuários encontrados)</p>";
    }

    echo "<hr>";
    echo "<h3>✅ Configuração completa!</h3>";
    echo "<p>O sistema está pronto para uso.</p>";
    
    // Mostrar resumo dos dados
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM perfil");
    $totalPerfil = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    try {
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM pagamento");
        $totalPagamento = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        echo "<p><strong>Usuários:</strong> {$totalPerfil} | <strong>Pagamentos:</strong> {$totalPagamento}</p>";
    } catch (Exception $e) {
        echo "<p><strong>Usuários:</strong> {$totalPerfil}</p>";
    }
    
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