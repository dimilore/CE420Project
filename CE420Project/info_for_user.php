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
            
             <p><b>Order Process</b></p>
             <p><b>1. Find the products you want</b></p>
             <p>You can browse products by: name or substance </p>
             <p> Click on a product to find out more about it.</p>
             <p><b>2. Add the products to your shopping cart</b></p>
             <p>Ready to buy or save for later? Select quantity, 
                then click "Add to cart". You'll find this to the right of the product.
                A summary of what you've added to the cart and the total price will briefly 
                appear on screen. You can view your cart at anytime by clicking the "shopping cart icon"
                at the top right of the page. You can now either continue shopping or checkout.
                Problems adding items to your cart? Check your browser is enabled to accept cookies. 
                Your browser help can assist if you're unsure.</p>
              <p><b>3. Proceed to Checkout</b></p>
              <p>Finished shopping? To checkout, click the "shopping cart icon" at the top right of the page.
                 The products you have added to the shopping cart will be listed down the page.
                 Use the icons next to each product to:
                  Remove
                  Edit
                 Or, save the product.
                 You can also "Print the order".
                 Your cart will be visible throughout the checkout process in the bottom right corner of the page.
                 You can edit your order at any time but this will restart the checkout process.</p>
              <p><b>Paying via Paypal</b></p>
              <p>You will be taken to the Paypal website to complete payment of your order.</p>
              <p><b> Unsuccessful order</b></p>
              <p>Sometimes, for various reasons, we have to cancel or can't accept an order. If your order has been 
                  cancelled and you don't know why, please check you have entered your card and billing details correctly. 
                  If this doesn't solve the problem, please : <a href="contact.php">Contact Customer Service</a></p>
        </div><!-- end of info-->
        
      
   

<?php require 'footer.php'; ?>


