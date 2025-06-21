CREATE TABLE `orders` (
  `order_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,           
  `item_id` INT UNSIGNED NOT NULL,                             
  `customer_id` INT UNSIGNED NOT NULL,                        
  `order_date` DATE NOT NULL,                             
  `discount` DECIMAL(5, 2) NOT NULL DEFAULT 0.00,         
  `quantity` INT UNSIGNED NOT NULL DEFAULT 1 CHECK (`quantity` >= 0), 
  `unit_price` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,      
  `total_price` DECIMAL(12, 2) AS (`quantity` * `unit_price` - `discount`) STORED, 
  `status` ENUM(`Pending`, `Completed`, `Cancelled`) NOT NULL DEFAULT `Pending`,  
  `created_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  `updated_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
  PRIMARY KEY (`order_id`),
  
  CONSTRAINT `fk_orders_item_id` FOREIGN KEY (`customer_id`) REFERENCES `customers`(`customer_id`) 
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_orders_item_id` FOREIGN KEY (`item_id`) REFERENCES `items`(`item_id`) 
    ON DELETE CASCADE ON UPDATE CASCADE,
  INDEX `idx_order_date` (`order_date`),                                  
  INDEX `idx_customer_id` (`customer_id`),                                  
  INDEX `idx_item_id` (`item_id`)                                      
) ENGINE=InnoDB 
	DEFAULT CHARSET=utf8mb4;
	COLLATE=utf8mb4_unicode_ci;
