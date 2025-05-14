<?php
require_once "controlleruserdata.php"; 
include('connection.php');
include('tags.php');

function logAction($userId, $action, $details = null) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO audit_trail (user_name, action, details) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $username, $action, $details);
    $stmt->execute();
    $stmt->close();
}
?>
