Full-Stack-IMS-Structure/
│
├── Frontend/                      	 	
│   ├── index.html   
│   ├── login.html
│   ├── register.html
│   ├── pages/                     	
│   │   ├── dashboard.html
│   │   ├── customers.html
│   │   ├── orders.html 
│   │   ├── invoices.html                           
│   │   ├── products.html 
│   │   ├── items.html
│   │   ├── purchases.html 
│   │   ├── vendors.html 
│   │   ├── suppliers.html 
│   │   ├── categories.html
│   │   └── users.html                       
│   │
│   ├── assets/                                 
│   │   ├── css/
│   │   │   ├── main.css
│   │   │   ├── layout.css
│   │   │   ├── reset.css
│   │   │   └── modules/
│   │   │       ├── navbars.css
│   │   │       ├── table.css
│   │   │       └── form.css 
│   │   │
│   │   ├── js/
│   │   │   ├── auth.js    
│   │   │   ├── main.js 
│   │   │   ├── api.js 
│   │   │   ├── ui/ 
│   │   │   │   ├── model.css
│   │   │   │   ├── dropdown.css  
│   │   │   │   └── silebar.css            
│   │   │   └── modules/ 
│   │   │       ├── customers.js
│   │   │       ├── orders.js
│   │   │       ├── invoices.js
│   │   │       ├── products.js
│   │   │       ├── items.js
│   │   │       ├── purchases.js
│   │   │       ├── vendors.js
│   │   │       ├── suppliers.js
│   │   │       ├── categories.js
│   │   │       └── users.js          
│   │   │
│   │   └── images/  
│   │       ├── logo.png                          
│   │       └── icon/
│   │
│   └── components/                       
│	    ├── header.html                         
│	    ├── footer.html 
│	    ├── sidebar.html                        
│	    └── navbar.html
│  
├── data/ 
│   ├── customers.json  
│   └── products.json  
│
├── uploads/
├── package.json
│                 
├── backend/ 
│   ├── public/
│   │	├── index.php  
│   │   └── .htaccess 
│   ├── app/                                          # API endpoint for AJAX/front-end calls
│   │   ├── controllers/
│   │   │   ├── CustomerController.php  
│   │   │   ├── OrderController.php  
│   │   │   ├── InviceController.php  
│   │   │   ├── ProductController.php  
│   │   │   ├── ItemsController.php  
│   │   │   ├── PurchaseController.php  
│   │   │   ├── VendorsController.php  
│   │   │   ├── SupplierController.php  
│   │   │   ├── CategoryController.php  
│   │   │   └── UserController.php
│   │   │
│   │   ├── models/                      			  # Product management page
│   │   │   ├── Customer.php          
│   │   │   ├── Order.php       
│   │   │   ├── Invoice.php       
│   │   │   ├── Product.php       
│   │   │   ├── Item.php       
│   │   │   ├── Purchase.php       
│   │   │   ├── Vendor.php       
│   │   │   ├── Supplier.php  
│   │   │   ├── Category.php                          	                     
│   │   │   └── User.php
│   │   │
│   │   ├── stock/                          
│   │   │	├── stock_in.php   
│   │   │   └── stock_out.php    
│   │   │              
│   │   ├── orders/
│   │   │   ├── create.php
│   │   │   └── list.php
│   │   │
│   │   ├── customers.php
│   │   │   ├── list.php                         	
│   │   │   ├── add.php                          	
│   │   │   ├── update.php                         
│   │   │   └── delete.php
│   │   │
│   │   └── reports/
│   │       ├── list.php  
│   │	    └── export_csv.php
│   │
├── app/                                        # Core application logic
│	├── controllers/ 
│   │   ├── AuthController.php
│   │   ├── ProductController.php
│   │   ├── StockController.php
│	│	├── CustomerControlle.php
│	│	├── OrderController.php
│	│	└── ReportController.php 
│	│	
│	├── models/                                
│	│   ├── User.php
│	│   ├── Product.php
│	│   ├── Stock.php
│	│   ├── Customer.php
│   │   ├── Order.php
│	│	└── Report.php 
│	└── helpers/                               
│	    ├── Auth.php
│	    ├── Validator.php
│	    ├── Response.php
│	 	└── Logger.php                         
│	
├── config/
│	├── config.php                              
│	└── database.php                            
│                           
├── uploads/
├── logs/
├── vendor/
├── composer.json
├── .env
│	
└── README.md  