<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

if (empty($name) || empty($email) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'All fields required']);
    exit;
}

// Save to database (using SSL connection from db.php)
$stmt = $conn->prepare("INSERT INTO contact (name, email, message, created_at) VALUES (?, ?, ?, NOW())");
$stmt->bind_param("sss", $name, $email, $message);
$stmt->execute();
$stmt->close();

// Send email
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'joshuamacatangayrabulan@gmail.com';
$mail->Password = 'sdmo kppd xgsc pyhe';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->setFrom('joshuamacatangayrabulan@gmail.com', 'Portfolio');
$mail->addAddress('joshuamacatangayrabulan@gmail.com');
$mail->Subject = "Message from $name";
$mail->Body = "Name: $name\nEmail: $email\nMessage:\n$message";
$mail->send();

echo json_encode(['success' => true, 'message' => 'Message sent']);
?>