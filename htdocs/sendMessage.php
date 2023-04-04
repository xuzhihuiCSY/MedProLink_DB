<?php
// Connect to database
$conn = new mysqli('localhost', 'root', '', 'medprolink_db');

// Start session (place this at the beginning of each PHP file that uses session variables)
session_start();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the current user's ID
$current_user_id = $_SESSION['user_id'];

// Get the ID of the user that the current user wants to chat with
$chat_partner_id = $_POST['partner_id'];

// Get the message that the current user wants to send
$message = $_POST['message'];

// Insert the new message into the database
$sql = "INSERT INTO messages (sender_id, receiver_id, message) VALUES ($current_user_id, $chat_partner_id, '$message')";
$conn->query($sql);

// Close database connection
$conn->close();
?>
