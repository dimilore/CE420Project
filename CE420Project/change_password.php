<?php

    require 'header.php';
    require 'user_menu.php';
    
?>

<div id="insert_product">
    
     <form id="insert_product_form" method="POST" action="change_password_action.php">
        <p class="insert_p">Please insert your current password.</p>
        <p class="insert_p"><input name="password" type="password" title="Please insert your current password"/></p>
         <p class="insert_p">Please type your new password.</p>
        <p class="insert_p"><input name="new_password" type="password" title="Please insert your new password"/></p>
        <p class="insert_p">Please retype your new password.</p>
        <p class="insert_p"><input name="retype_new_password" type="password" title="Please retype your new password."/></p>
        <p class="insert_p"><input type="submit" value="update pass"/></p>
    </form>
    
    
    
    
</div>



<?php

    require 'footer.php';
?>