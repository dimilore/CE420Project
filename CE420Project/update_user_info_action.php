<?php 
    require 'db_connect.php';
    session_start();
    $username=$_SESSION['username'];
    
    $mail = trim($_POST['mail']);
    $afm = trim($_POST['afm']);
    $first = trim($_POST['first']);
    $last = trim($_POST['last']);
    $brand = $_POST['brand'];
    $addr = $_POST['addr'];
    $postal = trim($_POST['postal']);
    $town = trim($_POST['town']);
    $phone = trim($_POST['phone']);
    $sql_salt="SELECT * FROM users WHERE username LIKE '%$username%'";
    $salt_statement=$pdo->prepare($sql_salt);
    $salt_statement->execute();
    while ( $record = $salt_statement->fetch()) {
        $salt=$record['salt'];
    }
    if(!empty($mail) && !empty($afm) && !empty($first) && !empty($last) && !empty($brand) && !empty($addr) && !empty($postal) && !empty($town) && !empty($phone)){
        if($mail!="email" && $afm!="TIN" && $first!="Firstname" && $last!="Surname" && $brand!="Pharmacy Name" && $addr!="Address" && $postal!="Postal Code" && $town!="Town" && $phone!="Phone number"){
                
                    
                    $sql="UPDATE users SET TIN='$afm',email='$mail',firstName='$first',lastName='$last',pharmacy='$brand',address='$addr',postalCode='$postal',town='$town',phone='$phone' WHERE username='$username' ";
                    $statement=$pdo->prepare($sql);
                    $statement->execute();
                    $statement->closeCursor();
                    $pdo=NULL;
                    header( "refresh:5;url=index.php" ); 
                    echo 'Your pesronal information changed succesfully, You\'ll be redirected in about 5 secs. If not, click <a href="index.php">here</a>.';
                
        }
    }
    else{
        
        header( "refresh:4;url=edit_Info.php" ); 
        echo 'ERROR empty fields, You\'ll be redirected in about 4 secs. If not, click <a href="edit_Info.php">here</a>.';
        
    }
	
	
?>

