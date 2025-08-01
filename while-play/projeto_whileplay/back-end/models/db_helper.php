<?php
// Helper to get PDO connection for models
require_once __DIR__ . '/../config/database.php';

function getDatabaseConnection() {
    $database = new Database();
    return $database->getConnection();
}
