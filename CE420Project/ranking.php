<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include('validate_user.php');
require 'header.php';
require 'db_connect.php';
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
<div id="insert_product">
    
    
        <p style="color:green;font-size:15px; text-align:center;">Number of orders lower than 1000 => Ranking : 0 => Discount : 0%</p>
        <p style="color:green;font-size:15px; text-align:center;">Number of orders equal or greater than 1000 or number of orders lower than 3000  => Ranking : 1500 => Discount : 15%</p>
        <p style="color:green;font-size:15px; text-align:center;">Number of orders equal or greater than 3000 => Ranking : 2500 => Discount : 25%</p>
    <?php
        session_start();
        $username=$_SESSION['username'];
        
        $sql="SELECT * FROM users WHERE username='$username'";
        $statement=$pdo->prepare($sql);
        $statement->execute();
        while ( $record = $statement->fetch() ) {
            $ranking=$record['ranking'];
        }
        $statement->closeCursor();
        echo '<br>';
        echo "<p style='color:blue;font-size:15px; text-align:center;'><b>Your ranking is ".$ranking."<b></p>";
    ?>
</div>            


<?php
require 'footer.php';
?>
