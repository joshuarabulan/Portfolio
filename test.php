<?php
$host = 'gateway01.ap-southeast-1.prod.aws.tidbcloud.com';
$user = '4KfxBVX3fQLSFAe.root';
$pass = 'arx3ZHVQMQnH0Exq';
$db = 'portfolio';
$port = 4000;

echo "Testing connection to TiDB Cloud...<br>";

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    echo "❌ FAILED: " . $conn->connect_error;
} else {
    echo "✅ SUCCESS! Connected to TiDB Cloud!<br>";
    
    $result = $conn->query("SELECT NOW() as time");
    $row = $result->fetch_assoc();
    echo "Server time: " . $row['time'] . "<br>";
    
    $conn->close();
}
?>