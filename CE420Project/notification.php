<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//validation added inside admin_menu
require 'header.php';
require 'admin_menu.php';
require 'db_connect.php';
$total_pending_orders=0;
$total_lack_products=0;
$sql="SELECT count(*) FROM orders WHERE finished_Order='0'";
$statement=$pdo->prepare($sql);
$statement->execute();
while ( $record = $statement->fetch() ) {
    $total_pending_orders=$total_pending_orders+$record['count(*)'];
}
$statement->closeCursor();

$sql_quantity="SELECT count(*) FROM products WHERE totalQuantity<=minQuantity";
$statement=$pdo->prepare($sql_quantity);
$statement->execute();
while ( $record = $statement->fetch() ) {
    $total_lack_products=$total_lack_products+$record['count(*)'];
}
$statement->closeCursor();
$a=array();
$sql_quantity2="SELECT * FROM products WHERE totalQuantity<=minQuantity";
$statement=$pdo->prepare($sql_quantity2);
$statement->execute();
while ( $record = $statement->fetch() ) {
    array_push($a,$record ['productName']);
}
$statement->closeCursor();

//if found pending orders 
if($total_pending_orders!=0){
        echo "<p style='text-align:center;font-size:20px;color:black;'>Total pending orders are <b style='color:red;'>".$total_pending_orders."</b> ."
                . "&nbsp<a href='admin_pending_orders.php' style='text-decoration:none;color:slategray;'>Show</a></p>";
        echo "<br>";
}
else{
        echo "<p style='text-align:center;font-size:20px;color:green;'><b>There aren't any pending orders</b>.</p>";
        echo "<br>";
}
$i=0;
//if found lack of products
if($total_lack_products!=0){
        echo "<p style='text-align:center;font-size:20px;color:black;'><b style='color:red;'>";
        while($i<$total_lack_products){
            echo $a[$i]." ,";
            $i=$i+1;           
        }
        echo "</b> will be in shortage soon.</p>";
}
else{
        echo "<p style='text-align:center;font-size:20px;color:green;'><b>There aren't any products that will be in shortage soon</b>.</p>";
}
        require 'footer.php';
?>





