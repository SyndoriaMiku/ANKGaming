<?php
$host = 'localhost';
$db = 'ank_store';
$user = 'root';
$password = '';

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>
