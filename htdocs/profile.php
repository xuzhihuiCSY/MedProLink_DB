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
  @property --rotate{
    syntax:"<angle>";
    initial-value:132deg;
    inherits:false;
  }
  :root {
    --card-height:70vh;
    --card-width:calc(var(--card-height) /1.0);

  }
  body{
    min-height: 100vh;
    background: linear-gradient(#141e30, #243b55);
    display: flex;
    align-items: center;
    flex-direction: column;
    padding-top: 2rem;
    padding-bottom: 2rem;
    box-sizing:border-box;    
  }

  .card{
    background:#191c29;
    width:var(--card-width);
    height:var(--card-height);
    padding:3px;
    position:relative;
    border-radius: 6px;
    justify-content:center;
    align-items:center;
    text-align:center;
    display:flex;
    font-size:1.2em;
    color: white;
    cursor: pointer;
    font-family: "Times New Roman", Times, serif;
  }
  .card:hover{
    color:rgb(88 199 250 /100);
    transition: color 1s;
  }
  .card:hover:before, .card:hover:after{
    animation:none;
    opacity:0;

  }
  .card::before{
    content:"";
    width:104%;
    height:102%;
    border-radius:8px;
    background-image:linear-gradient(var(--rotate),#5ddcff,#3c67e3 43%,#4e00c2);
    position:absolute;
    z-index:-1;
    top:-1%;
    left:-2%;
    animation:spin 2.5s linear infinite;

  }
  .card::after{
    position:absolute;
    content:"";
    top:calc(var(--card-height) /8);
    left:0;
    right:0;
    z-index:-1;
    height:100%;
    width:100%;
    margin:0 auto;
    transform:scale(0.8);
    filter:blur(calc(var(--card-height) / 6));
    background-image:linear-gradient(var(--rotate),#5ddcff,#3c67e3 43%,#4e00c2);
    opacity:1;
    transition: opacity .5s;
    animation:spin 2.5s linear infinite;
  }
  @keyframes spin{
    0%{
      filter:hue-rotate(0deg);
    }
    100%{
      filter:hue-rotate(360deg);
    }
  }
  a{
    color:#212534;
    text-decoration:none;
    font-family:sans-serif;
    font-weight:bold;
    margin-top:2rem;
  }
</style>
<!-- Display profile data -->

<div class="card">
    <h2 class="card"><?php echo $profile_data['first_name'] . ' ' . $profile_data['last_name']; ?></h2>
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