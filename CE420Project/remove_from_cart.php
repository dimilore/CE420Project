<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
require 'db_connect.php';

if($_GET[id]!=""){
    $delete_order_item="DELETE FROM order_details WHERE ORDERS_order_id='$_GET[id]'";
    $statement=$pdo->prepare($delete_order_item);
    $statement->execute();
    $statement->closeCursor();
    
    $delete_item="DELETE FROM orders WHERE order_id='$_GET[id]'";
    $statement=$pdo->prepare($delete_item);
    $statement->execute();
    $statement->closeCursor();
    
    
    header("Location:shopping_cart.php");
}
else{
    echo "<p style='color:red;font-size:40px; text-align:center;'>Error!!</p>";
}
?>

