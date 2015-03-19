<?php

        $host='localhost';
        $dbname='stf_db';
        $dbuser='root';
        $dbpass='';
        try {
                
                $pdo = new PDO("mysql:host=$host;dbname=$dbname;", $dbuser, $dbpass);
        } catch (PDOException $e) 
        { 
                print "Database Error: " . $e->getMessage();
                die("Unable to create PDO Object");
        }
?>
