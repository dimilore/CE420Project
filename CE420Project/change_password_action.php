<?php
        include 'validate_user.php';
        require 'db_connect.php';
		
        $username=$_SESSION['username'];
       $pass = $_POST['password'];
       $new_pass = $_POST['new_password'];
       $retypenewpass=$_POST['retype_new_password'];
       
       if(strcmp($new_pass, $retypenewpass)==0){
                $sql_salt="SELECT * FROM users WHERE username='$username'";
                $salt_statement=$pdo->prepare($sql_salt);
                $salt_statement->execute();
				
				//compare passwords
				//if ($pass){
				
                while ( $record = $salt_statement->fetch()) {
                    $salt=$record['salt'];
                                        
                    $hash= hash('sha256', $salt.$new_pass);   

					$check_password=hash('sha256', $salt.$pass); 
					$test= $record['password'];
                }
				
				
				
	if (strcmp($test,$check_password)==0){
				
                $salt_statement->CloseCursor();
				
                $change_query="UPDATE users SET password='$hash' WHERE username='$username'";
                $statement=$pdo->prepare($change_query);
                $statement->execute();
                $statement->CloseCursor();
                $pdo=NULL;
                header('Location:user_logged_in.php');
				}
				else echo "la8os sunduasmos username/password";
                
       }
       else{
           echo'Oi kwdikoi de tairiazoun';
       }
?>
