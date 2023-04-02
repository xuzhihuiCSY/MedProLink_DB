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
    div {
        background-color: #f2f2f2;
        border: 1px solid #ccc;
        padding: 20px;
        margin-bottom: 20px;
    }
    h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }
    p {
        margin: 5px 0;
    }
    a {
        text-decoration: none;
        color: #0066cc;
    }
    form {
        margin-bottom: 20px;
    }
    input[type="text"] {
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 10px;
    }
    button[type="submit"] {
        padding: 5px 10px;
        background-color: #0066cc;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    button[type="submit"]:hover {
        background-color: #0052cc;
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
</style>

<!-- Display current user's data -->
<div>
    <h2 style="display: inline-block;"><?php echo $current_user_data['first_name'] . ' ' . $current_user_data['last_name']; ?></h2>
    <p style="display: inline-block;">Status: <?php echo $current_user_data['status']; ?></p>
    <form method="POST" action="logout.php" style="display: inline-block;">
        <button type="submit" name="logout">Logout</button>
    </form>
    <h4>
    <a href="personal_profile_edit.php">Edit Profile</a>
    </h4>
</div>
<!-- HTML form -->
<form method="POST">
    <div>
        <input type="text" name="search_term" placeholder="Search by name...">
        <button type="submit">Search</button>
    </div>
    <div>
        <button type="submit" name="filter" value="All">All</button>
        <button type="submit" name="filter" value="Doctors">Doctors</button>
        <button type="submit" name="filter" value="Nurses">Nurses</button>
        <button type="submit" name="filter" value="Pharmaceutical Suppliers">Pharmaceutical Suppliers</button>
        <button type="submit" name="filter" value="Medical Daily Necessities Suppliers">Medical Daily Necessities Suppliers</button>
        <button type="submit" name="filter" value="Surgical Supplies Suppliers">Surgical Supplies Suppliers</button>
        <button type="submit" name="filter" value="Electronic Equipment Suppliers">Electronic Equipment Suppliers</button>
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
                    <td><a href="profile.php?id=<?php echo $row['id']; ?>">View Profile</a></td>
                    <td><a href="chatroom.php?partner_id=<?php echo $row['id']; ?>">Chat</a></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No results found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
