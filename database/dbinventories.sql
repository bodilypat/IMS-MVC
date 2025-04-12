SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Table structure for table `customer`
--
CREATE TABLE `customers` (
  `customer_id` INT(11) NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  `mobile` VARCHAR(15) NOT NULL,
  `phone` VARCHAR(15) DEFAULT NULL,
  `address` VARCHAR(255) NOT NULL,
  `city` VARCHAR(50) DEFAULT NULL,  
  `state` VARCHAR(50) NOT NULL,     
  `status` ENUM('Active', 'Inactive') NOT NULL DEFAULT 'Active',
  `createdOn` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE (`email`),  
  UNIQUE (`mobile`),  
  PRIMARY KEY (`customer_id`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `orders` (
  `order_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,           
  `item_id` INT UNSIGNED NOT NULL,                             
  `customer_id` INT UNSIGNED NOT NULL,                        
  `order_date` DATE NOT NULL,                             
  `discount` DECIMAL(5, 2) NOT NULL DEFAULT 0.00,         
  `quantity` INT UNSIGNED NOT NULL DEFAULT 1 CHECK (`quantity` >= 0), 
  `unit_price` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,      
  `total_price` DECIMAL(12, 2) AS (`quantity` * `unit_price` - `discount`) STORED, 
  `status` ENUM('Pending', 'Completed', 'Cancelled') NOT NULL DEFAULT 'Pending',  
  `created_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  `updated_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
  PRIMARY KEY (`order_id`),
  FOREIGN KEY (`customer_id`) REFERENCES `customers`(`customer_id`) 
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`item_id`) REFERENCES `items`(`item_id`) 
    ON DELETE CASCADE ON UPDATE CASCADE,
  INDEX 'idx_order_date'(`order_date`),                                  
  INDEX 'idx_customer_id' (`customer_id`),                                  
  INDEX 'idx_item_id' (`item_id`)                                      
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `invoices` (
  `invoice_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` INT UNSIGNED NOT NULL,
  `order_id` INT UNSIGNED DEFAULT NULL,  -- Optional: tie invoice to a specific order
  `invoice_date` DATE NOT NULL,
  `due_date` DATE NOT NULL,
  `subtotal` DECIMAL(12, 2) NOT NULL DEFAULT 0.00,
  `tax` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
  `discount` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
  `total_amount` DECIMAL(15, 2) GENERATED ALWAYS AS (`subtotal` + `tax` - `discount`) STORED,
  `status` ENUM('Unpaid', 'Paid', 'Overdue', 'Cancelled') NOT NULL DEFAULT 'Unpaid',
  `notes` TEXT DEFAULT NULL,
  `created_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  PRIMARY KEY (`invoice_id`),

  FOREIGN KEY (`customer_id`) REFERENCES `customers`(`customer_id`)
    ON DELETE CASCADE ON UPDATE CASCADE,

  FOREIGN KEY (`order_id`) REFERENCES `orders`(`order_id`)
    ON DELETE SET NULL ON UPDATE CASCADE,

  INDEX `idx_customer_id` (`customer_id`),
  INDEX `idx_invoice_date` (`invoice_date`),
  INDEX `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `items` (
  `item_id` INT(11) NOT NULL AUTO_INCREMENT,             
  `item_number` VARCHAR(255) NOT NULL,                  
  `product_id` INT(11) NOT NULL,                         
  `item_name` VARCHAR(255) NOT NULL,                     
  `discount` DECIMAL(5, 2) NOT NULL DEFAULT 0.00,       
  `stock` INT(11) NOT NULL DEFAULT 0 CHECK (`stock` >= 0), 
  `unit_price` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,     
  `image_url` VARCHAR(255) DEFAULT 'imageNotAvailable.jpg', 
  `status` VARCHAR(20) NOT NULL DEFAULT 'Active',       
  `description` TEXT NOT NULL,                          
  PRIMARY KEY (`item_id`),
  UNIQUE (`item_number`),                               
  FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`) 
    ON DELETE CASCADE ON UPDATE CASCADE,                
  INDEX (`item_number`),                                 
  INDEX (`product_id`)                                   
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


create frontend JavaScript file for handling API requests (AJAX) 
CREATE TABLE `purchases` (
  `purchase_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,   -- Use UNSIGNED for IDs to avoid negative values
  `item_id` INT UNSIGNED NOT NULL,                       -- Use UNSIGNED for item IDs (they can't be negative)
  `purchase_date` DATE NOT NULL,                          -- Date when purchase was made
  `unit_price` DECIMAL(12, 2) NOT NULL DEFAULT 0.00,      -- Increased precision for `unit_price`
  `quantity` INT UNSIGNED NOT NULL DEFAULT 1 CHECK (`quantity` >= 0), -- Ensure non-negative quantities
  `total_price` DECIMAL(15, 2) GENERATED ALWAYS AS (`unit_price` * `quantity`) STORED, -- Calculated total price
  `vendor_id` INT UNSIGNED NOT NULL,                      -- Vendor ID should be UNSIGNED
  `created_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,   -- Timestamp for record creation
  `updated_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Auto-updates on changes
  
  PRIMARY KEY (`purchase_id`),
  
  FOREIGN KEY (`vendor_id`) REFERENCES `vendors`(`vendor_id`) 
    ON DELETE CASCADE ON UPDATE CASCADE,
  
  FOREIGN KEY (`item_id`) REFERENCES `items`(`item_id`) 
    ON DELETE CASCADE ON UPDATE CASCADE,

  INDEX `idx_purchase_date` (`purchase_date`),  -- Added an index with a name for better clarity
  INDEX `idx_vendor_id` (`vendor_id`),        -- Added index for faster queries involving vendor_id
  INDEX `idx_item_id` (`item_id`)             -- Added index for faster queries involving item_id
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `suppliers` (
  `supplier_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(150) DEFAULT NULL UNIQUE,
  `phone` VARCHAR(20) DEFAULT NULL,
  `address` VARCHAR(255) DEFAULT NULL,
  `status` ENUM('Active', 'Inactive') NOT NULL DEFAULT 'Active',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`supplier_id`),
  INDEX (`supplier_name`),
  INDEX (`status`)
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `vendors` (
  `vendor_id` INT(11) NOT NULL AUTO_INCREMENT,
  `vendor_name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) DEFAULT NULL,
  `mobile` VARCHAR(15) NOT NULL,
  `phone` VARCHAR(15) DEFAULT NULL,
  `address` VARCHAR(255) NOT NULL,
  `city` VARCHAR(100) DEFAULT NULL,
  `state` VARCHAR(50) NOT NULL,
  `status` VARCHAR(50) NOT NULL DEFAULT 'Active',
  `created_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`vendor_id`),
  INDEX (`email`),
  INDEX (`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `products` (
  `product_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,           
  `product_name` VARCHAR(255) NOT NULL,                          
  `description` TEXT DEFAULT NULL,                               
  `price` DECIMAL(10, 2) NOT NULL,                              
  `quantity` INT UNSIGNED NOT NULL DEFAULT 0,                   
  `category_id` INT UNSIGNED NOT NULL,                           
  `vendor_id` INT UNSIGNED NOT NULL,                            
  `status` ENUM('Available', 'Out of Stock', 'Discontinued') NOT NULL DEFAULT 'Available',
  `product_image_url` VARCHAR(255) DEFAULT NULL,                 
  `created_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,     
  `updated_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
  `deleted_on` TIMESTAMP NULL DEFAULT NULL,                      
  PRIMARY KEY (`product_id`),                                    
  FOREIGN KEY (`vendor_id`) REFERENCES `vendors`(`vendor_id`) ON DELETE CASCADE,  
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`category_id`) ON DELETE SET NULL,  
  INDEX (`product_name`),                                        
  INDEX (`vendor_id`),                                           
  INDEX (`category_id`),                                        
  INDEX (`status`)                                               
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE 'categories' (
	'category_id' INT UNSIGNED NOT NULL AUTO_INCREMENT,
	'category_name' VARCHAR(100) NOT NULL,
	PRIMARY KEY ('category_id')
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users` (
  `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(100) NOT NULL,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password_hash` VARCHAR(255) NOT NULL,
  `status` ENUM('Active', 'Inactive', 'Suspended') NOT NULL DEFAULT 'Active',
  'role' ENUM('Admin','Manager','Employee') NOT NULL DEFAULT 'Employee', 
  `last_login_at` DATETIME NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;