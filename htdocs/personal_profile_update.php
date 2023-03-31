<?php
// Connect to database
$conn = new mysqli('localhost', 'root', '', 'medprolink_db');

// Start session
session_start();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID from session variable (assuming you have already implemented login and session management)
$user_id = $_SESSION['user_id'];

// Debugging code - check if user ID is set correctly
if (!$user_id) {
    die("User ID not set");
}

// Retrieve form data
$address = $_POST['address'];
$city = $_POST['city'];
$country = $_POST['country'];
$zipcode = $_POST['zipcode'];
$phone = $_POST['phone'];
$titles = implode(',', $_POST['titles']);

// Debugging code - check if titles variable is set correctly
var_dump($titles);

// Update user data in database
$sql = "UPDATE profiles SET address='$address', city='$city', country='$country', zipcode='$zipcode', phone_number='$phone', titles='$titles' WHERE user_id='$user_id'";

if ($conn->query($sql) === TRUE) {
    // Redirect to contact list page
    header('Location: contact_list.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close database connection
$conn->close();
?>
