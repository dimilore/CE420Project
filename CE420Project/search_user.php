<!DOCTYPE html>
<?php include('validate_admin.php'); ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Search User</title>
    <link rel="icon" type="image/ico" href="css/images/icon.ico"/>
	<link rel="stylesheet" type="text/css" href="css/search_style.css">
	<link rel="stylesheet" type="text/css" href="css/logged_in_style.css" />
	
	<meta name="language" content="English">
</head>
		
	<div id="container">
		
	<div id="header">
	    <img src="css/images/rsz_farmakeia1.jpg" alt="Logo image" />
            <div class="logo"><a href="index.php">Pharmaceutics Store</a></div>
    </div><!-- end of header--> 
    <ul id="horizontal_menu"><!--Horizontal menu starts here -->
                <li><a href="#">Orders</a>
                    <ul>
                        <li><a href="admin_pending_orders.php">Pending orders</a></li>
                        <li><a href="admin_orders_history.php">Orders' history</a></li>
                    </ul>
                </li>
                <li><a href="#">Products</a>
                    <ul>
                        <li><a href="insert_product.php">New product</a></li>
                        <li><a href="edit_product.php">Edit product</a></li>
                    </ul>
                </li>    
                <li><a href="#">Users</a>
                    <ul>
                        <li><a href="registration_form.php">New user</a></li>
                        <li><a href="search_user.php">Edit user</a></li>
                    </ul>
                
                </li>
                <li><a href="notification.php">Notifications</a>
                    
                
                </li>
            </ul><!--Horizontal menu ends here -->

	<?php
	// Connection data (server_addrows, database, name, poassword)
	include('db_connect.php');
	?>
	
	<div id="search-form">
		
		<p>Search by username or Pharmacy Name or TIN:</p>

		<form  method="post">
			<table width="200" border="1">
		  <tr>
			<td>keyword</td>
			<td><input type="text" name="name"  placeholder="username, TIN or Pharmacy."/></td>
			
			<td><input id="search" type="submit" name="submit" value=" Find " /></td>
		  </tr>
		</table>
		</form>
		
		</br>
		
		<?php
		if(isset($_REQUEST['submit'])){
		$name=trim($_POST['name']);
		
		$sql=" SELECT * FROM users WHERE username like '%".$name."%' or pharmacy like '%".$name."%' or TIN like '%".$name."%' ORDER BY username";
		
		$count=$pdo->query($sql);
		
		if ($count->rowCount() > 0) {
		//echo "exei vrei matches";
		if ($name==null) echo $count->rowCount().' Users are stored at database.';
		else echo $count->rowCount().' match(es) found similar to '.' "'. $name.'" ';
		
		?>
	
		
		  
		
		<table>
			<caption>Registered Users</caption>
			<tr>	
				<th>#</th>
				<th>Full Name</th>
				<th>Email</th>
				<th>Username</th>
				<th>Pharmacy Name</th>
				<th>TIN</th>
				<th>Address</th>
				<th>Postal Code</th>
				<th>Town</th>
				<th>Phone</th>
				<th>Ranking</th>
				<th>Registration Date</th>
				<th colspan="3">Options - Choose</th>
			</tr>
			<?php
			$tmpCount = 1;
			
			foreach ($count as $row){
			?>
			<tr>
				<td><?php echo $tmpCount ++;?></td>
				<td><?php echo $row['firstName'].' '.$row['lastName'];?></td>
				<td><?php echo $row['email'];?></td>
				<td><?php echo $row['username'];?></td>
				<td><?php echo $row['pharmacy'];?></td>
				<td><?php echo $row['TIN'];?></td>
				<td><?php echo $row['address'];?></td>
				<td><?php echo $row['postalCode'];?></td>
				<td><?php echo $row['town'];?></td>
				<td><?php echo $row['phone'];?></td>
				<td><?php echo $row['ranking'];?></td>
				<td><?php echo $row['register_Date'];?></td>
				<td colspan="2">
					<form action="edit_user.php" method="post">
						<input type="hidden" name="ID" value="<?php echo $row['TIN']?>">
						<input id="edit" type="submit" value="Edit">
					</form>		
				</td>		
				<td>
					<form action="delete.php" method="post"  value="Go" onclick="return confirm('Are you sure you want to delete <?php echo $row['username'];?>?')">
						<input type="hidden" name="ID" value="<?php echo $row['TIN']?>">
						<input id="delete" type="submit" value="Delete">
					</form>
				</td>
			</tr>
			<?php }?>
		</table>
		
		
	
		<?php
		} else {
			if ($name==null) echo "No users stored at database";
			else echo 'No entry similar to '.' "'. $name.'" '. 'found';
		}
		
		}
		?>

		
	</div>
	
	</div>

</html>