<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

require 'db_connect.php';

$product_id=$_SESSION['productId'];
$quantity=$_POST['qty'];
$username=$_SESSION['username'];
$price=$_SESSION['price'];
$money_Amount=$price*$quantity;

$flag=0;//there is not the same product in the cart



$sql="SELECT * FROM users WHERE username='$username'";
$statement=$pdo->prepare($sql);
$statement->execute();
while ( $record = $statement->fetch() ) {
    $TIN=$record['TIN'];
}
$statement->closeCursor();

$sql_product="SELECT * FROM products WHERE productId='$product_id'";
$statement=$pdo->prepare($sql_product);
$statement->execute();
while ( $record = $statement->fetch() ) {
    $total_quantity=$record['totalQuantity'];
}
$statement->closeCursor();

/*********SELECT RANK FOR DISCOUNT ON ORDER STARTS HERE*********/
$sql_ranking="SELECT * FROM users WHERE USERS_TIN='$TIN'";
$statement=$pdo->prepare($sql_ranking);
$statement->execute();
while ( $record = $statement->fetch() ) {
    $rank=$record['ranking'];
}
$statement->closeCursor();

if($rank==0.0){
    $discount=0.0;
}
else if($rank==0.15){
    $discount=0.15;
}
else if($rank==0.25){
    $discount=0.25;
}
/*********SELECT RANK FOR DISCOUNT ON ORDER ENDS HERE*********/


//check if quantity is positive and quantity is lower than total quantity
if($quantity>0 && $quantity<$total_quantity && $flag==0){
        $sql_orders="INSERT INTO orders (USERS_TIN,order_Status,finished_Order,discount,money_Amount) VALUES('$TIN','PENDING','0','$discount','$money_Amount')";
        $statement=$pdo->prepare($sql_orders);
        $statement->execute();
        $statement->closeCursor();
        
        $sql_TIN="SELECT * FROM orders WHERE USERS_TIN='$TIN'";
        $statement=$pdo->prepare($sql_TIN);
        $statement->execute();
        while ( $record = $statement->fetch() ) {
            $order_id=$record['order_id'];
        }
        $statement->closeCursor();
        
        
        
        $sql_order_details="INSERT INTO order_details(ORDERS_order_id,PRODUCTS_productId,quantityOrdered,priceEach,orderLineNumber) VALUES('$order_id','$product_id','$quantity','$price','0') ";
        $statement=$pdo->prepare($sql_order_details);
        $statement->execute();
        $statement->closeCursor();
        header('Location:new_order.php');
}
//if the quanity you have ordered is greater than the available of the store
else if($quantity>0 && $quantity>$total_quantity && $flag==0){
   
    header("Location:quantity_error.php");
    
}

$pdo=NULL;

?>


