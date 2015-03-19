<?php
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));  
    session_start();
    require 'header.php';
    
       
    if ($_SESSION['user_Type']==1 && isset($_SESSION['username'])){
        require 'user_menu.php';
    }
    else{
        require 'menu.php';
    }
    
?>
    
       
   
        <div id='Information'>
            <p><b>PayPal Payments Information</b></p>
			<p>We accept payment via Paypal for all online orders. If you choose the Paypal option when completing your order, 
                            you will be transferred to an SSL-encrypted Paypal server, where you can complete the purchase and enter payment details.</b></p>
			<p> We will be notified by Paypal as soon as the payment has been successfully completed. Payment via Paypal is effected 
                            immediately and we receive a message from Paypal as soon as the funds have been paid into our account.</p> 
			<p>Please note that all customers using the Paypal option must have a valid Paypal account. Customers
                             who do not already have a valid Paypal account can create one free of charge during the checkout process.</p>
                        <p>There is no additional fee for using this payment option. 
                        <p>Additional information: <a href="https://www.paypal.com/">PayPal</a></p>
        </div><!-- end of info-->
        
      
   

<?php require 'footer.php'; ?>


