<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
session_start();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Pharmaceutics Store</title>
        <link rel="icon" type="image/ico" href="css/images/icon.ico"/>
        <link rel="stylesheet" type="text/css" href="css/my_style.css" />
    </head>
    <body>
        <div id="container">
 
	<div id="header">
	    <img src="css/images/rsz_farmakeia1.jpg" alt="Logo image" />
            <div class="logo"><a href="index.php">Pharmaceutics Store</a></div>

        </div><!-- end of header-->  
    
        <img class="img_class" src="css/images/promo1.jpg" alt="Home's page photo" />
        
        <div id="leftsidebar"> 
            <ul>
        		<li><a href="index.php">Home</a></li>
        		<li><a href="about.php">About Us</a></li>
        		<li><a href="contact.php">Contact</a></li>
				<?php
				if (isset($_SESSION['signed_in'])) {
				echo '<li><a href="logout.php">Logout</a></li>';
				}
				else echo '<li><a href="login.php">Log-in</a></li>';
				?>   
            </ul>
        </div><!-- end of leftsidebar-->
   
        <div id='about'>
            <p><b>Who we are</b></p>
			<p>STF Pharmaceutical Store founded in 2013 and is a leading and fast expanding group. STF Pharmaceutical
			Store are providing Distribution, Sales & Marketing Services and Retail Pharmacies. We are providing 
			comprehensive healthcare services and keen to select and acquire new products to the consumer's welfare 
			& quality they deserve and desire.
			<p><b>Our Vision and Mission</b></p>
			<p> To provide the people and society with the quality healthcare they count on.
			To invest in people is one of STF Pharmaceutical Store objectives. It is quite clear
			that to perform and achieve the company's objectives, a well trained and continuously
			developed personnel is extremely important.</p> 
             <p><b>Our Philosophy</b></p>
			 <p>In the highly varied and dynamic world of the healthcare services, STF Pharmaceutical 
			 Store is commited to excellence in everything we do. We know that each of us has the willingness
			 to make a difference at our company. Each and every one is bringing a unique input and voice
			 that is critical to the success of providing healthcare services to our customer.</p>
        </div><!-- end of about-->
        
      
   

        <div id="footer">



                <div id="footer_menu"> 
                    <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="about.php">About Us</a></li>
                                <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div><!-- end of footer_menu-->

                <p class="copy_class">&copy CE420 Project 2013-2014</p>

        </div><!-- end of footer-->
    </div><!-- end of container--> 
</body>
</html>
