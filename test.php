<?php
$host = 'gateway01.ap-southeast-1.prod.aws.tidbcloud.com';
$username = '4KfxBVX3fQLSFAe.root';
$password = 'arx3ZHVQMQnH0Exq';
$database = 'portfolio';
$port = 4000;

echo "Testing SSL connection to TiDB Cloud...<br>";

$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);
mysqli_options($conn, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, false);

if (mysqli_real_connect($conn, $host, $username, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL)) {
    echo "✅ SUCCESS! Connected with SSL!<br>";
    
    $result = mysqli_query($conn, "SELECT NOW() as time");
    $row = mysqli_fetch_assoc($result);
    echo "Server time: " . $row['time'] . "<br>";
    
    mysqli_close($conn);
} else {
    echo "❌ FAILED: " . mysqli_connect_error();
}
?>