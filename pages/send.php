<?php
// Enable error logging for debugging on Render
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');

// Include database connection
require_once __DIR__ . '/../db.php';  // Changed to absolute path

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once __DIR__ . '/../vendor/autoload.php';  // Changed to absolute path

header('Content-Type: application/json');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Sanitize and validate inputs
$name    = trim(htmlspecialchars($_POST['name'] ?? ''));
$email   = trim(filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL));
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

$response = ['success' => false, 'message' => '', 'email_notified' => false];
$dbSaved = false;

try {
    // ── Ensure contact table exists ──
    $tableCheck = $conn->query("SHOW TABLES LIKE 'contact'");
    if (!$tableCheck) {
        error_log("Table check failed: " . $conn->error);
    } elseif ($tableCheck->num_rows == 0) {
        $createTableSQL = "CREATE TABLE IF NOT EXISTS contact (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            message TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            INDEX idx_created_at (created_at)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
        
        if ($conn->query($createTableSQL)) {
            error_log("Contact table created successfully");
        } else {
            error_log("Failed to create contact table: " . $conn->error);
        }
    }

    // ── Insert into database ──
    $stmt = $conn->prepare("INSERT INTO contact (name, email, message, created_at) VALUES (?, ?, ?, NOW())");
    
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        $dbSaved = true;
        $response['success'] = true;
        $response['message'] = 'Message saved successfully!';
        error_log("Message saved to database from: $email");
    } else {
        throw new Exception("Execute failed: " . $stmt->error);
    }
    
    $stmt->close();

    // ── Send email notification (try, but don't fail if it doesn't work) ──
    try {
        $mail = new PHPMailer(true);
        
        // Get SMTP config from environment variables or use defaults
        $smtpUsername = getenv('SMTP_USERNAME') ?: 'joshuamacatangayrabulan@gmail.com';
        $smtpPassword = getenv('SMTP_PASSWORD') ?: 'sdmo kppd xgsc pyhe';
        $smtpHost = getenv('SMTP_HOST') ?: 'smtp.gmail.com';
        $smtpPort = getenv('SMTP_PORT') ?: 587;
        $smtpSecure = getenv('SMTP_SECURE') ?: 'tls';
        $notificationEmail = getenv('NOTIFICATION_EMAIL') ?: 'joshuamacatangayrabulan@gmail.com';
        
        // Only attempt email if password is set
        if (!empty($smtpPassword)) {
            $mail->isSMTP();
            $mail->Host = $smtpHost;
            $mail->SMTPAuth = true;
            $mail->Username = $smtpUsername;
            $mail->Password = $smtpPassword;
            
            // Set encryption based on port
            if ($smtpPort == 465) {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            } else {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            }
            
            $mail->Port = $smtpPort;
            $mail->Timeout = 30;
            
            // Email content
            $mail->setFrom($smtpUsername, 'Joshua Rabulan Portfolio');
            $mail->addAddress($notificationEmail);
            $mail->addReplyTo($email, $name);
            $mail->Subject = "📬 New Portfolio Message from $name";
            $mail->isHTML(true);
            
            $mail->Body = "
                <!DOCTYPE html>
                <html>
                <head>
                    <style>
                        body { font-family: Arial, sans-serif; }
                        .container { max-width: 500px; margin: 0 auto; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; }
                        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 20px; color: white; }
                        .content { padding: 20px; }
                        .field { margin-bottom: 15px; }
                        .label { font-weight: bold; color: #555; }
                        .message-box { background: #f5f5f5; padding: 10px; border-radius: 5px; margin-top: 5px; }
                        .footer { background: #f9f9f9; padding: 10px; text-align: center; font-size: 12px; color: #888; }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <div class='header'>
                            <h2 style='margin: 0;'>✨ New Portfolio Message</h2>
                        </div>
                        <div class='content'>
                            <div class='field'>
                                <div class='label'>👤 Name:</div>
                                <div>" . htmlspecialchars($name) . "</div>
                            </div>
                            <div class='field'>
                                <div class='label'>📧 Email:</div>
                                <div><a href='mailto:" . htmlspecialchars($email) . "'>" . htmlspecialchars($email) . "</a></div>
                            </div>
                            <div class='field'>
                                <div class='label'>💬 Message:</div>
                                <div class='message-box'>" . nl2br(htmlspecialchars($message)) . "</div>
                            </div>
                        </div>
                        <div class='footer'>
                            Sent from your portfolio contact form • " . date('F j, Y g:i A') . "
                        </div>
                    </div>
                </body>
                </html>
            ";
            
            $mail->AltBody = "New Portfolio Message\n\nName: $name\nEmail: $email\nMessage:\n$message\n\nSent: " . date('Y-m-d H:i:s');
            
            if ($mail->send()) {
                $response['email_notified'] = true;
                error_log("Email notification sent to: $notificationEmail");
            } else {
                error_log("Email send failed: " . $mail->ErrorInfo);
            }
        } else {
            error_log("Email not sent - SMTP password not configured or using default");
            $response['email_notified'] = false;
        }
        
    } catch (Exception $e) {
        // Log email error but don't fail the request
        error_log("PHPMailer Error: " . $e->getMessage());
        $response['email_notified'] = false;
    }
    
    // Return success response
    http_response_code(200);
    $response['message'] = $dbSaved ? 'Message sent successfully!' : 'Message saved but notification failed.';
    echo json_encode($response);

} catch (Exception $e) {
    // Log the error
    error_log("Contact form error: " . $e->getMessage());
    error_log("Stack trace: " . $e->getTraceAsString());
    
    // Return error response
    http_response_code(500);
    echo json_encode([
        'success' => false, 
        'message' => 'An error occurred. Please try again later.',
        'debug' => getenv('RENDER') ? null : $e->getMessage()  // Only show debug in development
    ]);
} finally {
    // Close database connection if it exists
    if (isset($conn) && $conn) {
        $conn->close();
    }
}
?>