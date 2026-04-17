<?php
// Enable error logging for debugging on Render
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');

// Include database connection
require_once __DIR__ . '/../db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';  // FIXED: removed the '...'

header('Content-Type: application/json');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Sanitize and validate inputs
$name = trim(htmlspecialchars($_POST['name'] ?? ''));  // FIXED: htmlspecialchars and $_POST
$email = trim(filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL));
$message = trim(htmlspecialchars($_POST['message'] ?? ''));

// Validation
if (empty($name) || empty($email) || empty($message)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
    exit;
}

// Check database connection
if (!isset($conn) || $conn->connect_error) {
    error_log("Database connection failed: " . ($conn->connect_error ?? 'Connection not established'));
    http_response_code(503);
    echo json_encode(['success' => false, 'message' => 'Service temporarily unavailable. Please try again later.']);
    exit;
}

try {
    // Insert into database
    $stmt = $conn->prepare("INSERT INTO contact (name, email, message, created_at) VALUES (?, ?, ?, NOW())");
    
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        error_log("Message saved to database from: $email");
    } else {
        throw new Exception("Execute failed: " . $stmt->error);
    }
    
    $stmt->close();

    // Send email notification
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'joshuamacatangayrabulan@gmail.com';
        $mail->Password = 'sdmo kppd xgsc pyhe';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom('joshuamacatangayrabulan@gmail.com', 'Joshua Rabulan Portfolio');
        $mail->addAddress('joshuamacatangayrabulan@gmail.com');
        $mail->addReplyTo($email, $name);
        $mail->Subject = "New Portfolio Message from $name";
        $mail->isHTML(true);
        $mail->Body = "<strong>Name:</strong> $name<br><strong>Email:</strong> $email<br><strong>Message:</strong><br>$message";
        $mail->AltBody = "Name: $name\nEmail: $email\nMessage:\n$message";
        $mail->send();
        error_log("Email sent successfully to: joshuamacatangayrabulan@gmail.com");
    } catch (Exception $e) {
        error_log("Email failed: " . $e->getMessage());
    }
    
    http_response_code(200);
    echo json_encode(['success' => true, 'message' => 'Message sent successfully!']);

} catch (Exception $e) {
    error_log("Contact form error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'An error occurred. Please try again later.']);
} finally {
    if (isset($conn) && $conn) {
        $conn->close();
    }
}
?>