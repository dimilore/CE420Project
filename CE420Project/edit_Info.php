<?php 
        session_start();
        $usr = $_SESSION['username'];
        
        require 'header.php';
        require 'user_menu.php';
        require 'db_connect.php';
        
        
        
        $search="SELECT * FROM users WHERE username='$usr' AND userType='U'";
        $search_statement=$pdo->prepare($search);
        $search_statement->execute();
        while ( $record = $search_statement->fetch()) {
            if($record){
                echo "<div id='insert_product'>";
                $_SESSION['username']=$record['username'];
                echo "<form id='insert_product_form' method='POST' action='update_user_info_action.php'>";
                echo "<p class='insert_p'>User <b>".$record['firstName']." ".$record['lastName']."</b> has the following information to edit.</p>";
                echo "<p class='insert_p'><br>First Name<br><input id='first' name='first' type='text' value=".$record['firstName']." title='Please enter the firstname (3-45 chars)' size='50' /></p>";
                echo "<p class='insert_p'><br>Last Name<br><input id='last' name='last' type='text' value=".$record['lastName']."  title='Please enter the surname (2-45 chars)' size='50'/></p>";
                echo "<p class='insert_p'><br>E-mail<br><input id='mail' name='mail' type='text' value=".$record['email']."  title='Please enter a valid email address' size='50'/></p>";
                echo "<p class='insert_p'><br>ΤΙΝ<br><input id='afm' name='afm' type='text' value=".$record['TIN']."  title='Please enter the TIN (must be a number!)' size='50'/></p>";
                echo "<p class='insert_p'><br>Pharmacy Name<br><input id='brand' name='brand' type='text' value=".$record['pharmacy']."  title='Please enter the Pharmacy Name' size='50'/></p>";
                echo "<p class='insert_p'><br>Address<br><input id='addr' name='addr' type='text' value=".$record['address']."  title='Please enter the address' size='50' /></p>";
                echo "<p class='insert_p'><br>Postal Code<br><input id='postal' name='postal' type='text' value=".$record['postalCode']."  title='Please enter postal code' size='50' /></p>";
                echo "<p class='insert_p'><br>Town<br><input id='town' name='town' type='text' value=".$record['town']."  title='Please enter the town' size='50' /></p>";
                echo "<p class='insert_p'><br>Phone<br><input id='phone' name='phone' type='text' value=".$record['phone']."  title='Please enter the Phone Number' size='50' /></p>";
                echo "<p class='insert_p'><input id='submit' type='submit' value='Update'/></p>";
                
                echo "</form>";
    
    
                echo "</div>";
            }
        }
     
        
        require 'footer.php';
?>

