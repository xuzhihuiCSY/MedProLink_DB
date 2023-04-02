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
<style>
    .profile-container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }
    .profile-name {
        font-size: 24px;
        font-weight: bold;
        margin-top: 0;
    }
    .profile-details {
        display: block;
        flex-wrap: wrap;
    }
    .profile-detail {
        margin: 10px 0;
        padding: 0;
        display: flex;
        align-items: center;
    }
    .profile-detail span {
        font-weight: bold;
        margin-right: 10px;
        min-width: 100px;
        display: inline-block;
    }
</style>
<!-- Display profile data -->
<div class="profile-container">
    <h2 class="profile-name"><?php echo $profile_data['first_name'] . ' ' . $profile_data['last_name']; ?></h2>
    <div class="profile-details">
        <p class="profile-detail"><span>Email:</span> <?php echo $profile_data['email']; ?></p>
        <p class="profile-detail"><span>Address:</span> <?php echo $profile_data['address']; ?></p>
        <p class="profile-detail"><span>City:</span> <?php echo $profile_data['city']; ?></p>
        <p class="profile-detail"><span>Country:</span> <?php echo $profile_data['country']; ?></p>
        <p class="profile-detail"><span>Zipcode:</span> <?php echo $profile_data['zipcode']; ?></p>
        <p class="profile-detail"><span>Phone Number:</span> <?php echo $profile_data['phone_number']; ?></p>
        <p class="profile-detail"><span>Titles:</span> <?php echo $profile_data['titles']; ?></p>
        <a href="contact_list.php">Back to Contact List</a>
    </div>
</div>