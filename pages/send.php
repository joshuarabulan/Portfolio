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
    // ── Save to DB ──
    $stmt = $conn->prepare("INSERT INTO contact (name, email, message, created_at) VALUES (?, ?, ?, NOW())");
    
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {

        // ── Send Gmail notification ──
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'joshuamacatangayrabulan@gmail.com';   // ← your Gmail here
            $mail->Password   = 'sdmo kppd xgsc pyhe';     // ← Gmail App Password here
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('joshuamacatangayrabulan@gmail.com', 'Portfolio');  // ← your Gmail here
            $mail->addAddress('joshuamacatangayrabulan@gmail.com');    // ← where notif goes
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
        } catch (Exception $e) {
            // Mail failed silently — DB save still succeeded
        }

        http_response_code(200);
        echo json_encode(['success' => true, 'message' => 'Message sent!']);

    } else {
        throw new Exception("Execute failed: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
 catch (Exception $e) {
        http_response_code(500);
        // For security, you might want to log the error instead of exposing it in the response
    // to this temporarily:
    echo json_encode(['mail_error' => $e->getMessage()]);
}
?>


