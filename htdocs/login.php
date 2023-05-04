<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewpoint" content="width=device-width, initial-scale=1">
    <title>Login Form</title>
	<link rel="stylesheet" href="Login.css">
</head>
<body>
   
    <div class="content">
        <h2>MedLinkPro</h2>
        <h2>MedLinkPro</h2>
    </div>
    <div class="login-box">
    <h1>Login</h1>

    <form action="login_handler.php" method="post">
    <div class="user-box">
        <label for="email" id="email-label">Email</label>
        <input type="email" name="email" id="email" placeholder="Email" required>
        </div>
        <div class="user-box">
        <label for="password" id="password-label">Password</label>
        <input type="password" name="password" id="password" placeholder="Password" required>
        </div>
        
<div class="login-button-wrapper">
    <input type="submit" value="Login" class="login-button">
    <br><br>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
</div>
        <p>Don't have an account? <a href="index.php">Sign up now
        <span></span>
    <span></span>
    <span></span>
    <span></span>
        </a></p>
    </form>

<script>
var emailInput = document.getElementById('email');
var emailLabel = document.getElementById('email-label');

emailInput.addEventListener('focus', function() {
    emailLabel.style.display = 'none';
});

emailInput.addEventListener('blur', function() {
    if (emailInput.value === '') {
        emailLabel.style.display = 'block';
    }
});

var passwordInput = document.getElementById('password');
var passwordLabel = document.getElementById('password-label');

passwordInput.addEventListener('focus', function() {
    passwordLabel.style.display = 'none';
});

passwordInput.addEventListener('blur', function() {
    if (passwordInput.value === '') {
        passwordLabel.style.display = 'block';
    }
});
</script>

</body>
</html>