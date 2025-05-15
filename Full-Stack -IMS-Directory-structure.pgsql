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
│   │   │       ├── dropdown.css  
│   │   │       └── silebar.css            
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
│		├── header.html                         
│		├── sidebar.html                       
│		└── footer.html
│                         
├── backend/ 
│   ├── public/
│   │	├── index.php  
│	│	└── .htaccess 
│   ├── api/                                          # API endpoint for AJAX/front-end calls
│	│   ├── auth/
│	│   │	├── login.php  
│	│   │	├── register.php  
│	│	│	└── resetPassword.php
│	│   │
│	│   ├── products/                      			  # Product management page
│	│   │	├── list.php                         	
│	│   │	├── add.php                          	
│	│	│	├── update.php                         
│	│	│	└── delete.php
│	│   │
│	│  	├── stock/                          
│	│   │	├── stock_in.php   
│	│	│	└── stock_out.php    
│	│   │              
│	│	├── orders/
│	│	│	├── create.php
│	│	│	└── list.php
│	│   │
│	│	├── customers.php
│	│   │	├── list.php                         	
│	│   │	├── add.php                          	
│	│	│	├── update.php                         
│	│	│	└── delete.php
│	│	│
│	│	└── reports/
│	│       ├── list.php  
│	│		└── export_csv.php
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