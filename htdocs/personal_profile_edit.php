<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewpoint" content="width=device-width, initial-scale=1">
	<title>Personal Profile Edit</title>
	<link rel="stylesheet" href="Login.css">
</head>
<style>
	.checkbox{
		color: white;
	}
	#personal-profile-edit-form {
    margin-top: 0px;
}

</style>
<body>
	<div class="content">
        <h2>MedLinkPro</h2>
        <h2>MedLinkPro</h2>
    </div>
	<div class="login-box" id="personal-profile-edit-form">
	<h1>Personal Profile Edit</h1>

	<form method="post" action="personal_profile_update.php">
    <div class="user-box">
    <label for="address" id="address-label">Address:</label>
    <input type="text" name="address" id="address" placeholder="Address" required>
</div>
<div class="user-box">
    <label for="city" id="city-label">City:</label>
    <input type="text" name="city" id="city" placeholder="City" required>
</div>
<div class="user-box">
    <label for="country" id="country-label">Country:</label>
    <input type="text" name="country" id="country" placeholder="Country" required>
</div>
<div class="user-box">
    <label for="zipcode" id="zipcode-label">Zip Code:</label>
    <input type="text" name="zipcode" id="zipcode" placeholder="Zip Code" required>
</div>
<div class="user-box">
    <label for="phone" id="phone-label">Phone Number:</label>
    <input type="text" name="phone" id="phone" placeholder="Phone Number" required>
</div>
<script>
    var addressInput = document.getElementById('address');
var addressLabel = document.getElementById('address-label');

addressInput.addEventListener('focus', function() {
    addressLabel.style.display = 'none';
});

addressInput.addEventListener('blur', function() {
    if (addressInput.value === '') {
        addressLabel.style.display = 'block';
    }
});

var cityInput = document.getElementById('city');
var cityLabel = document.getElementById('city-label');

cityInput.addEventListener('focus', function() {
    cityLabel.style.display = 'none';
});

cityInput.addEventListener('blur', function() {
    if (cityInput.value === '') {
        cityLabel.style.display = 'block';
    }
});

var countryInput = document.getElementById('country');
var countryLabel = document.getElementById('country-label');

countryInput.addEventListener('focus', function() {
    countryLabel.style.display = 'none';
});

countryInput.addEventListener('blur', function() {
    if (countryInput.value === '') {
        countryLabel.style.display = 'block';
    }
});

var zipcodeInput = document.getElementById('zipcode');
var zipcodeLabel = document.getElementById('zipcode-label');

zipcodeInput.addEventListener('focus', function() {
    zipcodeLabel.style.display = 'none';
});

zipcodeInput.addEventListener('blur', function() {
    if (zipcodeInput.value === '') {
        zipcodeLabel.style.display = 'block';
    }
});

var phoneInput = document.getElementById('phone');
var phoneLabel = document.getElementById('phone-label');

phoneInput.addEventListener('focus', function() {
    phoneLabel.style.display = 'none';
});

phoneInput.addEventListener('blur', function() {
    if (phoneInput.value === '') {
        phoneLabel.style.display = 'block';
    }
});
</script>
	<label class="checkbox" for="titles[]">Titles:</label><br><br>
<label class="checkbox">
    <input type="checkbox" name="titles[]" value="Doctors"> Doctors
</label><br>
<label class="checkbox">
    <input type="checkbox" name="titles[]" value="Nurses"> Nurses
</label><br>
<label class="checkbox">
    <input type="checkbox" name="titles[]" value="Pharmaceutical Suppliers"> Pharmaceutical Suppliers
</label><br>
<label class="checkbox">
    <input type="checkbox" name="titles[]" value="Medical Daily Necessities Suppliers"> Medical Daily Necessities Suppliers
</label><br>
<label class="checkbox">
    <input type="checkbox" name="titles[]" value="Surgical Supplies Suppliers"> Surgical Supplies Suppliers
</label><br>
<label class="checkbox">
    <input type="checkbox" name="titles[]" value="Electronic Equipment Suppliers"> Electronic Equipment Suppliers
</label><br>
		
		<div class="login-button-wrapper">
    <input type="submit" value="Save Changes" class="login-button">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
</div>
	</form>
</body>
</html>
