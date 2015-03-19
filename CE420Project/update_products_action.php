<?php
        session_start();
        require 'db_connect.php';
        $productId=$_SESSION['productId'];

        $productName=trim($_POST['product_name']);
        $substance=trim($_POST['substance']);
        $total_Quantity=trim($_POST['total_quantity']);
        $min_Quantity=trim($_POST['min_quantity']);
        $price=trim($_POST['price']);
        $description=$_POST['description'];
        $manufacturer=$_POST['manufacturer'];
        
          
        $flag=0;//flag=0 means that every field is OK
        
        
        //if product's name is lower than 5 chars
        if(strlen($productName)<=4)
            $flag=1;//flag=1 means something went wrong. flag=0 means OK
        
        
       
        
        if(!empty($productName) && !empty($substance) && !empty($total_Quantity) && !empty($min_Quantity) && !empty($price) && !empty($description) && !empty($manufacturer)){
            if($productName!="Product name" && $substance!="Substance" && $total_Quantity!="Total Quantity" && $min_Quantity!="Minimum Quantity" && $price!="Price" && $description!="Description" && $manufacturer!="Manufacturer"){
                    if(filter_var($total_Quantity,FILTER_VALIDATE_INT) && filter_var($min_Quantity,FILTER_VALIDATE_INT) && filter_var($price,FILTER_VALIDATE_FLOAT) && $flag==0){
                        
                            $sql="UPDATE products SET productName='$productName',substance='$substance',totalQuantity='$total_Quantity',minQuantity='$min_Quantity',price='$price',description='$description',manufacturer='$manufacturer' WHERE productId='$productId'";
                            $statement=$pdo->prepare($sql);
                            $statement->execute();
                            
                            $statement->closeCursor();
                            $pdo=NULL;
                            
                            header('Location:edit_product.php');
                        
                       
                    }
                
             }
                
        }
        else{
            echo "<p style='color:red;font-size:40px; text-align:center;'>Error!!</p>";
        }

        
?>

