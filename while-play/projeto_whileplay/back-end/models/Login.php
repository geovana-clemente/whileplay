<?php
// filepath: c:\Users\3anoA\Documents\WhilePlay\while-play\projeto_whileplay\back-end\models\Login.php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/db_helper.php';

class Login {
    private $conn;
    public function __construct() {
        $this->conn = getDatabaseConnection();
    }

    public function getUserByEmail($email) {
        $stmt = $this->conn->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($email, $passwordHash, $nome = null) {
        if ($nome) {
            $stmt = $this->conn->prepare('INSERT INTO users (email, password, nome) VALUES (?, ?, ?)');
            return $stmt->execute([$email, $passwordHash, $nome]);
        } else {
            $stmt = $this->conn->prepare('INSERT INTO users (email, password) VALUES (?, ?)');
            return $stmt->execute([$email, $passwordHash]);
        }
    }

    public function updatePassword($email, $newPasswordHash) {
        $stmt = $this->conn->prepare('UPDATE users SET password = ? WHERE email = ?');
        return $stmt->execute([$newPasswordHash, $email]);
    }
}
