<?php
// For Render.com - Use environment variables
$host = getenv('DB_HOST') ?: 'localhost';
$username = getenv('DB_USERNAME') ?: 'root';
$password = getenv('DB_PASSWORD') ?: '';
$database = getenv('DB_NAME') ?: 'portfolio';
$port = getenv('DB_PORT') ?: '3306';

// Create connection with port
$conn = new mysqli($host, $username, $password, $database, $port);

if ($conn->connect_error) {
    // Log error but return JSON for API calls
    error_log("Database connection failed: " . $conn->connect_error);
    
    // Check if this is an API call
    if (strpos($_SERVER['REQUEST_URI'], 'send.php') !== false) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Database connection error. Please try again later.']);
        exit;
    }
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to avoid encoding issues
$conn->set_charset("utf8mb4");
?>