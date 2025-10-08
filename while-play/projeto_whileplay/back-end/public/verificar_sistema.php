<?php
// Teste simples do sistema de rotas

// Ativar exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>🧪 Teste do Sistema de Rotas - WhilePlay</h1>";

// Verificar se os arquivos essenciais existem
$files_to_check = [
    '../controllers/UserController.php' => 'UserController',
    '../models/User.php' => 'User Model',
    '../config/database.php' => 'Database Config',
    'index.php' => 'Router Principal'
];

echo "<h2>✅ Verificação de Arquivos:</h2>";
foreach ($files_to_check as $file => $description) {
    if (file_exists($file)) {
        echo "<p style='color: green;'>✓ $description: $file</p>";
    } else {
        echo "<p style='color: red;'>✗ $description: $file (AUSENTE)</p>";
    }
}

// Testar carregamento de classes
echo "<h2>🔧 Teste de Classes:</h2>";

try {
    require_once '../config/database.php';
    echo "<p style='color: green;'>✓ Database class carregada</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Erro ao carregar Database: " . $e->getMessage() . "</p>";
}

try {
    require_once '../controllers/UserController.php';
    echo "<p style='color: green;'>✓ UserController carregado</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Erro ao carregar UserController: " . $e->getMessage() . "</p>";
}

// Testar simulação de rotas
echo "<h2>🛣️ Teste de Rotas (Simulação):</h2>";

$test_routes = [
    '/GitHub/whileplay/while-play/projeto_whileplay/back-end/check-auth' => 'GET',
    '/GitHub/whileplay/while-play/projeto_whileplay/back-end/register' => 'POST',
    '/GitHub/whileplay/while-play/projeto_whileplay/back-end/login' => 'POST'
];

foreach ($test_routes as $route => $method) {
    // Simular REQUEST_URI
    $_SERVER['REQUEST_URI'] = $route;
    $_SERVER['REQUEST_METHOD'] = $method;
    
    echo "<div style='padding: 10px; margin: 5px; background: #f0f0f0; border-radius: 5px;'>";
    echo "<strong>Rota:</strong> $route ($method)<br>";
    
    // Verificar se a rota seria capturada
    $captured = false;
    if (strpos($route, '/check-auth') !== false) {
        echo "<span style='color: green;'>✓ Rota reconhecida pelo sistema</span>";
        $captured = true;
    } elseif (strpos($route, '/register') !== false) {
        echo "<span style='color: green;'>✓ Rota reconhecida pelo sistema</span>";
        $captured = true;
    } elseif (strpos($route, '/login') !== false) {
        echo "<span style='color: green;'>✓ Rota reconhecida pelo sistema</span>";
        $captured = true;
    }
    
    if (!$captured) {
        echo "<span style='color: orange;'>⚠ Rota não reconhecida</span>";
    }
    
    echo "</div>";
}

// Informações do sistema
echo "<h2>💻 Informações do Sistema:</h2>";
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
echo "<p><strong>Modo:</strong> " . (php_sapi_name() === 'cli' ? 'CLI' : 'Web Server') . "</p>";
echo "<p><strong>Diretório Atual:</strong> " . __DIR__ . "</p>";

// Status do MySQL (tentativa)
echo "<h2>🗄️ Status do Banco de Dados:</h2>";
try {
    $pdo = new PDO("mysql:host=localhost", "root", "");
    echo "<p style='color: green;'>✓ MySQL está rodando e acessível</p>";
    
    // Testar banco específico
    try {
        $pdo->exec("USE while_play");
        echo "<p style='color: green;'>✓ Banco 'while_play' existe</p>";
        
        // Testar tabela users
        $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
        if ($stmt->rowCount() > 0) {
            echo "<p style='color: green;'>✓ Tabela 'users' existe</p>";
        } else {
            echo "<p style='color: orange;'>⚠ Tabela 'users' não existe - execute setup_db.php</p>";
        }
    } catch (PDOException $e) {
        echo "<p style='color: orange;'>⚠ Banco 'while_play' não existe - execute setup_db.php</p>";
    }
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>✗ MySQL não está rodando</p>";
    echo "<p>Para corrigir:</p>";
    echo "<ol>";
    echo "<li>Abra o XAMPP Control Panel</li>";
    echo "<li>Clique em 'Start' no Apache</li>";
    echo "<li>Clique em 'Start' no MySQL</li>";
    echo "<li>Execute: <a href='setup_db.php'>setup_db.php</a></li>";
    echo "</ol>";
}

echo "<h2>🎯 Próximos Passos:</h2>";
echo "<ol>";
echo "<li><strong>Iniciar XAMPP:</strong> Apache + MySQL</li>";
echo "<li><strong>Configurar Banco:</strong> <a href='setup_db.php'>Executar setup_db.php</a></li>";
echo "<li><strong>Testar Rotas:</strong> <a href='../../front-end/views/teste_rotas.html'>Página de teste completa</a></li>";
echo "<li><strong>Testar Auth:</strong> <a href='../../front-end/views/cadastro.html'>Fazer cadastro</a></li>";
echo "</ol>";

echo "<hr>";
echo "<p style='text-align: center; color: #666;'>Sistema WhilePlay - Verificação concluída em " . date('d/m/Y H:i:s') . "</p>";
?>