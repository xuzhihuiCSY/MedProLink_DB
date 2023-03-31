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
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into database
    $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$hashed_password')";

    try {
        if ($conn->query($sql) === TRUE) {
            // Get the ID of the newly inserted user
            $user_id = $conn->insert_id;
            // Set user ID to session variable
            $_SESSION['user_id'] = $user_id;

            // Insert an empty row into the profiles table for the new user
            $sql = "INSERT INTO profiles (user_id) VALUES ($user_id)";
            if ($conn->query($sql) !== TRUE) {
                echo "Error inserting profile: " . $conn->error;
            }

            // Update user status to online
            $sql = "UPDATE users SET status = 'online' WHERE id = $user_id";
            if ($conn->query($sql) !== TRUE) {
                echo "Error updating status: " . $conn->error;
            }

            // Redirect to profile editing page
            header('Location: personal_profile_edit.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } catch (Exception $e) {
        if ($conn->errno == 1062) {
            // Duplicate email error
            die("Email already exists.");
        } else {
            // Other database error
            die("Error: " . $e->getMessage());
        }
    }

}

// Close database connection
$conn->close();
?>
