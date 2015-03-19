<?php
  include_once('class/connection.php');
  include_once('class/User.php');

	if (isset($_POST['submit'])) {
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		
		$object = new User();
		$user_type=$object->Login($username, $password);
		
		
		
		$pdo = new Connection();
		$pdo=$pdo->dbConnect();
		
		$sql  = "SELECT username, role ";
		$sql .= "FROM user ";
		$sql .= "WHERE username=:u AND password=:p";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(
				":u"=>$username,
				":p"=>$password
			  ));
		$row = $stmt->fetch();

		  // clear out any existing session that may exist
		  session_start();
		  session_destroy();
		  session_start();

		  if ($user_type=="A" || $user_type=="U") {
			$_SESSION['signed_in'] = true;
			$_SESSION['username'] = $username;
			$_SESSION['role'] = $user_type;
			
			if ($user_type=="A"){
			header("Location: admin_logged_in.php");}
			else if ($user_type=="U"){
			header("Location: user_logged_in.php");
			}
			
		  } else {
			$_SESSION['flash_error'] = $user_type;
			$_SESSION['signed_in'] = false;
			$_SESSION['username'] = null;
			$_SESSION['role'] = null;
			
			header("Location: login.php");
		  }
		}	
?>