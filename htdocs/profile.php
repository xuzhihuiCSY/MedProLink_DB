<?php
// Connect to database
$conn = new mysqli('localhost', 'root', '', 'medprolink_db');

// Start session (place this at the beginning of each PHP file that uses session variables)
session_start();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the profile ID from the URL
if (isset($_GET['id'])) {
    $profile_id = $_GET['id'];
} else {
    // If ID not provided, redirect to contact list page
    header('Location: contact_list.php');
}

// Get the profile data
$sql_profile = "SELECT * FROM profiles JOIN users ON profiles.user_id = users.id WHERE profiles.user_id = $profile_id";
$result_profile = $conn->query($sql_profile);
$profile_data = $result_profile->fetch_assoc();

// Close database connection
$conn->close();
?>

<!-- Display profile data -->
<div>
    <h2><?php echo $profile_data['first_name'] . ' ' . $profile_data['last_name']; ?></h2>
    <p>Email: <?php echo $profile_data['email']; ?></p>
    <p>Address: <?php echo $profile_data['address']; ?></p>
    <p>City: <?php echo $profile_data['city']; ?></p>
    <p>Country: <?php echo $profile_data['country']; ?></p>
    <p>Zipcode: <?php echo $profile_data['zipcode']; ?></p>
    <p>Phone Number: <?php echo $profile_data['phone_number']; ?></p>
    <p>Titles: <?php echo $profile_data['titles']; ?></p>
</div>

<a href="contact_list.php">Back to Contact List</a>
