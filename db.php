<?php
$host     = getenv('DB_HOST')     ?: 'gateway01.ap-southeast-1.prod.aws.tidbcloud.com';
$username = getenv('DB_USER')     ?: '4KfxBVX3fQLSFAe.root';
$password = getenv('DB_PASSWORD') ?: 'arx3ZHVQMQnH0Exq';
$database = getenv('DB_NAME')     ?: 'portfolio';
$port     = (int)(getenv('DB_PORT') ?: 4000);

$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);
mysqli_options($conn, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, false);

if (!mysqli_real_connect($conn, $host, $username, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL)) {
    $err = mysqli_connect_error();
    error_log("DB connection failed: " . $err);
    // Return JSON error if called from send.php, otherwise die gracefully
    if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], 'send.php') !== false) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Database connection failed. Please try again later.']);
        exit;
    }
    die("Connection failed: " . $err);
}

$conn->set_charset("utf8mb4");
