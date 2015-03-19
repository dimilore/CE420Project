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
                    <a href="#">Shopping Cart</a>
                </li>
               
            </ul><!--Horizontal menu ends here -->
<?php 
            session_start();
        
        $productName=trim($_POST['search_name']);
        $substance=trim($_POST['search_substance']);
        $category=$_POST['category'];
        $search="SELECT * FROM products WHERE productName LIKE '%$productName%' OR category LIKE '%$category%'";
        $search_statement=$pdo->prepare($search);
        $search_statement->execute();
        
        echo '<br>';
        echo "<table cellpadding='3' cellspacing='2' border='1' width='97%'>";
        echo "<tr>"
        . "<th>Product Name</th>"
        . "<th>Substance</th>"
        . "<th>Manufacturer</th>"
        . "<th>Price</th>" 
        . "<th>Image</th>";
       echo "</tr>";
       
       //estw oti de brethike to farmako thetwntas $_SESSION['productId']=0
       $_SESSION['productId']=0;
       
       while ( $record = $search_statement->fetch()) {
           
                
                
                
                echo "<tr>";
                echo "<td align='center'><a class='tooltip' href='#'>".$record['productName']."<span class='custom info'><img src='css/images/Info.png' alt='Information' height='48' width='48' />".$record['description']."</span></a></td>";
                echo "<td align='center'>".$record['substance']."</td>";
                echo "<td align='center'>".$record['manufacturer']."</td>";
                echo "<td align='center'>".$record['price']." €</td>";
                echo "<td align='center'><a href='upload_images/".$record['image']."' style='text-decoration:none; color:slategray;' target='_blank'>Show photo</a></td>";
                echo "</tr>";
               
                
       }
       
       echo "</table>";
       
       
                
        $search_statement->closeCursor();
        $pdo=NULL;

?>         


<?php
require 'footer.php';
?>
