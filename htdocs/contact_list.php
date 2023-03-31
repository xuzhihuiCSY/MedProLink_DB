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
$sql = "SELECT users.first_name, users.last_name, users.status FROM users INNER JOIN profiles ON users.id = profiles.user_id WHERE users.id != $current_user_id";

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

<!-- Display current user's data -->
<div>
    <h2><?php echo $current_user_data['first_name'] . ' ' . $current_user_data['last_name']; ?></h2>
    <p>Status: <?php echo $current_user_data['status']; ?></p>
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
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="2">No results found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<a href="personal_profile_edit.php">Edit Profile</a>
