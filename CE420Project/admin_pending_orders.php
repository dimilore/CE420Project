<?php


error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//validate_user.php must be put at the top of EVERY user's page
include('validate_admin.php');
require 'header.php';
require 'admin_menu.php';
require 'db_connect.php';
?>

<?php
            $amount2=0;
            $counter=0;
            echo '<br>';
            echo "<table cellpadding='3' cellspacing='2' border='1' width='97%'>";
            echo "<tr>"
            . "<th>ID</th>"
            . "<th>Order Date</th>"
            . "<th>Taxis Num</th>"
            . "<th>Name</th>"
            . "<th>Surname</th>"
            . "<th>Product</th>"
            . "<th>QTY</th>"
              . "<th>Discount</th>"      
            . "<th>Price</th>" 
            . "<th>Payment</th>" 
            . "<th>Status</th>"
            . "<th>Ex</th>";
            echo "</tr>";
            
            //select pending orders
            $sql_order_id="SELECT * FROM orders WHERE finished_Order='0'";
            $statement=$pdo->prepare($sql_order_id);
            $statement->execute();
            while ( $record = $statement->fetch() ) {
                $order_id=$record['order_id'];
                
                $id[$counter]=$order_id;
                
                $order_status=$record['order_Status'];
                $order_date=$record['order_Date'];
                $users_TIN=$record['USERS_TIN'];
                
                $tin[$counter]=$record['USERS_TIN'];
                
                $discount=$record['discount'];
                    
                $sql_user="SELECT * FROM users WHERE TIN='$users_TIN'";
                $statement_user=$pdo->prepare($sql_user);
                $statement_user->execute();
                while($rec_user=$statement_user->fetch()){
                        
                        $firstname=$rec_user['firstName'];
                        $lastname=$rec_user['lastName'];

                        
                        $sql_order="SELECT * FROM order_details WHERE ORDERS_order_id='$order_id'";
                        $statement_order=$pdo->prepare($sql_order);
                        $statement_order->execute();
                            while ( $rec_order = $statement_order->fetch() ) {
                                $productId=$rec_order['PRODUCTS_productId'];
                                $quantity=$rec_order['quantityOrdered'];
                                
                                $qty[$counter]=$quantity;
                                
                                $price=$rec_order['priceEach'];

                                $sql_prod_name="SELECT * FROM products WHERE productId='$productId'";
                                $statement_prod=$pdo->prepare($sql_prod_name);
                                $statement_prod->execute();
                                while ( $prod = $statement_prod->fetch() ) {
                                    $prodname=$prod['productName'];

                                    $sql_pay="SELECT * FROM payments WHERE USERS_TIN='$users_TIN'";
                                    $statement_pay=$pdo->prepare($sql_pay);
                                    $statement_pay->execute();
                                    while ( $pay = $statement_pay->fetch() ) {
                                        $amount=$pay['amount'];
                                        $payment_method=$pay['payment_method'];
                                        $check_id=$pay['check_Id'];
                                        if($order_status=="IN PROGRESS" && $finished_order==0){
                                                echo "<tr>";
                                                echo "<td align='center'>".$order_id."</td>";
                                                echo "<td align='center'>".$order_date."</td>";
                                                echo "<td align='center'>".$users_TIN."</td>";
                                                echo "<td align='center'>".$firstname."</td>";
                                                echo "<td align='center'>".$lastname."</td>";
                                                echo "<td align='center'>".$prodname."</td>";
                                                echo "<td align='center'>".$quantity."</td>";
                                                echo "<td align='center'>".$discount."</td>";
                                                echo "<td align='center'>".$price*$quantity."€</td>";
                                                $amount2=$amount2+($price*$quantity);
                                                echo "<td align='center'>".$payment_method."</td>";
                                                echo "<td align='center'>".$order_status."</td>";
                                                echo "<td align='center'><a style='text-decoration:none;color:slategray;' href='admin_orders_finished.php?id=$id[$counter]&tin=$tin[$counter]&qty=$qty[$counter]'>Execute</a></td>";
                                                echo "</tr>";
                                                $counter=$counter+1;
                                                break;
                                                

                                        }
                                    }
                                }
                            }
                                    
                    }
            }
            
//            if($order_status=="IN PROGRESS" && $finished_order==0){
//                echo "<th>Total amount</th>";
//                echo "<td align='center'>".$amount2."€</td>";
//            }
            
            echo "</table>";
?>


<?php
require 'footer.php';
?>
