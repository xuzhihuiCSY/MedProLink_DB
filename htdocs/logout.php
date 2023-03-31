<?php
session_start();

// Update user's status to "offline"
$conn = new mysqli('localhost', 'root', '', 'medprolink_db');
$current_user_id = $_SESSION['user_id'];
$sql_update_status = "UPDATE users SET status='Offline' WHERE id=$current_user_id";
$conn->query($sql_update_status);

// Destroy session and redirect to login page
session_destroy();
header('Location: login.php');
exit;
?>
