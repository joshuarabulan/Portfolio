<?php
include "../db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

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
    // ── Save to DB (TiDB Cloud) ──
    // Check if table exists, if not create it
    $checkTable = $conn->query("SHOW TABLES LIKE 'contact'");
    if ($checkTable->num_rows == 0) {
        $createTable = "CREATE TABLE IF NOT EXISTS contact (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            message TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $conn->query($createTable);
    }
    
    $stmt = $conn->prepare("INSERT INTO contact (name, email, message, created_at) VALUES (?, ?, ?, NOW())");
    
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {

        // ── Send Gmail notification using Environment Variables ──
        $emailSent = false;
        try {
            $mail = new PHPMailer(true);
            
            // Get SMTP config from environment variables (Render) or use defaults
            $smtpUsername = getenv('SMTP_USERNAME') ?: 'joshuamacatangayrabulan@gmail.com';
            $smtpPassword = getenv('SMTP_PASSWORD') ?: 'sdmo kppd xgsc pyhe';
            
            // Only try to send email if credentials are available
            if (!empty($smtpPassword)) {
                $mail->isSMTP();
                $mail->Host       = getenv('SMTP_HOST') ?: 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = $smtpUsername;
                $mail->Password   = $smtpPassword;
                $mail->SMTPSecure = getenv('SMTP_SECURE') ?: PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = getenv('SMTP_PORT') ?: 587;
                $mail->setFrom($smtpUsername, 'Portfolio Contact');
                $mail->addAddress(getenv('NOTIFICATION_EMAIL') ?: 'joshuamacatangayrabulan@gmail.com');
                $mail->Subject = "New Portfolio Message from $name";
                $mail->isHTML(true);
                $mail->Body = "
                    <div style='font-family: Inter, sans-serif; max-width: 500px; margin: auto; border: 1px solid #e9ecef; border-radius: 12px; overflow: hidden;'>
                        <div style='background: linear-gradient(135deg, #7AAACE, #355872); padding: 20px 24px;'>
                            <h2 style='color: #fff; margin: 0; font-size: 18px;'>📬 New Portfolio Message</h2>
                        </div>
                        <div style='padding: 24px;'>
                            <p style='margin: 0 0 12px;'><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
                            <p style='margin: 0 0 12px;'><strong>Email:</strong> <a href='mailto:" . htmlspecialchars($email) . "'>" . htmlspecialchars($email) . "</a></p>
                            <p style='margin: 0 0 8px;'><strong>Message:</strong></p>
                            <p style='background: #f8f9fa; padding: 12px; border-radius: 8px; margin: 0;'>" . nl2br(htmlspecialchars($message)) . "</p>
                        </div>
                        <div style='padding: 12px 24px; background: #f8f9fa; font-size: 12px; color: #6c757d;'>
                            Sent from your portfolio contact form
                        </div>
                    </div>
                ";
                
                // Plain text alternative for email clients that don't support HTML
                $mail->AltBody = "New Portfolio Message\n\nName: $name\nEmail: $email\nMessage:\n$message";
                
                $mail->send();
                $emailSent = true;
            }
        } catch (Exception $e) {
            // Log email error but don't fail the request
            error_log("PHPMailer Error: " . $e->getMessage());
            $emailSent = false;
        }

        http_response_code(200);
        echo json_encode([
            'success' => true, 
            'message' => 'Message sent successfully!',
            'email_notified' => $emailSent
        ]);

    } else {
        throw new Exception("Execute failed: " . $stmt->error);
    }

    $stmt->close();

} catch (Exception $e) {
    http_response_code(500);
    error_log("Contact form error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'An error occurred. Please try again later.']);
}
?>