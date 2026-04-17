<?php
// For Render.com - Use environment variables for TiDB Cloud
$host = getenv('DB_HOST') ?: 'gateway01.ap-southeast-1.prod.a1icloud.tidbcloud.com';
$username = getenv('DB_USER') ?: getenv('DB_USERNAME') ?: '4KfxBVX3fQLSFAe.root';
$password = getenv('DB_PASSWORD') ?: 'arx3ZHVQMQnH0Exq';
$database = getenv('DB_NAME') ?: 'portfolio';
$port = getenv('DB_PORT') ?: '4000';

// Create connection with SSL for TiDB Cloud 
$conn = mysqli_init();

// Enable SSL for TiDB Cloud
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
    die("Connection failed: " . $error);
}

// Set charset to avoid encoding issues
$conn->set_charset("utf8mb4");
?>