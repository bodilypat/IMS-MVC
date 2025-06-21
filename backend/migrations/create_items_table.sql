CREATE TABLE `items` (
  `item_id` INT(11) NOT NULL AUTO_INCREMENT, 
  `product_id` INT(11) NOT NULL,      
  `item_number` VARCHAR(100) NOT NULL,                  
  `serial_number VARCHAR(100) NOT NULL,
  `item_name` VARCHAR(255) NOT NULL,                     
  `discount` DECIMAL(5, 2) NOT NULL DEFAULT 0.00,       
  `stock` INT(11) NOT NULL DEFAULT 0 CHECK (`stock` >= 0), 
  `unit_price` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,     
  `image_url` VARCHAR(255) DEFAULT `imageNotAvailable.jpg`, 
  `status` ENUM(`Active`,`Inactive`) NOT NULL DEFAULT `Active`,       
  `description` TEXT NOT NULL,                          
  
  PRIMARY KEY (`item_id`),
                              
  CONSTRAINT `fk_items_product_id` FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`) 
		ON DELETE CASCADE ON UPDATE CASCADE,     
		
  INDEX `idx_item_number` (`item_number`),                                 
  INDEX `idx_product_id` (`product_id`)                                   
) ENGINE=InnoDB 
	DEFAULT CHARSET=utf8mb4;
	COLLATE=utf8mb4_unicode_ci;
	
