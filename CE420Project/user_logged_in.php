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

session_start();
$username=$_SESSION['username'];
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
                        <li><a href="info_for_user.php">User's manual</a></li>
                        <li><a href="payment_info.php">Payment info</a></li>
                    </ul>
                    
                
                </li>
                <li>
                    <a href="shopping_cart.php">Shopping Cart</a>
                </li>
               
            </ul><!--Horizontal menu ends here -->
            
            

<?php

echo '<br>';
echo "<p style='color:blue;font-size:18px; text-align:center;'>Welcome ".$username."</p>";
?>
            <div id="insert_product">
    
    <form id="insert_product_form" method="POST" action="browse_product_action.php">
        <p class="insert_p">Please browse for our products.</p>
        <p class="insert_p"><input id="search_name" name="search_name" type="text" value="Product name" onfocus=" return clear_text(this)" onblur="clickrecall(this,'Product name')" size="50"/></p>
        <p class="insert_p">OR</p>
        <p class="insert_p">
                    <select name="category" title="Product category">
                        <option value="category">------------Select category------------</option>
                        <option value="Cardiovascular">Cardiovascular</option>
                        <option value="Acetylsalicylic">Acetylsalicylic</option>
                        <option value="Pathologic">Pathologic</option>
                        <option value="Other">Other</option>
                    </select>
                    
         </p>
        <p class="insert_p"><input id="submit" type="submit" value="Search"/></p>
    </form>
    
    
</div>     
<?php
require 'footer.php';
?>