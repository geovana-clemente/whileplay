<?php
// Teste de conexão com banco de dados

require_once '../config/database.php';

echo "<h1>Teste de Conexão - WhilePlay</h1>";

try {
    $database = new Database();
    $pdo = $database->getConnection();
    
    if ($pdo) {
        echo "<p style='color: green;'>✓ Conexão com banco de dados estabelecida com sucesso!</p>";
        
        // Testar se a tabela user existe
        $stmt = $pdo->query("SHOW TABLES LIKE 'user'");
        if ($stmt->rowCount() > 0) {
            echo "<p style='color: green;'>✓ Tabela 'user' encontrada!</p>";
            // Mostrar estrutura da tabela
            $stmt = $pdo->query("DESCRIBE user");
            echo "<h3>Estrutura da tabela user:</h3>";
            echo "<table border='1' style='border-collapse: collapse;'>";
            echo "<tr><th>Campo</th><th>Tipo</th><th>Null</th><th>Key</th><th>Default</th></tr>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>{$row['Field']}</td>";
                echo "<td>{$row['Type']}</td>";
                echo "<td>{$row['Null']}</td>";
                echo "<td>{$row['Key']}</td>";
                echo "<td>{$row['Default']}</td>";
                echo "</tr>";
            }
            echo "</table>";
            // Contar usuários existentes
            $stmt = $pdo->query("SELECT COUNT(*) as total FROM user");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo "<p>Total de usuários cadastrados: <strong>{$result['total']}</strong></p>";
        } else {
            echo "<p style='color: orange;'>⚠ Tabela 'user' não encontrada. Execute o script users_table.sql!</p>";
        }
        
    } else {
        echo "<p style='color: red;'>✗ Erro ao conectar com banco de dados!</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Erro: " . $e->getMessage() . "</p>";
}

// Inserir dados de teste se solicitado
if (isset($_GET['inserir_dados']) && $_GET['inserir_dados'] == '1') {
    echo "<hr>";
    echo "<h2>Inserindo Dados de Teste</h2>";
    
    try {
        // Verificar se já existem usuários
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM user");
        $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        
        if ($total == 0) {
            // Inserir usuários de teste
            $usuarios = [
                ['Livia Mayumi Hayashida', 'livia@example.com', password_hash('123', PASSWORD_DEFAULT)],
                ['Diego Gomes', 'diego@example.com', password_hash('123', PASSWORD_DEFAULT)],
                ['Geovanna Clemente', 'geovanna@example.com', password_hash('123', PASSWORD_DEFAULT)],
                ['Victor do Vale', 'victor@example.com', password_hash('123', PASSWORD_DEFAULT)]
            ];
            
            $stmt = $pdo->prepare("INSERT INTO user (nome, email, senha) VALUES (?, ?, ?)");
            
            foreach ($usuarios as $usuario) {
                $stmt->execute($usuario);
            }
            
            echo "<p style='color: green;'>✓ " . count($usuarios) . " usuários inseridos com sucesso!</p>";
            
            // Mostrar usuários inseridos
            $stmt = $pdo->query("SELECT id, nome, email, created_at FROM user ORDER BY created_at DESC");
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo "<h3>Usuários Cadastrados:</h3>";
            echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
            echo "<tr><th>ID</th><th>Nome</th><th>Email</th><th>Data Cadastro</th></tr>";
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>{$user['id']}</td>";
                echo "<td>{$user['nome']}</td>";
                echo "<td>{$user['email']}</td>";
                echo "<td>{$user['created_at']}</td>";
                echo "</tr>";
            }
            echo "</table>";
            
        } else {
            echo "<p style='color: orange;'>⚠ Já existem {$total} usuários no banco!</p>";
        }
        
    } catch (Exception $e) {
        echo "<p style='color: red;'>✗ Erro ao inserir dados: " . $e->getMessage() . "</p>";
    }
}

echo "<hr>";
echo "<h3>Ações:</h3>";
echo "<p><a href='teste_db.php?inserir_dados=1' style='background: #4CAF50; color: white; padding: 10px; text-decoration: none; border-radius: 5px;'>📥 Inserir Dados de Teste</a></p>";

echo "<hr>";
echo "<h3>Informações do Sistema:</h3>";
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
echo "<p><strong>Servidor:</strong> " . ($_SERVER['SERVER_SOFTWARE'] ?? 'CLI') . "</p>";
echo "<p><strong>Documento Root:</strong> " . ($_SERVER['DOCUMENT_ROOT'] ?? getcwd()) . "</p>";
echo "<p><strong>URL atual:</strong> " . ($_SERVER['REQUEST_URI'] ?? 'CLI mode') . "</p>";

echo "<hr>";
echo "<h3>Links de Teste:</h3>";
echo "<p><a href='../../front-end/views/teste_auth.html'>Página de Teste de Autenticação</a></p>";
echo "<p><a href='../../front-end/views/cadastro.html'>Página de Cadastro</a></p>";
echo "<p><a href='../../front-end/views/login.html'>Página de Login</a></p>";
?>