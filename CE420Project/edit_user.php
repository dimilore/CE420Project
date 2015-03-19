<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Edit User</title>
    <link rel="icon" type="image/ico" href="css/images/icon.ico"/>
	<link rel="stylesheet" type="text/css" href="css/register.css">
	<meta name="google" content="notranslate"/>
	<script src="javascript/jquery-2.0.3.min.js"></script>
	
</head>
<?php include('validate_admin.php');
include('db_connect.php');
// Connection data (server_address, database, name, password)


include_once('class/User.php');

if(isset($_POST['submit'])){
	$usr = $_POST['usr'];
	$pass = $_POST['pass'];
	
	$mail = $_POST['mail'];
	$afm = $_POST['afm'];
	$first = $_POST['first'];
	$last = $_POST['last'];
	$brand = $_POST['brand'];
	$addr = $_POST['addr'];
	$postal = $_POST['postal'];
	$town = $_POST['town'];
	$phone = $_POST['phone'];	
	
	$object = new User();
	$object->Update( $usr, $pass, $mail, $afm, $first, $last, $brand, $addr, $postal, $town, $phone);
	$object->closeConnection();
	
	header("Location: search_user.php");
	
	die();	
}

if(isset($_POST['ID'])){
try {
  // Connect and create the PDO object
  //$pdo = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  $pdo->exec("SET CHARACTER SET utf8");      // Sets encoding UTF-8

  // select according to TIN
   $sql=" SELECT * FROM users WHERE `TIN` =:afm";
  
  $query = $pdo->prepare( $sql );
  
  $query->execute( array( ":afm" => $_POST["ID"] ) );
  
  $row  = $query->fetch();

  $pdo = null;        // Disconnect
  ?>
  <div id="contact">
				<form  name="signup-form" method="post" action="edit_user.php">
					
					<h1>Edit user</h1>
					<fieldset>
					
						<label for="first">Firstname:</label>
						<input id="first" name="first" type="text" pattern=".{3,}" maxlength="45" title="Please enter the firstname (3-45 chars)" value="<?php echo $row['firstName'];?>" required />
					
					
						<label for="last">Surname:</label>
						<input id="last" name="last" type="text" pattern=".{2,}"  maxlength="45" title="Please enter the surname (2-45 chars)" value="<?php echo $row['lastName'];?>" required />
					
						<label for="mail">Email:</label>
						<input id="mail" name="mail" type="text" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  maxlength="45" title="Please enter a valid email address"  value="<?php echo $row['email'];?>" required />
					
						<label for="usr">Username:</label>
						<input id="usr" name="usr" type="text"  pattern=".{3,}"   maxlength="15" title="Please enter desired username (3-15 chars)" value="<?php echo $row['username'];?>" required/>
					
					
						<label for="pass">Password:</label>
						<input id="pass" name="pass" type="password" autocomplete="off" pattern="(^.*(?=.{6,})(?=.*[a-z])(?=.*[A-Z]).*$)?$"  maxlength="20" title="Please enter a password, it must contain at least 1 lowercase and 1 uppercase character and be at least 6 characters in length"  placeholder="******" />
					
					
						<label for="afm">TIN:</label>
						<input id="afm" name="afm" type="text"  maxlength="10" pattern="\d*" title="Please enter the TIN (must be a number!)" value="<?php echo $row['TIN'];?>" required />
					
					
						<label for="brand">Pharmacy Name:</label>
						<input id="brand" name="brand" type="text"  maxlength="45" title="Please enter the Pharmacy's Name" value="<?php echo $row['pharmacy'];?>" required/>
					
					
						<label for="addr">Address:</label>
						<input id="addr" name="addr" type="text"  maxlength="45" title="Please enter the address" value="<?php echo $row['address'];?>" required />
					
					
						<label for="postal">Postal Code:</label>
						<input id="postal" name="postal" input type="text"  maxlength="5" pattern="\d*"  title="Please enter postal code" value="<?php echo $row['postalCode'];?>" required/>
					
					
						<label for="town">Town:</label>
						<input id="town" name="town" type="text"  maxlength="45" title="Please enter the town" value="<?php echo $row['town'];?>" required />
					
					
						<label for="phone">Phone number:</label>
						<input id="phone" name="phone" type="text"  maxlength="15" title="Please enter the Phone Number" value="<?php echo $row['phone'];?>" required/>
						
						<div><input type="hidden" name="ID" value="<?php echo $_POST["ID"] ?>"/></div>						
					</fieldset>
					
					</br>										
					<input type="submit" name="submit" value="Update!";/>
					
				</form>
				
				</br>
				<a href="search_user.php">Cancel</a>
			</div>
  <?php
}
catch(PDOException $e) {
  echo $e->getMessage();
}
}
else
 {echo "invalid action";
 echo "<a href=\"search_user.php\">Go to Search Users</a>";
	}
?>
			
				
</html>