<?php
error_reporting(E_ALL);
ini_set('log_errors', 1);

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$name    = trim(htmlspecialchars($_POST['name']    ?? ''));
$email   = trim(filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL));
$message = trim(htmlspecialchars($_POST['message'] ?? ''));

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

$dbSaved   = false;
$emailSent = false;

// ── 1. Save to TiDB ──────────────────────────────────────────────────
try {
    $conn->query("CREATE TABLE IF NOT EXISTS contact (
        id         INT AUTO_INCREMENT PRIMARY KEY,
        name       VARCHAR(255)  NOT NULL,
        email      VARCHAR(255)  NOT NULL,
        message    TEXT          NOT NULL,
        created_at TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_created_at (created_at)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    $stmt = $conn->prepare("INSERT INTO contact (name, email, message, created_at) VALUES (?, ?, ?, NOW())");
    if (!$stmt) throw new Exception("Prepare failed: " . $conn->error);
    $stmt->bind_param("sss", $name, $email, $message);
    if (!$stmt->execute()) throw new Exception("Execute failed: " . $stmt->error);
    $stmt->close();
    $dbSaved = true;
    error_log("Contact saved to DB — name: $name, email: $email");

} catch (Exception $e) {
    error_log("DB error: " . $e->getMessage());
}

// ── 2. Send email using SendGrid API (works on Render free tier) ────
try {
    // Get SendGrid API key from environment variable
    $sendgrid_api_key = getenv('SENDGRID_API_KEY');
    
    if ($sendgrid_api_key) {
        $url = 'https://api.sendgrid.com/v3/mail/send';
        
        $email_data = [
            'personalizations' => [
                [
                    'to' => [
                        ['email' => 'joshuamacatangayrabulan@gmail.com', 'name' => 'Joshua Rabulan']
                    ],
                    'subject' => "New Portfolio Message from $name"
                ]
            ],
            'from' => [
                'email' => 'joshuamacatangayrabulan@gmail.com',
                'name' => 'Joshua Rabulan Portfolio'
            ],
            'reply_to' => [
                'email' => $email,
                'name' => $name
            ],
            'content' => [
                [
                    'type' => 'text/html',
                    'value' => "
                        <div style='font-family:Arial,sans-serif;max-width:500px;margin:0 auto;border:1px solid #ddd;border-radius:8px;overflow:hidden;'>
                            <div style='background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);padding:20px;color:#fff;'>
                                <h2 style='margin:0;'>New Portfolio Message</h2>
                            </div>
                            <div style='padding:20px;'>
                                <p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
                                <p><strong>Email:</strong> <a href='mailto:" . htmlspecialchars($email) . "'>" . htmlspecialchars($email) . "</a></p>
                                <p><strong>Message:</strong></p>
                                <div style='background:#f5f5f5;padding:10px;border-radius:5px;'>" . nl2br(htmlspecialchars($message)) . "</div>
                            </div>
                            <div style='background:#f9f9f9;padding:10px;text-align:center;font-size:12px;color:#888;'>
                                Sent from your portfolio contact form • " . date('F j, Y g:i A') . "
                            </div>
                        </div>"
                ],
                [
                    'type' => 'text/plain',
                    'value' => "Name: $name\nEmail: $email\nMessage:\n$message\n\nSent: " . date('Y-m-d H:i:s')
                ]
            ]
        ];
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $sendgrid_api_key,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($email_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($http_code === 202) {
            $emailSent = true;
            error_log("Email sent successfully via SendGrid");
        } else {
            error_log("SendGrid failed with HTTP $http_code: $response");
        }
    } else {
        error_log("SENDGRID_API_KEY not set in environment variables");
    }

} catch (Exception $e) {
    error_log("Email API error: " . $e->getMessage());
}

// ── 3. Respond ───────────────────────────────────────────────────────
if ($dbSaved || $emailSent) {
    http_response_code(200);
    echo json_encode([
        'success'        => true,
        'message'        => 'Message sent successfully!',
        'db_saved'       => $dbSaved,
        'email_notified' => $emailSent,
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Failed to save your message. Please try again later.',
    ]);
}

if (isset($conn) && $conn) $conn->close();
?>