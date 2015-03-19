<?php
     session_start();
     error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); 
    /*Εάν έχεις ήδη κάνει login τότε ανακατευθήνει στην αρχική σελίδα   */
     if ($_SESSION['user_Type']==0 && isset($_SESSION['username'])){
        header('Location: admin_logged_in.php');
     }
     else if ($_SESSION['user_Type']==1 && isset($_SESSION['username'])){
        header('Location: user_logged_in.php');
    }
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
 
<?php if (!isset($_SESSION['username'])) { ?>
        <div id="login">    
            <form name="login_form" method="POST" action="forgot_password_php_only.php" >
                <p class="login_header">Forgot your password??</p>
                <p class="input_p"><input type="text" name="username" value="username" onfocus="clear_text(this)" onblur="clickrecall(this,'username')" size="30"/></p>
                <p class="input_p"><input  type="text" name="email" value="email" onfocus="clear_text(this)" onblur="clickrecall(this,'email')" size="30"/></p>
                
                <p class="input_p"><input  type="submit" name="submit" value="Send"/>&nbsp;<input  type="reset" name="submit" value="Reset"/></p>
                <a class="input_p" href="index.php">Back to home page.</a><br/>
                
            </form>
        </div>
<?php }?>
</div>
    </body>
</html>
