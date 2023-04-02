<!DOCTYPE html>
<html>
<head>
	<title>Personal Profile Edit</title>
	<link rel="stylesheet" href="Login&register_style.css">
</head>
<body>
	<h1>Personal Profile Edit</h1>

	<form method="post" action="personal_profile_update.php">
		<label for="address">Address:</label>
		<input type="text" name="address" id="address">

		<label for="city">City:</label>
		<input type="text" name="city" id="city">

		<label for="country">Country:</label>
		<input type="text" name="country" id="country">

		<label for="zipcode">Zip Code:</label>
		<input type="text" name="zipcode" id="zipcode">

		<label for="phone">Phone Number:</label>
		<input type="text" name="phone" id="phone">

		<label for="titles[]">Titles:</label><br>
		<input type="checkbox" name="titles[]" value="Doctors"> Doctors<br>
		<input type="checkbox" name="titles[]" value="Nurses"> Nurses<br>
		<input type="checkbox" name="titles[]" value="Pharmaceutical Suppliers"> Pharmaceutical Suppliers<br>
		<input type="checkbox" name="titles[]" value="Medical Daily Necessities Suppliers"> Medical Daily Necessities Suppliers<br>
		<input type="checkbox" name="titles[]" value="Surgical Supplies Suppliers"> Surgical Supplies Suppliers<br>
		<input type="checkbox" name="titles[]" value="Electronic Equipment Suppliers"> Electronic Equipment Suppliers<br>

		<input type="submit" value="Save Changes">
	</form>
</body>
</html>
