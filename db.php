<?php
$host     = 'gateway01.ap-southeast-1.prod.alicloud.tidbcloud.com';
$username = '4KfxBVX3fQLSFAe.root';
$password = '3dgyLmHy1pL7sUfi';
$database = 'portfolio';
$port     = 4000;

$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);
mysqli_options($conn, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, false);

if (!mysqli_real_connect($conn, $host, $username, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL)) {
    $err = mysqli_connect_error();
    error_log("DB connection failed: " . $err);
    if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], 'send.php') !== false) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Database connection failed. Please try again later.']);
        exit;
    }
    die("Connection failed: " . $err);
}

$conn->set_charset("utf8mb4");