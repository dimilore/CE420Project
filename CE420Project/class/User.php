<?php

include_once('class/connection.php');

class User {

    private $db;

     function __construct() {
        $this->db = new Connection();
        $this->db = $this->db->dbConnect();
    }
	
	function closeConnection() // close the connection
    {
         $this->db = NULL;
    }

     function Login($name, $pass) {
        if (!empty($name) && !empty($pass)) {
                            
            $st = $this->db->prepare("select * from users where username=?");
            $st->bindParam(1, $name);
            $st->execute();
            $row = $st->fetch();            
            
            //an vre8hke to username
            if ($st->rowCount() == 1) {
                //create the complete hash (found salt + given password)
                $hash= hash('sha256', $row['salt'].$pass);
                //compare with existing hash
                $check = strcmp ( $hash , $row['password'] );
            if ($check==0){return $row['userType'];}
            else return "Invalid username or password!";                                
            } else
                return "Invalid username or password!";
        } else
            return "Please fill both fields!";
    }

     function Register($username, $pass, $mail, $afm, $first, $last, $brand, $addr, $postal, $town, $phone) {
        if (!empty($username) && !empty($pass) && !empty($mail)  && !empty($afm)  && !empty($first)  && !empty($last)  && !empty($brand) && !empty($addr) && !empty($postal)  && !empty($town) && !empty($phone)) {
            
            //create a random hash from function
            $salt=utf8_encode(User::createSalt());
            //create the complete hash
            $hash= hash('sha256', $salt.$pass);
            
            try {
				$default_ranking=0;
				$default_user_type="U";
				
                $stmt = $this->db->prepare("INSERT INTO users (username, salt, password, TIN, userType, email, firstName, lastName, pharmacy, address, postalCode, town, phone, ranking) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bindParam(1, $username);
                $stmt->bindParam(2, $salt);
                $stmt->bindParam(3, $hash);
				
				$stmt->bindParam(4, $afm);
                $stmt->bindParam(5, $default_user_type); //user type
                $stmt->bindParam(6, $mail);
				$stmt->bindParam(7, $first); 
                $stmt->bindParam(8, $last);
                $stmt->bindParam(9, $brand);
				$stmt->bindParam(10, $addr);
                $stmt->bindParam(11, $postal);
                $stmt->bindParam(12, $town);
				$stmt->bindParam(13, $phone);
                $stmt->bindParam(14, $default_ranking);  //ranking			

				//echo  strlen($hash);
				//echo  strlen($salt);
				//echo $salt;
				
                $value=$stmt->execute();				
				
				if(!$value){
				echo "Registration Failed, probably username or TIN or e-mail already exists";}
				else {
				echo "Registration was succesful";}
				
								
            } catch (PDOException $e) {
                echo $e->getMessage();
            }            
        }    else
            echo "Please enter username and password";
    }
	
	 function Update($usr, $pass, $mail, $afm, $first, $last, $brand, $addr, $postal, $town, $phone) {
        if (!empty($usr)  && !empty($mail)  && !empty($afm)  && !empty($first)  && !empty($last)  && !empty($brand) && !empty($addr) && !empty($postal)  && !empty($town) && !empty($phone)) {
            
			//we dont check here "&& !empty($pass)" cause we might have empty password (we keep the old one) 
			
			
            //create a random hash from function
            $salt=User::createSalt();
            //create the complete hash
            $hash= hash('sha256', $salt.$pass);
            
            try {						
							//check if there is a password change requested
				if (!$pass){
					$sql_2= "UPDATE users SET firstName=?, lastName=?, TIN=?, username=?, email=?, pharmacy=?, address=?, postalCode=?, town=?, phone=? WHERE  TIN=?";
					$q2 = $this->db->prepare($sql_2);
					$value2=$q2->execute(array($first,$last,$afm,$usr,$mail,$brand,$addr,$postal,$town,$phone,$_POST["ID"]));
					if(!$value2){
					echo "UPDATE FAILED";}
				}
				else{
					
					//create a random hash from function
					$salt=utf8_encode(User::createSalt());
					//create the complete hash
					$hash= hash('sha256', $salt.$pass);
				
					$sql_1 = "UPDATE users SET firstName=?, lastName=?, TIN=?, username=?, salt=?, password=?, email=?, pharmacy=?, address=?, postalCode=?, town=?, phone=? WHERE  TIN=?";
					$q1 = $this->db->prepare($sql_1);
					$value1=$q1->execute(array($first,$last,$afm,$usr,$salt,$hash,$mail,$brand,$addr,$postal,$town,$phone,$_POST["ID"]));
					//THIS ONE NEEDED FIX, DUE TO PASSWORD ENCRYPTION//
					if(!$value1){
					echo "UPDATE FAILED";}
				}           
			}  
			catch(PDOException $e) {
			echo $e->getMessage();
	}
		}
		else
            echo "Please complete all fields";
	}
    
    private static function createSalt(){
        $size = mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_CFB);
        //IV is the salt	
        $iv = mcrypt_create_iv($size, MCRYPT_DEV_RANDOM); 
        return $iv;
    }
}
