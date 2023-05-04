<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewpoint" content="width=device-width, initial-scale=1">
    <title>Registration Form</title>
    <!-- import style -->
    <link rel="stylesheet" href="Login.css">
</head>
<style>
   .login-link {
    margin-top: -30px;
}
.login-button-wrapper {
    margin-top: -55px;
}
</style>
<body> 
    <div class="content">
        <h2>MedLinkPro</h2>
        <h2>MedLinkPro</h2>
    </div>
    
    <div class="login-box register-box">
    <h1>Register</h1>
   
    <form action="register.php" method="post">
    <div class="user-box">
        <label for="first_name" id="first_name-label">First Name:</label>
        <input type="text" name="first_name" id="first_name" placeholder="First Name" required>
    </div>
    <div class="user-box">
        <label for="last_name" id="last_name-label">Last Name:</label>
        <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
    </div>
    <div class="user-box">
        <label for="email" id="email-label">Email:</label>
        <input type="email" name="email" id="email" placeholder="Email" required>
    </div>
    <div class="user-box">
        <label for="password" id="password-label">Password:</label>
        <input type="password" name="password" id="password" placeholder="Password" required>
    </div>
    <div class="user-box">
        <label for="confirm_password" id= "confirm_password-label">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
    </div>
    <script>
var firstnameInput = document.getElementById('first_name');
var firstnameLabel = document.getElementById('first_name-label');

firstnameInput.addEventListener('focus', function() {
    firstnameLabel.style.display = 'none';
});

firstnameInput.addEventListener('blur', function() {
    if (firstnameInput.value === '') {
       firstnameLabel.style.display = 'block';
    }
});

var lastnameInput = document.getElementById('last_name');
var lastnameLabel = document.getElementById('last_name-label');
lastnameInput.addEventListener('focus', function() {
    lastnameLabel.style.display = 'none';
});
lastnameInput.addEventListener('blur', function() {
    if (lastnameInput.value === '') {
        lastnameLabel.style.display = 'block';
    }
});

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
var confirmPasswordInput = document.getElementById('confirm_password');
var confirmPasswordLabel = document.getElementById('confirm_password-label');
confirmPasswordInput.addEventListener('focus', function() {
    confirmPasswordLabel.style.display = 'none';
});
confirmPasswordInput.addEventListener('blur', function() {
    if (confirmPasswordInput.value === '') {
        confirmPasswordLabel.style.display = 'block';
    }
});

</script> 
    <div class="login-button-wrapper">
        <input type="submit" value="Register" class="login-button">
        <br><br><br>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
</div>
   
    <p class="login-link">Already have an account?
        <a href="login.php">Login here
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </a>
    </p>
</form> 
</body>
</html>
