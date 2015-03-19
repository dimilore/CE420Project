<!DOCTYPE html>
<?php include('validate_admin.php'); ?>
<html>
<head>
	<title>Register User</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" type="image/ico" href="images/icon.ico"/>
    <link rel="stylesheet" type="text/css" href="css/register.css" />
</head>

<body>

		<div id="contact">
						
				<form  name="signup-form" method="post"  action="register.php">
					
					<h1>Register user</h1>
					<fieldset>
					
						<label for="first">Firstname:</label>
						<input id="first" name="first" type="text" pattern=".{3,}" maxlength="45" title="Please enter the firstname (3-45 chars)" placeholder="e.g. John" autofocus required />
										
						<label for="last">Surname:</label>
						<input id="last" name="last" type="text" pattern=".{2,}"  maxlength="45" title="Please enter the surname (2-45 chars)" placeholder="e.g. Lennon" required />
					
						<label for="mail">Email:</label>
						<input id="mail" name="mail" type="text" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  maxlength="45" title="Please enter a valid email address"  placeholder="e.g. johnlennon@singer.com" required />
					
						<label for="usr">Username:</label>
						<input id="usr" name="usr" type="text"  pattern=".{3,}"   maxlength="15" title="Please enter desired username (3-15 chars)"placeholder="e.g. jlennon" required/>
										
						<label for="pass">Password:</label>
						<input id="pass" name="pass" type="password" autocomplete="off" pattern="^.*(?=.{6,})(?=.*[a-z])(?=.*[A-Z]).*$"  maxlength="20" title="Please enter a password, it must contain at least 1 lowercase and 1 uppercase character and be at least 6 characters in length"  placeholder="******" required />
										
						<label for="afm">TIN:</label>
						<input id="afm" name="afm" type="text"  maxlength="10" pattern="\d*" title="Please enter the TIN (must be a number!)" placeholder="e.g. 340392837" required />
										
						<label for="brand">Pharmacy Name:</label>
						<input id="brand" name="brand" type="text"  maxlength="45" title="Please enter the Pharmacy's Name" placeholder="e.g. MyPharmacy" required/>
										
						<label for="addr">Address:</label>
						<input id="addr" name="addr" type="text"  maxlength="45" title="Please enter the address" placeholder='e.g. "Glavanni 37"' required />
										
						<label for="postal">Postal Code:</label>
						<input id="postal" name="postal" input type="text"  maxlength="5" pattern="\d*"  title="Please enter postal code" placeholder="e.g. 38221" required/>
										
						<label for="town">Town:</label>
						<input id="town" name="town" type="text"  maxlength="45" title="Please enter the town" placeholder="e.g. Volos" required />
										
						<label for="phone">Phone number:</label>
						<input id="phone" name="phone" type="text"  maxlength="15" title="Please enter the Phone Number" placeholder="e.g. 2421012345" required/>
											
					</fieldset>
					
					</br>										
					<input type="submit" name="submit" value="Register!"/>
					
				</form>
				
				</br>
				<a href="admin_logged_in.php">Cancel</a>
		 		
		</div>
	
</body>

</html>