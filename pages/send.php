<?php
// Fix: Go up one level to find db.php in the root
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
    // Check if database connection exists
    if (!isset($conn) || !$conn) {
        throw new Exception("Database connection failed");
    }
    
    // ── Save to DB ──
    $stmt = $conn->prepare("INSERT INTO contact (name, email, message, created_at) VALUES (?, ?, ?, NOW())");
    
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {

        // ── Send Gmail notification using ENVIRONMENT VARIABLES ──
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host       = getenv('SMTP_HOST') ?: 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = getenv('SMTP_USERNAME') ?: 'joshuamacatangayrabulan@gmail.com';
            $mail->Password   = getenv('SMTP_PASSWORD') ?: 'sdmo kppd xgsc pyhe';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = getenv('SMTP_PORT') ?: 587;

            $mail->setFrom($mail->Username, 'Portfolio Contact');
            $mail->addAddress('joshuamacatangayrabulan@gmail.com');
            $mail->addReplyTo($email, $name);
            
            $mail->Subject = "New Message from $name";
            $mail->isHTML(true);
            $mail->Body = "
                <div style='font-family: Inter, sans-serif; max-width: 500px; margin: auto; border: 1px solid #e9ecef; border-radius: 12px; overflow: hidden;'>
                    <div style='background: linear-gradient(135deg, #7AAACE, #355872); padding: 20px 24px;'>
                        <h2 style='color: #fff; margin: 0; font-size: 18px;'>📬 New Portfolio Message</h2>
                    </div>
                    <div style='padding: 24px;'>
                        <p style='margin: 0 0 12px;'><strong>Name:</strong> $name</p>
                        <p style='margin: 0 0 12px;'><strong>Email:</strong> <a href='mailto:$email'>$email</a></p>
                        <p style='margin: 0 0 8px;'><strong>Message:</strong></p>
                        <p style='background: #f8f9fa; padding: 12px; border-radius: 8px; margin: 0;'>$message</p>
                    </div>
                    <div style='padding: 12px 24px; background: #f8f9fa; font-size: 12px; color: #6c757d;'>
                        Sent from your portfolio contact form
                    </div>
                </div>
            ";

            $mail->send();
            $mail_sent = true;
        } catch (Exception $e) {
            error_log("Mail failed: " . $e->getMessage());
            $mail_sent = false;
        }

        http_response_code(200);
        echo json_encode([
            'success' => true, 
            'message' => 'Message sent!',
            'mail_sent' => $mail_sent
        ]);

    } else {
        throw new Exception("Execute failed: " . $stmt->error);
    }

    $stmt->close();
    if (isset($conn) && $conn) {
        $conn->close();
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>