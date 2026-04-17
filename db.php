<?php
$host = getenv('DB_HOST') ?: 'gateway01.ap-southeast-1.prod.aws.tidbcloud.com';
$username = getenv('DB_USER') ?: '4KfxBVX3fQLSFAe.root';
$password = getenv('DB_PASSWORD') ?: 'arx3ZHVQMQnH0Exq';
$database = getenv('DB_NAME') ?: 'portfolio';
$port = getenv('DB_PORT') ?: '4000';

// Path to CA certificate
$ca_cert_path = __DIR__ . '/cacert.pem';

// Initialize connection
$conn = mysqli_init();

// Configure SSL if certificate exists
if (file_exists($ca_cert_path)) {
    mysqli_ssl_set($conn, NULL, NULL, $ca_cert_path, NULL, NULL);
    error_log("Using CA certificate: " . $ca_cert_path);
} else {
    error_log("WARNING: CA certificate not found at: " . $ca_cert_path);
}

// Disable strict SSL verification for TiDB Cloud
mysqli_options($conn, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, false);

// Establish connection
if (!mysqli_real_connect($conn, $host, $username, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL)) {
    $error = mysqli_connect_error();
    error_log("Database connection failed: " . $error);
    
    // For API calls, return JSON error
    if (strpos($_SERVER['REQUEST_URI'], 'send.php') !== false) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Database connection failed. Please try again later.']);
        exit;
    }
    die("Connection failed: " . $error);
}

$conn->set_charset("utf8mb4");
error_log("Successfully connected to TiDB Cloud");
?>