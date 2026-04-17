<?php
// No database connection needed anymore!

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

header('Content-Type: application/json');

// Allow only POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Get and sanitize form data
$name    = trim($_POST['name']    ?? '');
$email   = trim($_POST['email']   ?? '');
$message = trim($_POST['message'] ?? '');

// Validate inputs
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

// Send email
try {
    $mail = new PHPMailer(true);
    
    // SMTP Configuration
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'joshuamacatangayrabulan@gmail.com';
    $mail->Password   = 'sdmo kppd xgsc pyhe';  // Your App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    
    // Additional settings for Render
    $mail->Timeout = 30;
    $mail->SMTPKeepAlive = false;
    
    // Email content
    $mail->setFrom('joshuamacatangayrabulan@gmail.com', 'Joshua Rabulan Portfolio');
    $mail->addAddress('joshuamacatangayrabulan@gmail.com');  // Send to yourself
    $mail->addReplyTo($email, $name);  // So you can reply directly
    
    $mail->Subject = "📬 New Portfolio Message from $name";
    $mail->isHTML(true);
    
    // HTML email body
    $mail->Body = "
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
                .container { max-width: 500px; margin: 0 auto; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden; }
                .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 20px; color: white; }
                .content { padding: 24px; }
                .field { margin-bottom: 16px; }
                .label { font-weight: bold; color: #555; margin-bottom: 4px; }
                .value { color: #333; }
                .message-box { background: #f5f5f5; padding: 12px; border-radius: 6px; margin-top: 8px; }
                .footer { background: #f9f9f9; padding: 12px; text-align: center; font-size: 12px; color: #888; }
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
                        <div class='value'>" . htmlspecialchars($name) . "</div>
                    </div>
                    <div class='field'>
                        <div class='label'>📧 Email:</div>
                        <div class='value'><a href='mailto:$email'>$email</a></div>
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
    
    // Plain text version for email clients that don't support HTML
    $mail->AltBody = "New message from your portfolio\n\n";
    $mail->AltBody .= "Name: $name\n";
    $mail->AltBody .= "Email: $email\n";
    $mail->AltBody .= "Message:\n$message\n\n";
    $mail->AltBody .= "Sent: " . date('Y-m-d H:i:s');
    
    // Send the email
    $mail->send();
    
    // Success response
    http_response_code(200);
    echo json_encode(['success' => true, 'message' => 'Message sent successfully!']);
    
} catch (Exception $e) {
    // Log the error for debugging
    error_log("Mailer Error: " . $mail->ErrorInfo);
    
    // Return user-friendly error
    http_response_code(500);
    echo json_encode([
        'success' => false, 
        'message' => 'Failed to send message. Please try again later.',
        'debug' => $mail->ErrorInfo  // Remove this line in production
    ]);
}
?>