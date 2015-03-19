<?php
        require 'header.php';
        require 'admin_menu.php';
        
?>

<div id="insert_product">
    
    <form id="insert_product_form" method="POST" action="edit_product_action.php">
        <p class="insert_p">Please search for the product.</p>
        <p class="insert_p"><input id="search_name" name="search_name" type="text" value="Product name" onfocus=" return clear_text(this)" onblur="clickrecall(this,'Product name')" size="50"/></p>
        <p class="insert_p">OR</p>
        <p class="insert_p"><input id="search_substance" name="search_substance" type="text" value="Substance" onfocus=" return clear_text(this)" onblur="clickrecall(this,'Substance')" size="50"/></p> 
        <p class="insert_p"><input id="submit" type="submit" value="Search"/></p>
    </form>
    
    
</div>

<?php
        require 'footer.php';
?>

