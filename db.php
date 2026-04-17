<?php
// File: db.php - Using PDO instead of MySQLi

try {
    $host = getenv('DB_HOST') ?: 'localhost';
    $dbname = getenv('DB_NAME') ?: 'portfolio';
    $username = getenv('DB_USER') ?: 'root';
    $password = getenv('DB_PASS') ?: '';
    
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    $conn = null; // Set to null so we can check if connection exists
}
?>