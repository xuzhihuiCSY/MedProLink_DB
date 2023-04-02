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
$chat_partner_id = $_GET['partner_id'];

// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $message = $_POST['message'];

    // Insert message into database
    $sql = "INSERT INTO messages (sender_id, receiver_id, message) VALUES ($current_user_id, $chat_partner_id, '$message')";
    $conn->query($sql);
}

// Get messages between the current user and the chat partner
$sql = "SELECT * FROM messages WHERE (sender_id = $current_user_id AND receiver_id = $chat_partner_id) OR (sender_id = $chat_partner_id AND receiver_id = $current_user_id) ORDER BY created_at ASC";
$result = $conn->query($sql);

// Get the names of the current user and the chat partner
$sql_current_user = "SELECT first_name, last_name FROM users INNER JOIN profiles ON users.id = profiles.user_id WHERE users.id = $current_user_id";
$result_current_user = $conn->query($sql_current_user);
$current_user_data = $result_current_user->fetch_assoc();

$sql_chat_partner = "SELECT first_name, last_name FROM users INNER JOIN profiles ON users.id = profiles.user_id WHERE users.id = $chat_partner_id";
$result_chat_partner = $conn->query($sql_chat_partner);
$chat_partner_data = $result_chat_partner->fetch_assoc();

// Close database connection
$conn->close();
?>

<style>
    /* Style for chat messages */
    .chat-container {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 20px;
    }

    .chat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .chat-back {
        color: #333;
        text-decoration: none;
        font-size: 16px;
    }

    .chat-messages {
        overflow-y: scroll;
        height: 80%;
    }

    .chat-message {
        margin-bottom: 10px;
        padding: 5px;
        border-radius: 5px;
    }

    .chat-message-sender {
        background-color: #b2d6ff;
        color: #333;
        text-align: right;
    }

    .chat-message-receiver {
        background-color: #f2f2f2;
        color: #333;
    }

    /* Style for message input form */
    .message-form {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .message-input {
        flex-grow: 1;
        margin-right: 10px;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    .message-send {
        padding: 5px 10px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }
</style>

<!-- Display chat messages -->
<div class="chat-container">
    <div class="chat-header">
        <h2>Chatting with <?php echo $chat_partner_data['first_name'] . ' ' . $chat_partner_data['last_name']; ?></h2>
        <a href="contact_list.php" class="chat-back">Back to Contact List</a>
    </div>
    <div class="chat-messages">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <?php if ($row['sender_id'] === $current_user_id): ?>
                    <div class="chat-message chat-message-sender"><?php echo $row['message']; ?></div>
                <?php else: ?>
                    <div class="chat-message chat-message-receiver"><?php echo $chat_partner_data['first_name'] . ': ' . $row['message']; ?></div>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No messages yet</p>
        <?php endif; ?>
    </div>
</div>

<!-- HTML form -->
<form method="POST" class="message-form">
    <div>
        <input type="text" name="message" class="message-input" placeholder="Type a message...">
        <button type="submit" class="message-send">Send</button>
    </div>
</form>

