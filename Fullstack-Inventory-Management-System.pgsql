IMS-Full-Stack-Structure/
│
├── Frontend/                      	 	
│   ├── index.html                          	
│	├── login.html
│	├── register.html                           
│	├── products.html                            
│	├── order.html                               
│	├── stock.html                              
│	├── customers.html                           
│	├── suppliers.html
│   │
│   ├── assets/                                 # Static assets
│   │   ├── css/
│   │   │   ├── main.css
│   │   │   ├── layout.css
│   │   │   ├── forms.css
│   │   │   └── components
│   │   │
│   │   ├── js/
│   │   │   ├── main.js    
│   │   │   ├── auth.js 
│   │   │   ├── product.js 
│   │   │   ├── orders.js                      
│   │	│   ├── stock.js                     
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
│   ├── api/                               
│	│   ├── auth/
│	│   │	├── login.php  
│	│	│	└── logout.php
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
│	├── core/                                
│	│   ├── Controller.php
│	│   ├── Model.php
│	│	└── Router.php 
│	│
│	└── helpers/                                
│		├── Database.php                        
│		├── Auth.php                            
│		├── Validator.php                        
│		├── Response.php                      
│		└── FileUpload.php                          
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