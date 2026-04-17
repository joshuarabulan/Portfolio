<?php
// File: db.php - Updated for Render compatibility

// Use environment variables on Render, fallback to local values
$host = getenv('DB_HOST') ?: "localhost";
$username = getenv('DB_USER') ?: "root";
$password = getenv('DB_PASS') ?: "";
$database = getenv('DB_NAME') ?: "portfolio";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    // On Render, log error but don't die with output (breaks JSON responses)
    error_log("Database connection failed: " . $conn->connect_error);
    $conn = null; // Set to null so we can check later
}
?>