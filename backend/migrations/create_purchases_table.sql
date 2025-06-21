CREATE TABLE `purchases` (
  `purchase_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,   
  `item_id` INT UNSIGNED NOT NULL,  
  `vendor_id` INT UNIQUE NOT NULL,
  `purchase_reference` VARCHAR(100) DEFAULT NULL,
  `purchase_date` DATE NOT NULL,                          
  `unit_price` DECIMAL(12, 2) NOT NULL DEFAULT 0.00 CHECK (`unit_price` >= 0),      
  `quantity` INT UNSIGNED NOT NULL DEFAULT 1 CHECK (`quantity` > 0), 
  `total_price` DECIMAL(15, 2) GENERATED ALWAYS AS (`unit_price` * `quantity`) STORED, 
  `description` TEXT DEFAULT NULL,
  `created_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  `updated_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,

  PRIMARY KEY (`purchase_id`),
  
  CONSTRAINT `fk_purchases_vendor_id` FOREIGN KEY (`vendor_id`) 
	REFERENCES `vendors`(`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  
  CONSTRAINT `fk_purchases_item_id` FOREIGN KEY (`item_id`) 
	REFERENCES `items`(`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,

  INDEX `idx_purchase_date` (`purchase_date`),  
  INDEX `idx_vendor_id` (`vendor_id`),        
  INDEX `idx_item_id` (`item_id`)  
  INDEX `idx_purchases_ref` (`purchases_reference`)
) ENGINE=InnoDB 
	DEFAULT CHARSET=utf8mb4 
	COLLATE=utf8mb4_unicode_ci;
