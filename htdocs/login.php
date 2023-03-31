<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
</head>
<body>
    <h1>Login</h1>
    <form action="login_handler.php" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        <input type="submit" value="Login">
        <p>Don't have an account? <a href="index.php">Sign up now</a>.</p>
    </form>
</body>
</html>
