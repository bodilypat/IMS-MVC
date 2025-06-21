CREATE TABLE `customers` (
  `customer_id` INT(11) NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  `mobile` VARCHAR(15) NOT NULL,
  `phone` VARCHAR(15) DEFAULT NULL,
  `address` VARCHAR(255) NOT NULL,
  `city` VARCHAR(50) DEFAULT NULL,  
  `state` VARCHAR(50) NOT NULL,     
  `status` ENUM(`Active`, `Inactive`) NOT NULL DEFAULT `Active`,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNI
  UNIQUE KEY 'unique_email' (`email`),  
  UNIQUE KEY 'unique_mobile' (`mobile`),  
  PRIMARY KEY (`customer_id`),
) ENGINE=InnoDB 
	DEFAULT CHARSET=utf8mb4;
	COLLATE=utf8mb_unicode_ci;
	