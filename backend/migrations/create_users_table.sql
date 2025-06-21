CREATE TABLE `users` (
  `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(100) NOT NULL,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password_hash` VARCHAR(255) NOT NULL,
  `status` ENUM(`Active`, `Inactive`, `Suspended`) NOT NULL DEFAULT `Active`,
  `role` ENUM(`Admin`, `Manager`, `Employee`) NOT NULL DEFAULT `Employee`, 
  `last_login_at` DATETIME NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB 
	DEFAULT CHARSET=utf8mb4 
	COLLATE=utf8mb4_unicode_ci;
