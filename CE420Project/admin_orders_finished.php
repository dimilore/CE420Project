<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
require 'db_connect.php';

$order_id=$_GET['id'];
$TIN=$_GET['tin'];
$quantity_ordered=$_GET['qty'];

if($order_id!="" && $TIN!="" && $quantity_ordered!=""){

            $sql="SELECT * FROM order_details WHERE ORDERS_order_id='$order_id'";
            $statement=$pdo->prepare($sql);
            $statement->execute();
            while ( $record = $statement->fetch() ) {
                $productId=$record['PRODUCTS_productId'];
            }
            $statement->closeCursor();


            $sql_total_quantity="SELECT * FROM products WHERE productId='$productId'";
            $statement=$pdo->prepare($sql_total_quantity);
            $statement->execute();
            while ( $record = $statement->fetch() ) {
                $total_quantity=$record[totalQuantity];
            }
            $statement->closeCursor();

            /********************RANKING SYSTEM STARTS HERE********************/
            /***** PROXEIRH PROSEGGISH***/
            $sql_ranking="SELECT COUNT(*) FROM orders WHERE USERS_TIN='$TIN'";
            $statement=$pdo->prepare($sql_ranking);
            $statement->execute();
            while ( $record = $statement->fetch() ) {
                $count_orders=$record['count'];
            }
            $statement->closeCursor();
            //orders<1000         -> rank 0.0   means 0% discount
            //orders >=1000 && < 3000  -> rank 0.15  means  15% discount
            // >=3000 orders       -> rank  0.25 means 25% discount

            if($count_orders<1000){
                $sql_update="UPDATE users SET ranking='0' WHERE TIN='$TIN'";
                $statement=$pdo->prepare($sql_update);
                $statement->execute();
                $statement->closeCursor();
            }
            else if($count_orders>=1000 && $count_orders<3000){
                $sql_update="UPDATE users SET ranking='0.15' WHERE TIN='$TIN'";
                $statement=$pdo->prepare($sql_update);
                $statement->execute();
                $statement->closeCursor();   
            }
            else if($count_orders>=3000 ){
                $sql_update="UPDATE users SET ranking='0.25' WHERE TIN='$TIN'";
                $statement=$pdo->prepare($sql_update);
                $statement->execute();
                $statement->closeCursor();   
            }
            /********************RANKING SYSTEM ENDS HERE********************/


            if($total_quantity>=$quantity_ordered){
                    //this sql query decrease the quantity of product
                    $sql_decrease="UPDATE products SET totalQuantity=totalQuantity-'$quantity_ordered' WHERE productId='$productId'";
                    $statement=$pdo->prepare($sql_decrease);
                    $statement->execute();
                    $statement->closeCursor();

                    $sql_finish_order="UPDATE orders SET order_Status='FINISHED' ,finished_Order='1' WHERE order_id='$order_id'";
                    $statement=$pdo->prepare($sql_finish_order);
                    $statement->execute();
                    $statement->closeCursor();
                    header("Location:admin_pending_orders.php");
            }
            else{
                header("Location:admin_quantity_error.php");
            }
}
else{
    echo "<p style='color:red;font-size:40px; text-align:center;'>Error!!</p>";
}

?>
