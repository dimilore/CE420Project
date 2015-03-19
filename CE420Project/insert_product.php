<?php
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        require 'header.php';
        require 'admin_menu.php';
        require 'db_connect.php';
        
        $productName=trim($_POST['product_name']);
        $substance=trim($_POST['substance']);
        $total_Quantity=trim($_POST['total_quantity']);
        $min_Quantity=trim($_POST['min_quantity']);
        $price=trim($_POST['price']);
        $description=$_POST['description'];
        $manufacturer=$_POST['manufacturer'];
        $image=$_FILES['file']['name'];
        $category=$_POST['category'];
        //something went wrong
        $flag=0;
          
        /*creates a unique string for image file which stored in database */
        function create_guid($prefix = '') {
            $chars = md5(uniqid(mt_rand(), true));
            $uuid  = substr($chars,0,8) . '-';
            $uuid .= substr($chars,8,4) . '-';
            $uuid .= substr($chars,12,4) . '-';
            $uuid .= substr($chars,16,4) . '-';
            $uuid .= substr($chars,20,12);
            return $prefix . $uuid;	
	}
        
         
        
        
        $tmp_name=create_guid();
        $dir='upload_images/';
        if (!is_dir($dir)) {
            mkdir($dir);
            $target = 'upload_images/'.$tmp_name;
        }
        else{
            $target = 'upload_images/'.$tmp_name;
        }
        
        //if product's name is lower than 5 chars
        if(strlen($productName)<=4)
            $flag=1;//flag=1 means something went wrong. flag=0 means OK
        
        
       
        
        if(!empty($productName) && !empty($substance) && !empty($total_Quantity) && !empty($min_Quantity) && !empty($price) && !empty($description) &&!empty($manufacturer) && !empty($image)){
            if($productName!="Product name" && $substance!="Substance" && $total_Quantity!="Total Quantity" && $min_Quantity!="Minimum Quantity" && $price!="Price" && $description!="Description" && $manufacturer!="Manufacturer"){
                //Check if a product already exists in the database
                $check_if_exist="SELECT * FROM products WHERE productName LIKE '%$productName%'";
                $check_statement=$pdo->prepare($check_if_exist);
                $check_statement->execute();
                
                while ( $record = $check_statement->fetch() ) {
                    //returns true if record found
                    if($record){
                        $flag=1; //found same records
                        break;
                    }
                    
                }
                //if record returns false we can insert our product
                if(!$record ){
                    //if the data type is correct
                    if(filter_var($total_Quantity,FILTER_VALIDATE_INT) && filter_var($min_Quantity,FILTER_VALIDATE_INT) && filter_var($price,FILTER_VALIDATE_FLOAT) && $flag==0){
                        if($total_Quantity>=0 && min_Quantity>=0 && $price>0){
                        
                            $sql="INSERT INTO products (productName,substance,totalQuantity,minQuantity,price,description,image,manufacturer,category) VALUES ('$productName','$substance','$total_Quantity','$min_Quantity','$price','$description','$tmp_name','$manufacturer','$category')";
                            $statement=$pdo->prepare($sql);
                            $statement->execute();
                            
                            $statement->closeCursor();
                            
                            move_uploaded_file( $_FILES['file']['tmp_name'], $target);
                            
                            $flag=1;//everything ok
                            $pdo=NULL;
                            header('Location:insert_product.php');
                        
                        } 
                    }
                }
                
             }
                
        }
        else if($flag==0){
            
                echo "<p style='color:red;font-size:30px; text-align:center;'>You have to fill all fields to insert the product!!</p>";
            
        }
?>

    <div id="insert_product">
    
            <form id="insert_product_form" method="POST" action="insert_product.php" enctype="multipart/form-data">
                <p class="insert_p">The following fields are mandatory.</p>
                
                <p class="insert_p">
                    <select name="category" title="Product category">
                        <option value="category">------------Select category------------</option>
                        <option value="Cardiovascular">Cardiovascular</option>
                        <option value="Acetylsalicylic">Acetylsalicylic</option>
                        <option value="Pathologic">Pathologic</option>
                        <option value="Other">Other</option>
                    </select>
                    
                </p>
                
                <p class="insert_p"><input id="product_name" name="product_name" type="text" value='<?php echo ($flag) ? "Product name" : $productName;?>' onfocus=" return clear_text(this)" onblur="clickrecall(this,'Product name')" title='Product name' maxlength="45" size="50" placeholder="e.g. Depon" /></p>
                
                <p class="insert_p"><input id="substance" name="substance" type="text" value='<?php echo ($flag) ? "Substance": $substance;?>' onfocus=" return clear_text(this)" onblur="clickrecall(this,'Substance')" title='Substance' maxlength="45" size="50" placeholder="e.g. Acetaminophen" /></p>
                
                <p class="insert_p">
                    <input id="total_quantity" name="total_quantity" type="text" value='<?php echo ($flag) ? "Total Quantity": $total_Quantity;?>' onfocus=" return clear_text(this)" onblur="clickrecall(this,'Total Quantity')" title='Total Quantity' size="50" placeholder="e.g. 1000" />
                    <?php if ($total_Quantity<0) echo '<p style="color:red;"> Total quantity must be positive</p>';?>
                </p>
                
                <p class="insert_p">
                    <input id="min_quantity" name="min_quantity" type="text" value='<?php echo ($flag) ? "Minimum Quantity": $min_Quantity;?>' onfocus=" return clear_text(this)" onblur="clickrecall(this,'Minimum Quantity')" title='Minimum Quantity' size="50" placeholder="e.g. 20" />
                    <?php if ($min_Quantity<0) echo '<p style="color:red;"> Minimum quantity must be positive</p>';?>
                </p>
                
                <p class="insert_p">
                    <input id="price" name="price" type="text" value='<?php echo ($flag) ? "Price": $price;?>' onfocus=" return clear_text(this)" onblur="clickrecall(this,'Price')" title='Price' size="50" placeholder="e.g. 3.69" />
                    <?php if ($price<0) echo '<p style="color:red;"> Price must be positive</p>';?>
                </p>
               
                <p class="insert_p"><input id="manufacturer" name="manufacturer" type="text" value='<?php echo ($flag) ? "Manufacturer": $manufacturer;?>' onfocus=" return clear_text(this)" onblur="clickrecall(this,'Manufacturer')" title='Manufacturer' size="50" placeholder="e.g. Bristol-Myers Squibb" /></p>
                <p class="insert_p"><textarea id="description" name="description" cols="38" onfocus=" return clear_text(this)" onblur="clickrecall(this,'Type the description')" title='Product description' placeholder="e.g. Paracetamol is reported as an ingredient of Depon in Greece" >Type the description</textarea>
                    <?php if (!empty($description)) echo '<p style="color:red;"> Description is empty</p>';?>
                </p>
                <p class="insert_file"><input id="file" name="file" type="file" accept="upload_images/*"/></p>
                
                <p class="insert_p"><input id="submit" type="submit" value="Insert"/>&nbsp;<input type="reset" value="Reset"/></p>
                
            </form>
    
    
    </div>
    

<?php
        require 'footer.php';
?>


