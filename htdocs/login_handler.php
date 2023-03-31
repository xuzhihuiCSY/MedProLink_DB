<?php
// Connect to database
$conn = new mysqli('localhost', 'root', '', 'medprolink_db');

// Start session
session_start();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Retrieve user from database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User found, verify password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, set user ID to session variable
            $_SESSION['user_id'] = $row['id'];

            // Update user status to online
            $sql = "UPDATE users SET status = 'online' WHERE id = " . $row['id'];
            if ($conn->query($sql) !== TRUE) {
                echo "Error updating status: " . $conn->error;
            }
            
            
            // Redirect to profile page
            header('Location: contact_list.php');
        } else {
            // Password is incorrect
            die("Incorrect password.");
        }
    } else {
        // User not found
        die("User not found.");
    }
}

// Close database connection
$conn->close();
?>
