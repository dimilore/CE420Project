<?php
session_start();
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Pharmaceutics Store</title>
        <link rel="icon" type="image/ico" href="css/images/icon.ico"/>
        <link rel="stylesheet" type="text/css" href="css/my_style.css" />
        <script src="javascript/form.js" type="text/javascript" ></script>
</head>
<body>
<div id="container">
 
	<div id="login_header">
	    <img src="css/images/rsz_farmakeia1.jpg" alt="Logo image" />
            <div class="logo"><a href="index.php">Pharmaceutics Store</a></div>

        </div><!-- end of header--> 
      
        <div id="login">    
            <form name="login_form" method="POST" action="sign_in.php" >
                <p class="login_header">Login customer</p>
				<p class="message" >
				<?php
				if (isset($_SESSION['flash_error'])) {
				echo $_SESSION['flash_error'];
				session_destroy();}
				?>
				</p>
                <p class="input_p"><input type="text" name="username" value="username" onfocus="clear_text(this)" onblur="clickrecall(this,'username')"  size="30"/></p>
                <p class="input_p"><input  type="password" name="password" value="password" onfocus="clear_text(this)" onblur="clickrecall(this,'password')" size="30"/></p>
                
                <p class="input_p"><input  type="submit" name="submit" value="Login"/><input type="reset" name="reset" value="Reset"/></p>
                <a class="input_p" href="index.php">Back to home page.</a><br/>
												
                <a class="input_p" href="forgot_password.php">Forgot your password??</a>
				
				
            </form>			
		</div>
				
</div>
    </body>
</html>
