<?php
// File: pages/send.php

// Fix paths - from pages/ folder, need to go up one level
require_once __DIR__ . '/../db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once __DIR__ . '/../vendor/autoload.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$name    = trim($_POST['name']    ?? '');
$email   = trim($_POST['email']   ?? '');
$message = trim($_POST['message'] ?? '');

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

try {
    // ── Save to DB (if you have database) ──
    if (isset($conn) && $conn) {
        $stmt = $conn->prepare("INSERT INTO contact (name, email, message, created_at) VALUES (?, ?, ?, NOW())");
        if ($stmt) {
            $stmt->bind_param("sss", $name, $email, $message);
            $stmt->execute();
            $stmt->close();
        }
    }

    // ── Send Email via PHPMailer ──
    $mail = new PHPMailer(true);
    
    // Server settings
    $mail->isSMTP();
    $mail->Host       = getenv('SMTP_HOST') ?: 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = getenv('SMTP_USERNAME') ?: 'joshuamacatangayrabulan@gmail.com';
    $mail->Password   = getenv('SMTP_PASSWORD') ?: 'sdmo kppd xgsc pyhe'; // Move to env var!
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = getenv('SMTP_PORT') ?: 587;
    
    // Recipients
    $mail->setFrom($mail->Username, 'Joshua Rabulan Portfolio');
    $mail->addAddress('joshuamacatangayrabulan@gmail.com', 'Joshua Rabulan');
    $mail->addReplyTo($email, $name);
    
    // Content
    $mail->isHTML(true);
    $mail->Subject = "New Contact Form Message from $name";
    $mail->Body = "
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; }
                .container { max-width: 600px; margin: 0 auto; }
                .header { background: #7AAACE; color: white; padding: 20px; text-align: center; }
                .content { padding: 20px; border: 1px solid #ddd; }
                .field { margin-bottom: 15px; }
                .label { font-weight: bold; color: #355872; }
                .message-box { background: #f5f5f5; padding: 15px; border-radius: 5px; margin-top: 10px; }
                .footer { background: #f8f9fa; padding: 10px; text-align: center; font-size: 12px; color: #666; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>📬 New Portfolio Message</h2>
                </div>
                <div class='content'>
                    <div class='field'>
                        <div class='label'>Name:</div>
                        <div>" . htmlspecialchars($name) . "</div>
                    </div>
                    <div class='field'>
                        <div class='label'>Email:</div>
                        <div><a href='mailto:" . htmlspecialchars($email) . "'>" . htmlspecialchars($email) . "</a></div>
                    </div>
                    <div class='field'>
                        <div class='label'>Message:</div>
                        <div class='message-box'>" . nl2br(htmlspecialchars($message)) . "</div>
                    </div>
                </div>
                <div class='footer'>
                    Sent from your portfolio contact form<br>
                    IP: " . $_SERVER['REMOTE_ADDR'] . " | Time: " . date('Y-m-d H:i:s') . "
                </div>
            </div>
        </body>
        </html>
    ";
    
    $mail->AltBody = "Name: $name\nEmail: $email\nMessage:\n$message\n\nSent from your portfolio contact form";
    
    $mail->send();
    
    http_response_code(200);
    echo json_encode(['success' => true, 'message' => 'Message sent successfully!']);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Failed to send message: ' . $e->getMessage()]);
}

// Close database connection if it exists
if (isset($conn) && $conn) {
    $conn->close();
}
?>