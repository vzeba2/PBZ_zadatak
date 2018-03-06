<?php

$host = "localhost";
$db_name = "zaposlenici";
$username = "root";
$password = "Test123";
  
try{
    	$con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
	}
  
		catch(PDOException $exception){
			
    	echo "Connection error: ".$exception->getMessage();
	}

?>