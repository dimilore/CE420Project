z
<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//validate_user.php must be put at the top of EVERY user's page
include('validate_user.php');
require 'header.php';
require 'db_connect.php';

session_start();
$username=$_SESSION['username'];
$sql="SELECT * FROM users WHERE username='$username'";
$statement=$pdo->prepare($sql);
$statement->execute();
while ( $record = $statement->fetch() ) {
    $TIN=$record['TIN'];
}
$statement->closeCursor();
//sum of payment        
$sum=0;
$counter=0;
?>
<img class="img_class" src="css/images/promo1.jpg" alt="Home's page photo" />
        
        <div id="leftsidebar"> 
            <ul>
        		<li><a href="index.php">Home</a>
                        </li>
        		<li><a href="about.html">About Us</a></li>
        		<li><a href="contact.html">Contact</a></li>
        		<li><a href="logout.php">Logout</a></li>
            </ul>
        </div><!-- end of leftsidebar-->
        
            <ul id="horizontal_menu"><!--Horizontal menu starts here -->
                <li><a href="#">Orders</a>
                    <ul>
                        <li><a href="new_order.php">New order</a></li>
                        <li><a href="pending_orders.php">Pending orders</a></li>
                        <li><a href="order_finished.php">Orders' history</a></li>
                    </ul>
                </li>
                <li><a href="#">Personal info</a>
                    <ul>
                        <li><a href="change_password.php">Change Password</a></li>
                        <li><a href="edit_Info.php">Edit information</a></li>
                        <li><a href="ranking.php">Ranking</a></li>
                    </ul>
                </li>    
                <li><a href="#">Help</a>
                    <ul>
                        <li><a href="contact.php">Contact us</a></li>
                        <li><a href="info_for_user.php">User's manual</a></li>
                        <li><a href="payment_info.php">Payment info</a></li>
                    </ul>
                    
                
                </li>
                <li>
                    <a href="shopping_cart.php">Shopping Cart</a>
                </li>
               
            </ul><!--Horizontal menu ends here -->
<?php 
            echo "<br>";
            echo "<table cellpadding='3' cellspacing='2' border='1' width='97%'>";
            echo "<tr>"
            . "<th>Product Name</th>"
            . "<th>Substance</th>"
            . "<th>Manufacturer</th>"
            . "<th>Quantity</th>"
            . "<th>Price</th>" 
            . "<th>Remove</th>";
            echo "</tr>";
            
            $sql_TIN="SELECT * FROM orders WHERE USERS_TIN='$TIN'";
            $statement=$pdo->prepare($sql_TIN);
            $statement->execute();
            while ( $record = $statement->fetch() ) {
                $order_id=$record['order_id'];
                $order_status=$record['order_Status'];
                $sql_order="SELECT * FROM order_details WHERE ORDERS_order_id='$order_id'";
                $statement_order=$pdo->prepare($sql_order);
                $statement_order->execute();
                $id[$counter]=$order_id;
                while ( $rec_order = $statement_order->fetch() ) {
                    $productId=$rec_order['PRODUCTS_productId'];
                    $quantity=$rec_order['quantityOrdered'];
                    $price_each=$rec_order['priceEach'];
                    $price_all=$price_each*$quantity;
                    $sum=$sum+$price_all;
                    $_SESSION['sum']=$sum;
                    $sql_product="SELECT * FROM products WHERE productId='$productId'";
                    $statement_product=$pdo->prepare($sql_product);
                    $statement_product->execute();
                    while ( $product = $statement_product->fetch() ) {
                        //if order is not submitted by the customer
                        if($order_status=="PENDING"){
                            $productName=$product['productName'];
                            $substance=$product['substance'];
                            $manufacturer=$product['manufacturer'];
                            
                            echo "<form name='finish_cart' method='POST' action='finish_order.php'>";
                            echo "<tr>";
                            echo "<td align='center'>".$productName."</td>";
                            echo "<td align='center'>".$substance."</td>";
                            echo "<td align='center'>".$manufacturer."</td>";
                            echo "<td align='center'><input type='text' name='qty' value='$quantity' size='2' maxlength='3'/></td>";
                            //echo "<td align='center'>".$quantity."</td>";
                            echo "<td align='center'>".$price_all." €</td>";
                            echo "<td align='center'><a style='text-decoration:none;' href='remove_from_cart.php?id=$id[$counter]'>Remove</a></td>";
                            echo "</tr>";
                            $counter=$counter+1;
                        }
                            
                    }
                    
                }
                
                
            }
            
            //if customer has ordered at least one product
            echo "</table>";
            if($counter>0){
                echo "<p class='insert_p' ><input name='payment' type='radio' value='Delivery'/>Delivery</p>";
                echo "<p class='insert_p' ><input name='payment' type='radio' value='PayPal'/>PayPal</p>";
                echo "<p class='insert_p' style='text-align:center;'><input name='submit' type='submit' value='Submit order' /></p>";

            }
            echo "</form>";

?>


<?php
require 'footer.php';
?>


