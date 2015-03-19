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
?>
<img class="img_class" src="css/images/promo1.jpg" alt="Home's page photo" />
        
        <div id="leftsidebar"> 
            <ul>
        		<li><a href="index.php">Home</a>
                        </li>
        		<li><a href="about.php">About Us</a></li>
        		<li><a href="contact.php">Contact</a></li>
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
                        <li><a href=info_for_user.php"">User's manual</a></li>
                        <li><a href="payment_info.php">Payment info</a></li>
                    </ul>
                    
                
                </li>
                <li>
                    <a href="#">Shopping Cart</a>
                </li>
               
            </ul><!--Horizontal menu ends here -->
<?php 
    echo "<p style='text-align:center;color:red;font-size:20px;'>The quantity of the order you want to execute is greater than the available of this product in the store.</p>";

?>


<?php
require 'footer.php';
?>