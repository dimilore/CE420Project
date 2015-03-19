<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//validate_user.php must be put at the top of EVERY user's page
include('validate_user.php');
require 'db_connect.php';

session_start();
$username=$_SESSION['username'];
$payment=$_POST['payment'];
$quantity=$_POST['qty'];
$sum_all=0;
$sql="SELECT * FROM users WHERE username='$username'";
$statement=$pdo->prepare($sql);
$statement->execute();
while ( $record = $statement->fetch() ) {
    $TIN=$record['TIN'];
    $ranking=$record['ranking'];
}
$statement->closeCursor();

if($ranking==0){
    $discount=0;
}
else if($ranking==0.15){
    $discount=0.15;
}

else if($ranking==0.25){
    $discount=0.25;
}


$sql_TIN="UPDATE orders SET order_Status='IN PROGRESS' ,discount='$discount' WHERE USERS_TIN='$TIN' AND finished_Order='0'";
$statement=$pdo->prepare($sql_TIN);
$statement->execute();
$statement->closeCursor();

$sql_progress="SELECT * FROM orders WHERE USERS_TIN='$TIN' && finished_Order='0'";
$statement=$pdo->prepare($sql_progress);
$statement->execute();
while ( $record = $statement->fetch() ) {
    $order_id=$record['order_id'];
    $sum_all=$sum_all+$record['money_Amount'];
}
$statement->closeCursor();

$sql_price="SELECT * FROM order_details WHERE ORDERS_order_id='$order_id'";
$statement=$pdo->prepare($sql_price);
$statement->execute();
while ( $record = $statement->fetch() ) {
    $priceEach=$record['priceEach'];
    
}
$statement->closeCursor();

if($quantity>0){
    $sql_qty="UPDATE order_details SET quantityOrdered='$quantity' WHERE ORDERS_order_id='$order_id'";
    $statement=$pdo->prepare($sql_qty);
    $statement->execute();
    $statement->closeCursor();
    
    $amount=$priceEach*$quantity;
    
    $sql_amount="UPDATE orders SET money_Amount='$amount' WHERE order_id='$order_id'";
    $statement=$pdo->prepare($sql_amount);
    $statement->execute();
    $statement->closeCursor();

}


$sql_payment="INSERT INTO payments (USERS_TIN,amount,payment_method) VALUES ('$TIN','$sum_all','$payment')";
$statement=$pdo->prepare($sql_payment);
$statement->execute();
$statement->closeCursor();

header("Location:user_logged_in.php");


?>

