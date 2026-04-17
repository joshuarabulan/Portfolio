<?php
// For Render.com - Use environment variables for TiDB Cloud
$host = getenv('DB_HOST') ?: 'gateway01.ap-southeast-1.prod.a1icloud.tidbcloud.com';
$username = getenv('USER') ?: getenv('USERNAME') ?: '4KfxBVX3fQLSFAe.root';
$password = getenv('PASSWORD') ?: 'arx3ZHVQMQnH0Exq';
$database = getenv('NAME') ?: 'test';
$port = getenv('PORT') ?: '4000';

// Create connection with SSL for TiDB Cloud
$conn = mysqli_init();

// Enable SSL - This is the correct way for TiDB Cloud
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);
mysqli_options($conn, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, false);

// Establish connection
if (!mysqli_real_connect(
    $conn,
    $host,
    $username,
    $password,
    $database,
    $port,
    NULL,
    MYSQLI_CLIENT_SSL
)) {
    $error = mysqli_connect_error();
    error_log("Database connection failed: " . $error);
    
    // Check if this is an API call
    if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], 'send.php') !== false) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Database connection error. Please try again later.']);
        exit;
    }
    die("Connection failed: " . $error);
}

// Check connection
if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to avoid encoding issues
$conn->set_charset("utf8mb4");
?>