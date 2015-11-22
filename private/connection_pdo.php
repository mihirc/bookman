<?php

$host="localhost"; 
$root=""; 
$root_password=""; 

$user='';
$pass='';
$db=""; 

function SubDomainCreate($subdomain,$db_username,$db_password){
    $dbh = new PDO("mysql:host=$host", $root, $root_password);
		try {
		    
		        $dbh->exec("CREATE DATABASE `$subdomain`;
		                CREATE USER '$db_username'@'localhost' IDENTIFIED BY '$db_password';
		                GRANT ALL ON `$subdomain`.* TO '$db_username'@'localhost';
		                FLUSH PRIVILEGES;") 
		        or die(print_r($dbh->errorInfo(), true));

		    } catch (PDOException $e) {
		        die("DB ERROR: ". $e->getMessage());
		    }
    

}


    
?>