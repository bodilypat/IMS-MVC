Full-Stack-IMS-Structure/
│
├── Frontend/                      	 	
│   ├── index.html                        	
│	├── login.html
│	├── logout.html                         
│	├── dashboard.html                           
│	├── products.html                              
│	├── stock.html                              
│   ├── orders.html      
│   ├── customers.html 
│   ├── suppliers.html                            
│   │
│   ├── assets/                                 
│   │   ├── css/
│   │   │   ├── main.css
│   │   │   ├── layout.css
│   │   │   ├── forms.css
│   │   │   └── auth.css
│   │   │
│   │   ├── js/
│   │   │   ├── auth.js    
│   │   │   ├── main.js 
│   │   │   ├── product.js 
│   │   │   ├── orders.js                      
│   │	│   ├── stock.js        
│   │	│   ├── orders.js               
│   │	│   ├── customer.js
│   │	│   ├── suppliers.js
│   │   │   └── utils.js                    
│   │   │
│   │   └── images/  
│   │       ├── logo.png                          
│   │       └── icon/
│   │
│	└── components/                             # Reuseable UI blocks (optional)
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