<?php
error_reporting(E_ALL);
ini_set('log_errors', 1);

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Sanitize inputs
$name    = trim(htmlspecialchars($_POST['name']    ?? ''));
$email   = trim(filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL));
$message = trim(htmlspecialchars($_POST['message'] ?? ''));

// Validate
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

$dbSaved       = false;
$emailSent     = false;
$emailError    = '';

// ── 1. Save to TiDB / MySQL ──────────────────────────────────────────
try {
    // Auto-create table if it doesn't exist
    $conn->query("CREATE TABLE IF NOT EXISTS contact (
        id         INT AUTO_INCREMENT PRIMARY KEY,
        name       VARCHAR(255)  NOT NULL,
        email      VARCHAR(255)  NOT NULL,
        message    TEXT          NOT NULL,
        created_at TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_created_at (created_at)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    $stmt = $conn->prepare("INSERT INTO contact (name, email, message, created_at) VALUES (?, ?, ?, NOW())");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("sss", $name, $email, $message);
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }
    $stmt->close();
    $dbSaved = true;
    error_log("Contact saved to DB — name: $name, email: $email");

} catch (Exception $e) {
    error_log("DB error: " . $e->getMessage());
    // Don't exit — still try to send email
}

// ── 2. Send email via Gmail SMTP ─────────────────────────────────────
try {
    $smtpUser = getenv('SMTP_USERNAME') ?: 'joshuamacatangayrabulan@gmail.com';
    $smtpPass = getenv('SMTP_PASSWORD') ?: 'sdmokppdxgscpyhe';   // App Password — no spaces
    $smtpHost = getenv('SMTP_HOST')     ?: 'smtp.gmail.com';
    $smtpPort = (int)(getenv('SMTP_PORT') ?: 587);
    $notifyTo = getenv('NOTIFY_EMAIL')  ?: 'joshuamacatangayrabulan@gmail.com';

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = $smtpHost;
    $mail->SMTPAuth   = true;
    $mail->Username   = $smtpUser;
    $mail->Password   = $smtpPass;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = $smtpPort;
    $mail->Timeout    = 30;

    $mail->setFrom($smtpUser, 'Joshua Rabulan Portfolio');
    $mail->addAddress($notifyTo);
    $mail->addReplyTo($email, $name);
    $mail->Subject = "📬 New Portfolio Message from $name";
    $mail->isHTML(true);
    $mail->Body = "
        <div style='font-family:Arial,sans-serif;max-width:500px;margin:0 auto;border:1px solid #ddd;border-radius:8px;overflow:hidden;'>
            <div style='background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);padding:20px;color:#fff;'>
                <h2 style='margin:0;'>✨ New Portfolio Message</h2>
            </div>
            <div style='padding:20px;'>
                <p><strong>👤 Name:</strong> " . htmlspecialchars($name) . "</p>
                <p><strong>📧 Email:</strong> <a href='mailto:" . htmlspecialchars($email) . "'>" . htmlspecialchars($email) . "</a></p>
                <p><strong>💬 Message:</strong></p>
                <div style='background:#f5f5f5;padding:10px;border-radius:5px;'>" . nl2br(htmlspecialchars($message)) . "</div>
            </div>
            <div style='background:#f9f9f9;padding:10px;text-align:center;font-size:12px;color:#888;'>
                Sent from your portfolio contact form &bull; " . date('F j, Y g:i A') . "
            </div>
        </div>";
    $mail->AltBody = "Name: $name\nEmail: $email\nMessage:\n$message\n\nSent: " . date('Y-m-d H:i:s');

    $mail->send();
    $emailSent = true;
    error_log("Email sent successfully to $notifyTo");

} catch (Exception $e) {
    $emailError = $e->getMessage();
    error_log("PHPMailer error: " . $emailError);
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

if (isset($conn) && $conn) {
    $conn->close();
}
