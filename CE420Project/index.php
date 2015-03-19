<?php
	session_start();
	
	if (isset($_SESSION['role'])) {
		if ($_SESSION['role']=="A"){ header( 'Location: admin_logged_in.php' ) ;}
		if ($_SESSION['role']=="U") { header( 'Location: user_logged_in.php' ) ;}
	}
   	
    require 'header.php';
    require 'menu.php';
    require 'main.php';
    require 'footer.php';
?>