<meta http-equiv="refresh" content="1;URL= search_user.php"> 

<?php
include('validate_admin.php');
// Connection data (server_address, database, name, poassword)
$hostdb = 'localhost';
$namedb = 'stf_db';
$userdb = 'root';
$passdb = '';

try {



  // Connect and create the PDO object
  $conn = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  $conn->exec("SET CHARACTER SET utf8");      // Sets encoding UTF-8

  // Delete rows in "sites", according to the value of "category" column
  $sql = "DELETE FROM `users` WHERE `TIN` =:afm";
  
  $query = $conn->prepare( $sql );
  
  
  
  $query->execute( array( ":afm" => $_POST["ID"] ) );

  $conn = null;        // Disconnect
}
catch(PDOException $e) {
  echo $e->getMessage();
}

echo "Deleted user with TIN: ".$_POST["ID"];

?>
