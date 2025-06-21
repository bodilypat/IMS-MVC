<?php

	/* Load .env variable */
	require_once __DIR__ .'/../helpers/env_loader.php';
	
	/* Load global constants */
	require_once __DIR__ .'/constants.php';
	
	/* Load database connection class */
	require_once __DIR__ .'/.database.php';
	
	/* Optiionally start session  */
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
	
	/* set global reporting (adjust for production) */
	error_reporting(E_All);
	ini_set('display_error', 1);
	
	/* Set content-type: header if used in APIs */
	header('Content-Type: application/json; charset=utf-8');
	
	