<?php
    require'db_connect.php';
    $username=trim($_POST['username']);
    //to is the user's email who forgot his password
    $to=trim($_POST['email']);
    
    
    //this function creates a random string
    function rand_string( $length ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);
    }
    
    $newPass=rand_string(8);//call the rand_string with length=8
    
    $check_if_exist="SELECT * FROM users WHERE username='$username' AND email LIKE '%$email%'";
    $check_statement=$pdo->prepare($check_if_exist);
    $check_statement->execute();
    
    /************Temporary**************/
    /* I will use this file to store the pass if a customer will
     * forget his password */
    /* code of file starts here */
    $file=fopen("forgot.txt","w+");
    fwrite($file,$newPass);
    fclose($file);
    /* code of file ends here */
    /***********************************/
    
    /**************THIS IS THE CODE FOR THE PROJECT. THE FILE IS FOR TEST PURPOSES*/
    $subject='You have reseted your password.';
    $message='You have reseted your password. Your new password is'.$newPass;
    $headers = 'From: myemail@myemail.gr'. "\r\n" .
    'Reply-To: myemail@myemail.gr' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    /*****************************************************************************/
    
    while ( $record = $check_statement->fetch() ) {
        //returns true if record found
        if($record){
            $salt=$record['salt'];
            $encryptedPass = hash('sha256', $record['salt'].$newPass); //encrypt the new password with the user's salt
            $sql="UPDATE users SET password='$encryptedPass' WHERE username='$username' AND email LIKE '%$email%'";
            $statement=$pdo->prepare($sql);
            $statement->execute();
            $statement->closeCursor();
            $pdo=NULL;
            /******SEND MAIL*****/
                    if(mail($to, $subject, $message,$headers)){
                        echo '<p>Mail sent successfully</p>';
                    } 
                    else {
                        echo '<p>Mail could not be sent</p>';
                    }
            /*********************/
            }
            
            header('Location:login.php');
            break;
        }
    
    if(!$record){
        header('Location:unsuccessful_login.php');
    }

?>
