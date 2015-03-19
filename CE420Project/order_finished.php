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
        $amount2=0;
        echo '<br>';
        echo "<table cellpadding='3' cellspacing='2' border='1' width='97%' >";
            echo "<tr>"
            . "<th>Order ID</th>"
            . "<th>Order Date</th>"
            . "<th>Product Name</th>"
            . "<th>Quantity</th>"
            . "<th>Discount</th>"
            . "<th>Price</th>" 
            . "<th>Payment method</th>" 
            . "<th>Order status</th>";
            echo "</tr>";
            $found=0;
            $sql_order_id="SELECT * FROM orders WHERE USERS_TIN='$TIN'";
            $statement=$pdo->prepare($sql_order_id);
            $statement->execute();
            while ( $record = $statement->fetch() ) {
                $order_id=$record['order_id'];
                $order_date=$record['order_Date'];
                $order_status=$record['order_Status'];
                $finished_order=$record['finished_Order'];
                $sql_order="SELECT * FROM order_details WHERE ORDERS_order_id='$order_id'";
                $statement_order=$pdo->prepare($sql_order);
                $statement_order->execute();
                    while ( $rec_order = $statement_order->fetch() ) {
                        //visible = 0 means that order is visible to user
                        //visible = 1 means that order is NOT visible to user
                        $visible=$rec_order['orderLineNumber'];
                        $productId=$rec_order['PRODUCTS_productId'];
                        $quantity=$rec_order['quantityOrdered'];
                        $price=$rec_order['priceEach'];
                        $discount=$record['discount'];
                        
                        
                        $sql_prod_name="SELECT * FROM products WHERE productId='$productId'";
                        $statement_prod=$pdo->prepare($sql_prod_name);
                        $statement_prod->execute();
                        while ( $prod = $statement_prod->fetch() ) {
                            $prodname=$prod['productName'];
                            
                            $sql_pay="SELECT * FROM payments WHERE USERS_TIN='$TIN'";
                            $statement_pay=$pdo->prepare($sql_pay);
                            $statement_pay->execute();
                            while ( $pay = $statement_pay->fetch() ) {
                                $amount=$pay['amount'];
                                $payment_method=$pay['payment_method'];
                                $check_id=$pay['check_Id'];
                                if($order_status=="FINISHED" && $finished_order==1 && $visible==0){
                                        echo "<tr>";
                                        echo "<td align='center'>".$order_id."</td>";
                                        echo "<td align='center'>".$order_date."</td>";
                                        echo "<td align='center'>".$prodname."</td>";
                                        echo "<td align='center'>".$quantity."</td>";
                                        echo "<td align='center'>".$discount."</td>";
                                        $topay=($price*$quantity)-$discount*($price*$quantity);
                                        echo "<td align='center'>".$topay."€</td>";
                                        $amount2=$amount2+$topay;
                                        echo "<td align='center'>".$payment_method."</td>";
                                        echo "<td align='center'>".$order_status."</td>";
                                        echo "</tr>";
                                        $found=1;
                                        break;
                                }
                            }
                        }
                    }
                
            }
// show total on table            
//            if($order_status=="FINISHED" && $finished_order==1){
//                echo "<th>Total amount</th>";
//                echo "<td align='center'>".$amount2."€</td>";
//            }
            echo "</table>";
            if($found==1){
                echo "<br><br><br>";

                echo "<div id='insert_product'>";
                echo "<form name='insert_product_form' method='POST' action='delete_history.php'>";
                echo "<p class='insert_p' style='font-size:17px;text-align:center;'>If you want to delete your orders' history type your password and press delete.</p>";
                echo "<p class='insert_p' style='text-align:center;'><input id='del_pass' name='del_pass' type='password' value='password' onfocus=' return clear_text(this)' onblur=' return clickrecall(this,'\password\')' title='password' maxlength='45' size='50' /></p>";
                echo "<p class='insert_p' style='text-align:center;'><input id='submit' type='submit' value='Delete'/>";
                echo "</form>";
                echo "</div>";
            }
            
            
            ?>


<?php
require 'footer.php';
?>
