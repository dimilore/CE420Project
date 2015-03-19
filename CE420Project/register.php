<!DOCTYPE html>
<?php include('validate_admin.php'); ?>
<html>
<head>
	<title>Registration Result</title>
	<link rel="stylesheet" type="text/css" href="css/messeges.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" type="image/ico" href="images/icon.ico"/>
</head>
<body id="login2">
<?php

include_once('class/User.php');
include_once('class/helper.php');

if(isset($_POST['submit'])){
	$usr = trim($_POST['usr']);
	$pass = trim($_POST['pass']);
	
	$mail = trim($_POST['mail']);
	$afm = trim($_POST['afm']);
	$first = trim($_POST['first']);
	$last = trim($_POST['last']);
	$brand = trim($_POST['brand']);
	$addr = trim($_POST['addr']);
	$postal = trim($_POST['postal']);
	$town = trim($_POST['town']);
	$phone = trim($_POST['phone']);
	
	//check min&max length of all values//MALLON PREPEI NA GINEI SUNARTHSH :D
	//username
	$min_usr=3;
	$max_usr=15;
	$check_user=validStrLen("username",$usr,$min_usr,$max_usr);
	//password
	$min_pass=3;
	$max_pass=20;
	$check_pass=validStrLen("password",$pass,$min_pass,$max_pass);
	//e-mail
	$min_mail=7;
	$max_mail=45;
	$check_mail=validStrLen("e-mail",$mail,$min_mail,$max_mail);
	//TIN (afm)
	$min_afm=5;
	$max_afm=10;
	$check_afm=validStrLen("TIN",$afm,$min_afm,$max_afm);
	//firstname
	$min_first=3;
	$max_first=45;
	$check_first=validStrLen("firstname",$first,$min_first,$max_first);
	//lastname
	$min_last=2;
	$max_last=45;
	$check_last=validStrLen("lastname",$last,$min_last,$max_last);
	//pharmacy
	$min_pharm=0;
	$max_pharm=45;
	$check_pharm=validStrLen("pharmacy name",$brand,$min_pharm,$max_pharm);
	//address
	$min_addr=0;
	$max_addr=45;
	$check_address=validStrLen("address",$addr,$min_addr,$max_addr);
	//postal
	$min_postal=5;
	$max_postal=10;
	$check_postal=validStrLen("postal code",$postal,$min_postal,$max_postal);
	//town
	$min_town=3;
	$max_town=45;
	$check_town=validStrLen("town",$town,$min_town,$max_town);
	//phone
	$min_phone=3;
	$max_phone=15;
	$check_phone=validStrLen("phone",$phone,$min_phone,$max_phone);
	
	//checks if lengths are ok, else at next page it prints the errors	
	if ($check_user=="1" && $check_pass=="1" && $check_mail=="1" && $check_afm=="1" && $check_first=="1" && $check_last=="1" && $check_pharm=="1" && $check_address=="1" && $check_postal=="1" && $check_town=="1" && $check_phone=="1"){
	
	$object = new User();
	$object->Register( $usr, $pass, $mail, $afm, $first, $last, $brand, $addr, $postal, $town, $phone);
	$object->closeConnection();
		
	//probably you could read the variable $value of register at User.php, to add something more specific
	//BUILD some UI to go back Here!
	//header("Location: search.php");
	//die();
	}
}

?>
	</br>
	<a href="admin_logged_in.php">Back to menu</a>
</body>
</html>