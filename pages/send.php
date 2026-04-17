<?php
require_once __DIR__ . '/../db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
    // ── Save to DB using PDO (only if connection exists) ──
    if (isset($conn) && $conn) {
        $sql = "INSERT INTO contact (name, email, message, created_at) VALUES (:name, :email, :message, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':message' => $message
        ]);
    }

    // ── Send Email via PHPMailer ──
    $mail = new PHPMailer(true);
    
    // SMTP Configuration
    $mail->isSMTP();
    $mail->Host       = getenv('SMTP_HOST') ?: 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = getenv('SMTP_USERNAME') ?: 'joshuamacatangayrabulan@gmail.com';
    $mail->Password   = getenv('SMTP_PASSWORD') ?: 'sdmo kppd xgsc pyhe';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = getenv('SMTP_PORT') ?: 587;
    
    // Email Headers
    $mail->setFrom($mail->Username, 'Joshua Rabulan Portfolio');
    $mail->addAddress('joshuamacatangayrabulan@gmail.com', 'Joshua Rabulan');
    $mail->addReplyTo($email, $name);
    
    // Email Content
    $mail->Subject = "New Contact Form Message from $name";
    $mail->isHTML(true);
    $mail->Body = "
        <div style='font-family: Inter, sans-serif; max-width: 500px; margin: auto; border: 1px solid #e9ecef; border-radius: 12px; overflow: hidden;'>
            <div style='background: linear-gradient(135deg, #7AAACE, #355872); padding: 20px 24px;'>
                <h2 style='color: #fff; margin: 0; font-size: 18px;'>📬 New Portfolio Message</h2>
            </div>
            <div style='padding: 24px;'>
                <p style='margin: 0 0 12px;'><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
                <p style='margin: 0 0 12px;'><strong>Email:</strong> <a href='mailto:$email'>" . htmlspecialchars($email) . "</a></p>
                <p style='margin: 0 0 8px;'><strong>Message:</strong></p>
                <p style='background: #f8f9fa; padding: 12px; border-radius: 8px; margin: 0;'>" . nl2br(htmlspecialchars($message)) . "</p>
            </div>
            <div style='padding: 12px 24px; background: #f8f9fa; font-size: 12px; color: #6c757d;'>
                Sent from your portfolio contact form<br>
                Time: " . date('Y-m-d H:i:s') . "
            </div>
        </div>
    ";
    
    $mail->AltBody = "Name: $name\nEmail: $email\nMessage:\n$message\n\nSent from your portfolio contact form";
    
    $mail->send();
    
    // Success response
    http_response_code(200);
    echo json_encode(['success' => true, 'message' => 'Message sent successfully!']);
    
} catch (Exception $e) {
    // Error response
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Failed to send message: ' . $e->getMessage()]);
}
?>