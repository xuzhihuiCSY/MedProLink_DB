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

// Close database connection
$conn->close();
?>
<!-- import chatroom.css -->
<link rel="stylesheet" href="chatroom.css">

<a href="contact_list.php">Back to Contact List</a>
<a href="calendar.html"> add event to your google calendar</a>
<div class = "chat-box">
    <!-- Display chat messages -->
    <div id="chat-container">
        <div id="chat-messages"></div>
    </div>
</div>
<!-- HTML form -->
<form method="POST" id="message-form">
    <div>
        <input type="text" name="message" id="message-input" placeholder="Type a message...">
        <button type="submit" id="message-send">Send</button>
    </div>
</form>

<!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- JavaScript code -->
<script>
    // Get chat messages
    function getMessages() {
        $.ajax({
            url: 'getMessage.php',
            type: 'GET',
            data: { partner_id: <?php echo $chat_partner_id; ?> },
            success: function(data) {
                $('#chat-messages').html(data);
                $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
            }
        });
    }

    // Send chat message
    $('#message-form').submit(function(e) {
        e.preventDefault();
        var message = $('#message-input').val();
        $.ajax({
            url: 'sendMessage.php',
            type: 'POST',
            data: { partner_id: <?php echo $chat_partner_id; ?>, message: message },
            success: function(data) {
                $('#message-input').val('');
                getMessages();
            }
        });
    });

    // Poll for new chat messages every 1 seconds
    setInterval(getMessages, 1000);
</script>
