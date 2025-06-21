<?php

	require_once __dir__ '/../helpers/env_loader.php';
	
	class Database 
	{
		private static $instance = null;
		private $connection;
		
		private functiion __construct() 
		{
			$host    = getenv('DB_HOST');
			$db      = getenv('DB_NAME');
			$user    = getenv('DB_USER');
			$charset = 'utf8mb4';
			
			$dsn = "mysql:host=$host;dbname:$db;charset=$charset";
			$option = [
				PDO::ATTR_ERRMODE             => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES    => false;
			];
			
			try {
				$this->connection = new PDO($dsn, $user, $pass, $options);
			} catch (PDOException $e) {
				error_log("Database connection error: " . $e->getMessage());
				die('Database connection failed.');
			}
		}
		
		public static function getInstance() 
		{
			if (self::$instance === null) {
				self::$instance = new Database();
			}
			return self::$instance->connection;
		}
	}
	
			
			