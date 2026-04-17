<?php
$host = 'gateway01.ap-southeast-1.prod.aws.tidbcloud.com';
$username = '4KfxBVX3fQLSFAe.root';
$password = 'arx3ZHVQMQnH0Exq';
$database = 'portfolio';
$port = 4000;

// Simple connection - no SSL, no certificate
$conn = new mysqli($host, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>