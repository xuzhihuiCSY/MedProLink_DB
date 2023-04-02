<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <!-- import style -->
    <link rel="stylesheet" href="Login&register_style.css">
</head>
<body>
    <h1>Register</h1>
    <form action="register.php" method="post">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" required><br><br>
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" required><br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" required><br><br>
        <input type="submit" value="Register">
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </form>
</body>
</html>
