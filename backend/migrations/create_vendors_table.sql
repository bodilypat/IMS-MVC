CREATE TABLE `vendors` (
  `vendor_id` INT(11) NOT NULL AUTO_INCREMENT,
  `vendor_name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) DEFAULT NULL UNIQUE,
  `mobile` VARCHAR(15) NOT NULL,
  `phone` VARCHAR(15) DEFAULT NULL,
  `address` VARCHAR(255) NOT NULL,
  `city` VARCHAR(100) DEFAULT NULL,
  `state` VARCHAR(50) NOT NULL,
  `status` ENUM(`Active`,`Inactive`) NOT NULL DEFAULT `Active`,
  `created_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`vendor_id`),
  
  INDEX `idx_email` (`email`),
  INDEX `idx_mobile` (`mobile`)
  INDEX `idx_vendor_status` (`status`),
  INDEX `idx_vendor_city` (`city`)
) ENGINE=InnoDB 
	DEFAULT CHARSET=utf8mb4
	COLLATE=utf8mb4_unicode_ci;
