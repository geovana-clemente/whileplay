<?php

class FileUserStorage {
    private $usersFile;
    
    public function __construct() {
        $this->usersFile = __DIR__ . '/../data/users.json';
        
        // Criar diretório se não existir
        $dataDir = dirname($this->usersFile);
        if (!is_dir($dataDir)) {
            mkdir($dataDir, 0755, true);
        }
        
        // Criar arquivo se não existir
        if (!file_exists($this->usersFile)) {
            file_put_contents($this->usersFile, json_encode([]));
        }
    }
    
    public function getAllUsers() {
        $data = file_get_contents($this->usersFile);
        return json_decode($data, true) ?: [];
    }
    
    public function saveUsers($users) {
        return file_put_contents($this->usersFile, json_encode($users, JSON_PRETTY_PRINT));
    }
    
    public function createUser($nome, $email, $password) {
        $users = $this->getAllUsers();
        
        // Verificar se email já existe
        foreach ($users as $user) {
            if ($user['email'] === $email) {
                return false; // Email já existe
            }
        }
        
        // Criar novo usuário
        $newUser = [
            'id' => uniqid(),
            'nome' => $nome,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $users[] = $newUser;
        return $this->saveUsers($users) ? $newUser : false;
    }
    
    public function findUserByEmail($email) {
        $users = $this->getAllUsers();
        
        foreach ($users as $user) {
            if ($user['email'] === $email) {
                return $user;
            }
        }
        
        return null;
    }
    
    public function verifyPassword($email, $password) {
        $user = $this->findUserByEmail($email);
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        
        return false;
    }
}