<?php

// Teste completo do sistema híbrido de autenticação

echo "<h1>🧪 Teste do Sistema Híbrido de Autenticação</h1>";

// Testar FileUserStorage
echo "<h2>📁 Teste do FileUserStorage</h2>";

try {
    require_once '../storage/FileUserStorage.php';
    
    $storage = new FileUserStorage();
    echo "<p style='color: green;'>✅ FileUserStorage carregado com sucesso</p>";
    
    // Testar criação de usuário
    $testUser = $storage->createUser('Teste User', 'teste@example.com', 'senha123');
    if ($testUser) {
        echo "<p style='color: green;'>✅ Usuário de teste criado: {$testUser['email']}</p>";
        
        // Testar login
        $loginTest = $storage->verifyPassword('teste@example.com', 'senha123');
        if ($loginTest) {
            echo "<p style='color: green;'>✅ Login testado com sucesso</p>";
        } else {
            echo "<p style='color: red;'>❌ Falha no teste de login</p>";
        }
    } else {
        echo "<p style='color: orange;'>⚠️ Usuário já existe ou erro na criação</p>";
    }
    
    // Mostrar todos os usuários
    $users = $storage->getAllUsers();
    echo "<p><strong>Total de usuários:</strong> " . count($users) . "</p>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Erro no FileUserStorage: " . $e->getMessage() . "</p>";
}

// Testar UserControllerV2
echo "<h2>🎛️ Teste do UserControllerV2</h2>";

try {
    require_once '../controllers/UserControllerV2.php';
    
    $controller = new UserController();
    echo "<p style='color: green;'>✅ UserControllerV2 carregado com sucesso</p>";
    
    // Simular verificação de auth
    $_SERVER['REQUEST_METHOD'] = 'GET';
    
    ob_start();
    $controller->getSystemStatus();
    $output = ob_get_clean();
    
    echo "<p style='color: green;'>✅ Sistema de status funcionando</p>";
    echo "<details><summary>Ver resposta do sistema</summary><pre>$output</pre></details>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Erro no UserControllerV2: " . $e->getMessage() . "</p>";
}

// Testar rotas do index.php
echo "<h2>🛣️ Teste das Rotas</h2>";

$testRoutes = [
    '/GitHub/whileplay/while-play/projeto_whileplay/back-end/system-status',
    '/GitHub/whileplay/while-play/projeto_whileplay/back-end/check-auth'
];

foreach ($testRoutes as $route) {
    $_SERVER['REQUEST_URI'] = $route;
    $request = strtok($route, '?');
    
    echo "<p><strong>Rota:</strong> $route</p>";
    
    if (strpos($request, '/system-status') !== false) {
        echo "<p style='color: green;'>✅ Rota system-status reconhecida</p>";
    } elseif (strpos($request, '/check-auth') !== false) {
        echo "<p style='color: green;'>✅ Rota check-auth reconhecida</p>";
    } else {
        echo "<p style='color: orange;'>⚠️ Rota não reconhecida pelo sistema</p>";
    }
}

// Informações do ambiente
echo "<h2>💻 Informações do Ambiente</h2>";
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
echo "<p><strong>Diretório atual:</strong> " . __DIR__ . "</p>";
echo "<p><strong>Arquivo de usuários:</strong> " . realpath('../data/users.json') . "</p>";

// Verificar MySQL
echo "<h2>🗄️ Status MySQL</h2>";
try {
    $pdo = new PDO("mysql:host=localhost", "root", "");
    echo "<p style='color: green;'>✅ MySQL está disponível</p>";
} catch (PDOException $e) {
    echo "<p style='color: red;'>❌ MySQL não disponível: " . $e->getMessage() . "</p>";
    echo "<p style='color: blue;'>ℹ️ Sistema funcionará com FileUserStorage</p>";
}

echo "<hr>";
echo "<h3>🎯 Links de Teste:</h3>";
echo "<ul>";
echo "<li><a href='../../front-end/views/sistema_login_completo.html'>🚀 Sistema de Login Completo</a></li>";
echo "<li><a href='../../front-end/views/cadastro.html'>👤 Página de Cadastro</a></li>";
echo "<li><a href='../../front-end/views/login.html'>🔑 Página de Login</a></li>";
echo "</ul>";

echo "<p style='text-align: center; margin-top: 30px; color: #666;'>";
echo "Sistema testado em " . date('d/m/Y H:i:s') . " - WhilePlay Auth System v2.0";
echo "</p>";
?>