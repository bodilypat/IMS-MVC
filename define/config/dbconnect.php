<?php
	// Connect to database
	try{
		$dbcon = new PDO(DSN, DB_USER, DB_PASSWORD);
		$dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e){
		$errorMessage = $e->getMessage();
		echo $errorMessage;
		exit();
	}
?>
