<?php
$host = 'gateway01.ap-southeast-1.prod.aws.tidbcloud.com';
$username = '4KfxBVX3fQLSFAe.root';
$password = 'arx3ZHVQMQnH0Exq';
$database = 'portfolio';
$port = 4000;

// Create connection with SSL
$conn = mysqli_init();

// Set SSL options (no certificate required for TiDB Serverless)
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);
mysqli_options($conn, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, false);

// Connect with SSL
if (!mysqli_real_connect($conn, $host, $username, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL)) {
    die("Connection failed: " . mysqli_connect_error());
}

$conn->set_charset("utf8mb4");
?>