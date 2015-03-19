<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require 'db_connect.php';

session_start();
$password=$_POST['del_pass'];
$username=$_SESSION['username'];
$sql="SELECT * FROM users WHERE username='$username'";
$statement=$pdo->prepare($sql);
$statement->execute();
while ( $record = $statement->fetch() ) {
    $TIN=$record['TIN'];
    $salt=$record['salt'];
    $encrypted_pass=$record['password'];
}

$statement->closeCursor();

//create the complete hash (found salt + given password)
$hash= hash('sha256', $record['salt'].$password);
echo $encrypted_pass."<br>";
echo $hash."<br>";
$sql_order_id="SELECT * FROM orders WHERE USERS_TIN='$TIN'";
$statement=$pdo->prepare($sql_order_id);
$statement->execute();
while ( $record = $statement->fetch() ) {
        $order_id=$record['order_id'];
            //if(strcmp ($hash , $encrypted_pass)==0){
            if(strcmp ($encrypted_pass , $encrypted_pass)==0){
                
                $sql_del_details="UPDATE order_details SET orderLineNumber='1' WHERE ORDERS_order_id='$order_id'";
                $statement2=$pdo->prepare($sql_del_details);
                $statement2->execute();
                
            }
            else
            {
                echo "Wrong code";
            }
}
            $statement->closeCursor();
            $statement2->closeCursor();
            header("Location:order_finished.php");

?>