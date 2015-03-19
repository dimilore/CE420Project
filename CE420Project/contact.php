<?php 
        require 'header.php';
        require 'menu.php';

?>
        <div id="contact">
            <p>STF Pharmaceutical Store Co.</p>
            <p>Glavani 37, Volos, Greece</p>
            <p>Postal code: 38221</p>
            <p>Tel:+302421012345</p>
            <p>Fax:+302421054321</p>
            <p>Opened Monday - Saturday</p>
            <p>9:00 - 17:00 pm</p>
            <br>
            <h1>Contact us</h1>
            
            <form name="email_form" action="contact_form.php" method="POST">
                <p class="contact_p"><input onfocus="clear_text(this)" onblur="clickrecall(this,'Type your e-mail here. . .')" type="text" name="email" size="67" value="Type your e-mail here. . ." placeholder="e.g. johnlennon@singer.com"/></p>
                <p class="contact_p"><input onfocus="clear_text(this)" onblur="clickrecall(this,'Type your subject here. . .')" type="text" name="subject" size="67" value="Type your subject here. . ." placeholder="I want to cooperate with your business."/></p>
                <p class="contact_p">
                    <textarea onfocus="clear_text(this)" onblur="clickrecall(this,'Write your text here. . . .')" name="user_text" rows="10" cols="50" placeholder="I would like to buy products from your pharmakeutical store.">Write your text here. . . . 
                    </textarea>
                </p>
                <p class="contact_p"><input type="submit" value="Send"/>&nbsp;<input type="reset" value="Reset"/></p>
                <?php 
                    require 'footer.php';
                ?> 
        </div>
    	
        
      
</div><!-- end of container-->  




