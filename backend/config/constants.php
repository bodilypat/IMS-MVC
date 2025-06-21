<?php
	
	/* Application Level constants */
	define('APP_NAME', 'Inventory Management System');
	define('APP_VERSION', '1.0.0');
	
	/* Path Constants (adjust as needed */
	define('BASE_URL', 'httP://localhost/ims');
	define('PUBLIC_PATH', __DIR__ . '../public/');
	define('UPLOADS_PATH', PUBLIC_PATH . 'uploads/');
	define('INVOICE_STORAGE_PATH', __DIR__ '/../storage/invoices/');
	
	/* Default file/image values */
	define('DEFAULT_IMAGE', 'imageNotAvailable.jpg');
	
	/* User Roles */
	define('ROLE_ADMIN', 'Admin');
	define('ROLE_MANAGER', 'Manager');
	define('ROLE_EMPLOYER', 'Employer');
	
	/* User Status */
	define('STATUS_ACTIVE', 'Active');
	define('STATUS_INACTIVE', 'Inactive');
	define('STATUS_SUSPENDED', 'Suspended');
	
	/* Order Status */
	define('ORDER_PENDING', 'Pending');
	define('ORDER_COMPLETED', 'Completed');
	define('ORDER_CANCELLED', 'Cancelled');
	
	/* Product Status */
	define('PRODUCT_AVAILABLE', 'Available');
	define('PRODUCT_OUT_OF_STOCK', 'Out of Stock');
	define ('PRODUCT_DISCONTINUED', 'Discountinued');
	
	/* Vendor Status */
	define('VENDOR_ACTIVE', 'Active');
	define('VENDOR_INACTIVE', 'Inactive');
	
	/* Log file */
	define('LOG_FILE', __DIR__ .'/../logs/app.log');
	
	/* timezone */
	date_default_timezone_set('UTC');
	
	
	