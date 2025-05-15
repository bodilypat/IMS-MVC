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
│   │   ├── views/                          
│   │   │   ├── layout/  
│   │   │   └── customer/   
│   │   │              
│   │   ├── routes/
│   │   │   ├── api.php
│   │   │   └── ...
│   │   │
│   │   ├── middleware/                                  # Middleware (auth, validation, CORS)
│   │   │   ├── AuthMiddleware.php                         	                     
│   │   │   └── CorsMiddleware.php
│   │   │
│   │   ├── core/
│   │   │   ├── APP.php                         	
│   │   │   ├── Router.php                          	
│   │   │   ├── Controller.php     
│   │   │   ├── Model.php
│   │   │   ├── Request.php                          
│   │   │   └── Response.php
│   │   │
│   │   ├── config/
│   │   │   ├── database.php                         	
│   │   │   ├── config.php                          	                    
│   │   │   └── env.php
│   │   │
│   │   └── helpers/
│   │       ├── functions.php  
│   │       ├── auth.php
│   │	    └── validation.php
│   │
├── storage/                                        
│   ├── uploads/ 
│   ├── logs/ 
│   │   └── app.log 
│   │	
│   ├── tests/                                
│   │   ├── Feature/
│   │   └── Unit/
│   └── migrates/                               
│	    ├── create_table.sql
│	    └── seed_data.sql                   
│	
├── vendor/
│   ├── config.php                              
│   └── database.php                            
│                           
├── .env
├── vendor/
├── composer.json
│	
└── README.md  