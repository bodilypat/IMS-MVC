CREATE TABLE `products` (
  `product_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,  
  `sku` VARCHAR(100) NOT NULL UNIQUE,
  `product_name` VARCHAR(255) NOT NULL,                          
  `description` TEXT DEFAULT NULL, 
  `cost_price` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
  `sale_price` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,                           
  `quantity` INT UNSIGNED NOT NULL DEFAULT 0,                   
  `category_id` INT UNSIGNED NOT NULL,                           
  `vendor_id` INT UNSIGNED NOT NULL,                            
  `status` ENUM(`Available`, `Out of Stock`, `Discontinued`) NOT NULL DEFAULT `Available`,
  `product_image_url` VARCHAR(255) DEFAULT NULL,                 
  `created_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,     
  `updated_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
  `deleted_on` TIMESTAMP NULL DEFAULT NULL,                      
  
  PRIMARY KEY (`product_id`),                                    
  
  CONSTRAINT 'fk_products_vendor_id'FOREIGN KEY (`vendor_id`) REFERENCES `vendors`(`vendor_id`) 
		ON DELETE CASCADE ON UPDATE CASCADE,  
  CONSTRAINT `fk_products_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories`(`category_id`) 
	    ON DELETE SET NULL ON UPDATE CASCADE,  
		
  INDEX `idx_product_name` (`product_name`),                                        
  INDEX `idx_vendor_id` (`vendor_id`),                                           
  INDEX `idx_category_id` (`category_id`),                                        
  INDEX `idx_status` (`status`)                                               
) ENGINE=InnoDB 
  DEFAULT CHARSET=utf8mb4 
  COLLATE=utf8mb4_unicode_ci;
