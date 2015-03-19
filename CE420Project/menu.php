

<img class="img_class" src="css/images/promo1.jpg" alt="Home's page photo" />
        
        <div id="leftsidebar"> 
            <ul>
        		<li><a href="index.php">Home</a></li>
        		<li><a href="about.php">About Us</a></li>
        		<li><a href="contact.php">Contact</a></li>
				<?php
				if (isset($_SESSION['flash_error'])) {
				echo '<li><a href="login.php">Login</a></li>';
				}else
				if (!isset($_SESSION['signed_in'])) {
				echo '<li><a href="login.php">Login</a></li>';
				}
				else echo '<li><a href="logout.php">Logout</a></li>';
				?>        		
            </ul>
        </div><!-- end of leftsidebar-->
		
		<p class="message" >
		
				<?php
				if (isset($_SESSION['flash_error'])) {
				echo $_SESSION['flash_error'];
				session_destroy();}
				?></p>
