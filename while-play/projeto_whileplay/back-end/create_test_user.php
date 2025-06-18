<?php
// Helper script to create a test user for login
require_once __DIR__ . '/../models/db_helper.php';
$conn = getDatabaseConnection();
$email = 'admin@teste.com';
$password = password_hash('123456', PASSWORD_DEFAULT);
$stmt = $conn->prepare('INSERT INTO users (email, password) VALUES (?, ?)');
$stmt->execute([$email, $password]);
echo "Test user created: $email / 123456\n";
