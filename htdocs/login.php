<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
	<link rel="stylesheet" href="Login&register_style.css">
</head>
<body>
    <h1>Login</h1>
    <form action="login_handler.php" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <input type="submit" value="Login">
        <p>Don't have an account? <a href="index.php">Sign up now</a>.</p>
    </form>
</body>
</html>