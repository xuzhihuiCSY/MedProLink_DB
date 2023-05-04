<?php
// Connect to database
$conn = new mysqli('localhost', 'root', '', 'medprolink_db');

// Start session (place this at the beginning of each PHP file that uses session variables)
session_start();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set default filter and search term
$filter = 'All';
$search_term = '';

// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    if (isset($_POST['filter'])) {
        $filter = $_POST['filter'];
    }
    if (isset($_POST['search_term'])) {
        $search_term = $_POST['search_term'];
    }
}

// Get the current user's data
$current_user_id = $_SESSION['user_id'];
$sql_current_user = "SELECT first_name, last_name, status FROM users INNER JOIN profiles ON users.id = profiles.user_id WHERE users.id = $current_user_id";
$result_current_user = $conn->query($sql_current_user);
$current_user_data = $result_current_user->fetch_assoc();

// Construct SQL query based on filter and search term
$sql = "SELECT users.id, users.first_name, users.last_name, users.status FROM users INNER JOIN profiles ON users.id = profiles.user_id WHERE users.id != $current_user_id";

if ($filter !== 'All') {
    $sql .= " AND FIND_IN_SET('$filter', profiles.titles) > 0";
}

if (!empty($search_term)) {
    $sql .= " AND (users.first_name LIKE '%$search_term%' OR users.last_name LIKE '%$search_term%')";
}

$result = $conn->query($sql);

// Close database connection
$conn->close();
?>

<style>
    /*
    div {
        background-color: #f2f2f2;
        border: 1px solid #ccc;
        padding: 20px;
        margin-bottom: 20px;
    }*/

    h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }
    p {
        margin: 5px 0;
    }
    a {
        text-decoration: none;
        color: white;
    }
    form {
        margin-bottom: 20px;
    }
   

    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ccc;
    }
    th {
        background-color: #f2f2f2;
        font-weight: normal;
    }

    /* CSS for the filter buttons */
    body{
        margin:0;
    padding:0;
    font-family: sans-serif;
    background: linear-gradient(#141e30, #243b55);

  
}

ul{
  padding:0;
  list-style:none;

}

ul li{
  box-sizing:border-box;
  width:15em;
  height:3em;
  font-size:20px;
  border-radius:0.5em;
  margin:0.5em;
  box-shadow:0 0 1em rgba(0,0,0,0.2);
  color:white;
  font-family:sans-serif;
  text-transform:capitalize;
  line-height:3em;
  transition:0.3s;
  cursor:pointer;
  display: inline-block;
}

ul li:nth-child(odd){
  background:linear-gradient(to right,orange,tomato);
  text-align:left;
  padding-left:10%;
  transform:perspective(500px) rotateY(45deg);
}
ul li:nth-child(even){
  background:linear-gradient(to left,orange,tomato);
  text-align:right;
  padding-right:10%;
  transform:perspective(500px) rotateY(-45deg);
}
ul li:nth-child(odd):hover{
  transform:perspective(200px) rotateY(45deg);
  padding-left:5%;

}

ul li:nth-child(even):hover{
  transform:perspective(200px) rotateY(-45deg);
  padding-right:5%;

}
ul li button {
    background: transparent;
    border: none;
    font-size: 18px; /* Change this value to adjust the size of the text */
    color: white;
}

/* CSS for the search box */
button.login-button {
    background:  rgba(0,0,0,.5);
}
.login-box .user-box input:focus ~ label,
.login-box .user-box input:valid ~ label{
    top: -20px;
    left: 0;
    color: #03e9f4;
    font-size: 12px;
}


.login-button,
.button.login-button{
    position: relative;
    display: inline-block;
    padding: 10px 20px;
    color: #03e9f4;
    font-size: 16px;
    text-decoration: none;
    overflow: hidden;
    transition: .5s;
    margin-top: 40px;
    letter-spacing: 4px;
}

.login-button:hover,
.button.login-button:hover
{ 

    background : #03e9f4;
    color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 5px #03e9f4,
                0 0 25px #03e9f4,
                0 0 50px #03e9f4,
                0 0 100px #03e9f4;

}

.login-box a span,
.login-box form .login-button span,
.login-button span{
    position: absolute;
    display: block;
}

.login-box a span:nth-child(1),
.login-box form .login-button span:nth-child(1),
.login-button span:nth-child(1)
{
    top: 0;
    left: -100%;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg,transparent,#03e9f4);
    animation: btn-anim1 1s linear infinite;
}

@keyframes btn-anim1{
    0%{
        left: -100%;
    }
    50%,100%{
        left: 100%;
    }

}
.login-box a span:nth-child(2),
.login-box form .login-button span:nth-child(2),
.login-button span:nth-child(2){
    top: -100%;
    right: 0;
    width: 2px;
    height: 100%;
    background: linear-gradient(180deg,transparent,#03e9f4);
    animation: btn-anim2 1s linear infinite;
    animation-delay: .25s;

}
@keyframes btn-anim2{
    0%{
        top: -100%;
    }
    50%,100%{
        top: 100%;
    }

}
.login-box a span:nth-child(3),
.login-box form .login-button span:nth-child(3),
.login-button span:nth-child(3){
    bottom: 0;
    right: -100%;
    width: 100%;
    height: 2px;
    background: linear-gradient(270deg,transparent,#03e9f4);
    animation: btn-anim3 1s linear infinite;
    animation-delay: .5s;

}
@keyframes btn-anim3{
    0%{
        right: -100%;
    }
    50%,100%{
        right: 100%;
    }

}
.login-box a span:nth-child(4),
.login-box form .login-button span:nth-child(4),
.login-button span:nth-child(4){
    bottom: -100%;
    left: 0;
    width: 2px;
    height: 100%;
    background: linear-gradient(360deg,transparent,#03e9f4);
    animation: btn-anim4 1s linear infinite;
    animation-delay: .75s;

}
@keyframes btn-anim4{
    0%{
        bottom: -100%;
    }
    50%,100%{
        bottom: 100%;
    }

}


table th {
    color: #03e9f4;
}
table td{
    color:white;

}


/*title only*/

@import url("https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900");



.content {
	
    margin-top:0px;
    text-align: center;
    
}


.content h2 {
	color: #fff;
	font-size: 8em;
	position: absolute;
	transform: translate(-50%, -50%);
    text-align: center;
    left: 60%;
}

.content h2:nth-child(1) {
	color: transparent;
	-webkit-text-stroke: 2px #389eec;
}

.content h2:nth-child(2) {
	color: #389eec;
	animation: animate 4s ease-in-out infinite;
}

@keyframes animate {
	0%,
	100% {
		clip-path: polygon(
			0% 45%,
			16% 44%,
			33% 50%,
			54% 60%,
			70% 61%,
			84% 59%,
			100% 52%,
			100% 100%,
			0% 100%
		);
	}

	50% {
		clip-path: polygon(
			0% 60%,
			15% 65%,
			34% 66%,
			51% 62%,
			67% 50%,
			84% 45%,
			100% 46%,
			100% 100%,
			0% 100%
		);
	}
}


</style>

<div class="content">
        <h2>MedLinkPro</h2>
        <h2>MedLinkPro</h2>
    </div>


<!-- Display current user's data -->
<div>
    <h2 style="display: inline-block; color: #03e9f4;"><?php echo $current_user_data['first_name'] . ' ' . $current_user_data['last_name']; ?></h2>
<p style="display: inline-block; color: #03e9f4;">Status: <?php echo $current_user_data['status']; ?></p>
<form method="POST" action="logout.php" style="display: inline-block;">
    <button type="submit" name="logout" class="login-button">
        Logout
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </button>
</form>
<h4>
    <a href="personal_profile_edit.php" class="button login-button">Edit Profile</a>
</h4>
</div>
<!-- HTML form -->
<form>
    <!-- Your form fields here -->
    <div>
        <ul>
            <li><button type="submit" name="filter" value="All">All</li>
            <li><button type="submit" name="filter" value="Doctors">Doctors</button></li>
            <li><button type="submit" name="filter" value="Nurses">Nurses</button></li>
            <li><button type="submit" name="filter" value="Pharmaceutical Suppliers">Pharmaceutical Suppliers</button></li>
            <li><button type="submit" name="filter" value="Medical Daily Necessities Suppliers">Medical Daily Necessities Suppliers</button></li>
            <li><button type="submit" name="filter" value="Surgical Supplies Suppliers">Surgical Supplies Suppliers</button></li>
            <li><button type="submit" name="filter" value="Electronic Equipment Suppliers">Electronic Equipment Suppliers</button></li>
        </ul>
    </div>
</form>
<!-- Display search results -->
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Status</th>
            <th>Action</th>
            <th>Chat</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><a href="profile.php?id=<?php echo $row['id']; ?>" style="text-decoration: underline;">View Profile</a></td>
                    <td><a href="chatroom.php?partner_id=<?php echo $row['id']; ?>" style="text-decoration: underline;">Chat</a></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No results found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
