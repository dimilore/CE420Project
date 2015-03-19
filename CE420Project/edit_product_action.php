<?php
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); 
        session_start();
        require 'header.php';
        require 'admin_menu.php';
        require 'db_connect.php';
        
        $productName=trim($_POST['search_name']);
        $substance=trim($_POST['search_substance']);
        
        $search="SELECT * FROM products WHERE productName LIKE '%$productName%' OR substance LIKE '%$substance%'";
        $search_statement=$pdo->prepare($search);
        $search_statement->execute();
        while ( $record = $search_statement->fetch()) {
            if($record){
                
                echo "<div id='insert_product'>";
                echo "<form id='insert_product_form' method='POST' action='update_products_action.php' enctype='multipart/form-data'>";
                $_SESSION['productId']=$record['productId'];
                echo "<p class='insert_p' ><b>".$record['productName']."</b> has the following fields to edit.</p>";
                echo "<p class='insert_p' ><input id='product_name' name='product_name' type='text' value=".$record['productName']." title='Product name' size='50'/></p>";
                echo "<p class='insert_p' ><input id='substance' name='substance' type='text' value=".$record['substance']." title='Substance' size='50'/></p>";
                echo "<p class='insert_p' ><input id='total_quantity' name='total_quantity' type='text' value=".$record['totalQuantity']." title='Total Quantity' size='50'/></p>";
                echo "<p class='insert_p' ><input id='min_quantity' name='min_quantity' type='text' value=".$record['minQuantity']." title='Minimum Quantity' size='50'/></p>";
                echo "<p class='insert_p' ><input id='price' name='price' type='text' value=".$record['price']." title='Price' size='50'/></p>";
                echo "<p class='insert_p' ><input id='manufacturer' name='manufacturer' type='text' value=".$record['manufacturer']." title='Manufacturer' size='50'/></p>";
                echo "<p class='insert_p'><textarea id='description' name='description' cols='38' title='Product description'>".$record['description']."</textarea></p>";
                echo "<p class='insert_p' ><a href='upload_images/".$record['image']."' target='_blank'>Show product's photo</a></p>";
                echo "<p class='insert_p' ><input id='submit' type='submit' value='Update'/></p>";
                echo "</form>";
                echo "</div>";
            }
                
        }
        
        if($productName=="" || $substance=="" || $productName=="Product name" || $substance=="Substance" || $record['productId']==0 ||$record['substance']==""){
                echo "<div id='insert_product'>";
                echo "<p style='color:red;font-size:40px; text-align:center;'>Product not found!!</p>";
                echo "</div>";
            }    
        $search_statement->closeCursor();
        $pdo=NULL;
        
?>
    
<?php
        require 'footer.php';
?>
