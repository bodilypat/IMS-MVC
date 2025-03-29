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
  `city` VARCHAR(30) DEFAULT NULL,
  `state` VARCHAR(30) NOT NULL,
  `status` ENUM('Active', 'Inactive') NOT NULL DEFAULT 'Active',
  `createdOn` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `orders` (
  `order_id` INT(11) NOT NULL AUTO_INCREMENT,            -- Auto-incrementing unique order ID
  `item_id` INT(11) NOT NULL,                             -- Foreign key to items
  `customer_id` INT(11) NOT NULL,                         -- Foreign key to customers
  `order_date` DATE NOT NULL,                             -- Date the order was placed
  `discount` DECIMAL(5, 2) NOT NULL DEFAULT 0.00,         -- Discount applied to the order
  `quantity` INT(11) NOT NULL DEFAULT 1 CHECK (`quantity` >= 0), -- Quantity ordered, with a check constraint for non-negative values
  `unit_price` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,      -- Unit price of the ordered item
  `total_price` DECIMAL(10, 2) AS (`quantity` * `unit_price` - `discount`) STORED, -- Calculated field for total price
  `status` ENUM('Pending', 'Completed', 'Cancelled') NOT NULL DEFAULT 'Pending',  -- Status of the order
  `created_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, -- Tracks order creation
  `updated_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Tracks last update
  PRIMARY KEY (`order_id`),
  FOREIGN KEY (`customer_id`) REFERENCES `customers`(`customer_id`) 
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`item_id`) REFERENCES `items`(`item_id`) 
    ON DELETE CASCADE ON UPDATE CASCADE,
  INDEX (`order_date`),                                  -- Index for quick access to orders by date
  INDEX (`customer_id`),                                  -- Index for optimizing customer-related queries
  INDEX (`item_id`)                                       -- Index for optimizing item-related queries
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `items` (
  `item_id` INT(11) NOT NULL AUTO_INCREMENT,             -- Auto-incrementing unique item ID
  `item_number` VARCHAR(255) NOT NULL,                   -- Unique item number, not null
  `product_id` INT(11) NOT NULL,                         -- Foreign key to the products table
  `item_name` VARCHAR(255) NOT NULL,                     -- Name of the item
  `discount` DECIMAL(5, 2) NOT NULL DEFAULT 0.00,        -- Discount, use DECIMAL for precision
  `stock` INT(11) NOT NULL DEFAULT 0 CHECK (`stock` >= 0), -- Stock quantity, check for non-negative values
  `unit_price` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,     -- Unit price of the item, use DECIMAL for precision
  `image_url` VARCHAR(255) DEFAULT 'imageNotAvailable.jpg', -- Image URL (renamed for consistency)
  `status` VARCHAR(20) NOT NULL DEFAULT 'Active',        -- Status as a VARCHAR, more flexible than ENUM
  `description` TEXT NOT NULL,                           -- Description of the item
  PRIMARY KEY (`item_id`),
  UNIQUE (`item_number`),                                -- Ensure item_number is unique
  FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`) 
    ON DELETE CASCADE ON UPDATE CASCADE,                 -- Ensures referential integrity with products
  INDEX (`item_number`),                                 -- Index for quick lookup by item number
  INDEX (`product_id`)                                   -- Index for optimization on foreign key lookup
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `purchases` (
  `purchase_id` INT(11) NOT NULL AUTO_INCREMENT,
  `item_id` INT(11) NOT NULL,           -- Use item_id instead of item_number
  `purchase_date` DATE NOT NULL,
  `unit_price` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `quantity` INT(11) NOT NULL DEFAULT 1,
  `vendor_id` INT(11) NOT NULL,
  PRIMARY KEY (`purchase_id`),
  FOREIGN KEY (`vendor_id`) REFERENCES `vendors`(`vendor_id`) 
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`item_id`) REFERENCES `items`(`item_id`) 
    ON DELETE CASCADE ON UPDATE CASCADE,
  INDEX (`purchase_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `suppliers` (
  `supplier_id` INT AUTO_INCREMENT PRIMARY KEY,
  `supplier_name` VARCHAR(255) NOT NULL,
  `contact_info` VARCHAR(255),
  `address` VARCHAR(255),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX (`supplier_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `product_id` INT(11) NOT NULL AUTO_INCREMENT,
  `product_name` VARCHAR(255) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `price` DECIMAL(10, 2) NOT NULL,
  `quantity` INT(11) NOT NULL DEFAULT 0,
  `vendor_id` INT(11) NOT NULL,
  `created_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`),
  FOREIGN KEY (`vendor_id`) REFERENCES `vendors`(`vendor_id`) ON DELETE CASCADE,
  INDEX (`product_name`),
  INDEX (`vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `user` (
  `user_id` INT(11) NOT NULL AUTO_INCREMENT,         -- Automatically generate unique user IDs
  `fullName` VARCHAR(255) NOT NULL,                  -- Full name of the user, cannot be null
  `username` VARCHAR(255) NOT NULL,                  -- Username, cannot be null
  `password` VARCHAR(255) NOT NULL,                  -- Password, cannot be null
  `status` VARCHAR(255) NOT NULL DEFAULT 'Active',   -- Status, defaults to 'Active'
  PRIMARY KEY (`user_id`)                            -- Primary key on user_id
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

