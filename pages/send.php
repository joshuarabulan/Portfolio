<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

if (empty($name) || empty($email) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'All fields required']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email']);
    exit;
}

$response = ['success' => false, 'message' => '', 'db_saved' => false, 'email_sent' => false];

try {
    // Save to database
    $stmt = $conn->prepare("INSERT INTO contact (name, email, message, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $name, $email, $message);
    
    if ($stmt->execute()) {
        $response['db_saved'] = true;
        $response['success'] = true;
        $response['message'] = 'Message saved to database';
    }
    $stmt->close();
    
    // Send email
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'joshuamacatangayrabulan@gmail.com';
        $mail->Password = 'sdmo kppd xgsc pyhe';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom('joshuamacatangayrabulan@gmail.com', 'Portfolio Contact');
        $mail->addAddress('joshuamacatangayrabulan@gmail.com');
        $mail->Subject = "New message from $name";
        $mail->isHTML(true);
        $mail->Body = "
            <h3>New Contact Form Submission</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Message:</strong></p>
            <p>$message</p>
            <hr>
            <p><small>Sent from your portfolio website</small></p>
        ";
        $mail->AltBody = "New message from $name\nEmail: $email\nMessage:\n$message";
        $mail->send();
        $response['email_sent'] = true;
    } catch (Exception $e) {
        // Email failed but database saved
    }
    
    echo json_encode($response);
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>