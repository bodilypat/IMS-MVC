<?php
	// Connect to database
	try{
		$deal = new PDO(DSN, DB_USER, DB_PASSWORD);
		$deal->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e){
		$errorMessage = $e->getMessage();
		echo $errorMessage;
		exit();
	}
?>
