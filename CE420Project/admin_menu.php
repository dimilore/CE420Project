<?php include('validate_admin.php'); ?>

<img class="img_class" src="css/images/promo1.jpg" alt="Home's page photo" />
        
            <div id="leftsidebar"> 
                <ul>
                            <li><a href="index.php">Home</a>
                            </li>
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="contact.php">Contact</a></li>
                            <li><a href="logout.php">Logout</a></li>
                </ul>
            </div><!-- end of leftsidebar-->
        
            <ul id="horizontal_menu"><!--Horizontal menu starts here -->
                <li><a href="#">Orders</a>
                    <ul>
                        <li><a href="admin_pending_orders.php">Pending orders</a></li>
                        <li><a href="admin_orders_history.php">Orders' history</a></li>
                    </ul>
                </li>
                <li><a href="#">Products</a>
                    <ul>
                        <li><a href="insert_product.php">New product</a></li>
                        <li><a href="edit_product.php">Edit product</a></li>
                    </ul>
                </li>    
                <li><a href="#">Users</a>
                    <ul>
                        <li><a href="registration_form.php">New user</a></li>
                        <li><a href="search_user.php">Edit user</a></li>
                    </ul>
                
                </li>
                <li><a href="notification.php">Notifications</a>
                    
                
                </li>
            </ul><!--Horizontal menu ends here -->
