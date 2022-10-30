<?php
	$sql_dbname="db_companychallenge";
	$sql_username="root";
	$sql_hostname="localhost";
	$sql_password="";
	


	//open a connection to database server
	$conn=mysqli_connect($sql_hostname,$sql_username,$sql_password) ;//or die(mysqli_error($conn));

	if($conn == NULL){
		//echo "<pre>mysqli_connect.php: Successfully connected to database ".$sql_dbname."</pre>";
		
		echo "Database connection temporarily unavailable.";
		exit;
	}


	//select the database
	$db=mysqli_select_db($conn,$sql_dbname) or die(mysqli_error($conn)); 
?>