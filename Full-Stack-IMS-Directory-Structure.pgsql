Full-Stack-Medical-Inventory-Management-System-Directory-Structure/
├── backend/ (MVC Restful API router with PHP)
│   ├── app/                              
│   │   ├── api/                                # Defines RESTful endpoints using FastAPI
│   │   │   ├── v1/
│   │   │   │   ├── endpoints/
│   │   │   │	│	├── auth.py
│   │   │   │	│	├── inventory.py
│   │   │   │	│	├── suppliers.py
│   │   │   │	│	├── stocks.py
│   │   │   │   │   └── reports.py
│   │   │   │   ├── router.py
│   │   │   │   └── v1.py                       # Aggregates v1 endpoints                   
│   │   ├── core/                               # App configurations, environment and JWT security
│   │   │   ├── config.py                       # Application settings      
│   │   │   ├── security.py                     # JWT, password hoshing, password hashing
│   │   │   └── logging.py                      # Logging configuration
│   │   ├── models/                             # SQLAlchemy ORM models 
│   │   │   ├── user.py
│   │   │   ├── inventory.py
│   │   │   ├── stock.py
│   │   │   └── supplier.py
│   │   ├── schemas/                            # Pydantic schemas 
│   │   │   ├── token.py                        # Authentication
│   │   │   ├── user.py					        # User Account 
│   │   │   ├── inventory.py                    # Medical items    
│   │   │   ├── stock.py                        # Batch & Quantity Tracking 
│   │   │   └── supplier.py                     # Vendor Info
│   │   ├── services/                           # Business logic
│   │   │   ├── auth_service.py
│   │   │   ├── report_service.py
│   │   │   └── alert_service.py    
│   │   ├── db/                                 # Daabase connection and model registration
│   │   │   ├── base.py
│   │   │   ├── base_class.py
│   │   │   └── session.py                      # SQLALchemy  session factory    
│   │   ├── crud/                               # CRUD operations
│   │   │   ├── __init__.py                     # Import 'inventory', 'stock', 'supplier'
│   │   │   ├── base.py                         # Reusable CRUD logic
│   │   │   ├── inventory.py
│   │   │   ├── stock.py
│   │   │   └── supplier.py                            
│   │   ├── utils/                              # FastAPI app entry point
│   │   │   ├── email.py
│   │   │   └── file.py         
│   │   ├── deps.py								# Dependency injection for FastAPI  
│   │   └── main.py                             # Dependency  overrides                        
│   ├── alembics/                               # DB migrations
│   │   ├── versions/  
│   │   └── env.py                   
│   ├── tests/   
│   │   ├── test_inventory.py
│   │   ├── test_auth.py
│   │   ├── test_suppliers.py
│   │   ├── test_stocks.py
│   │   ├── test_users.py
│   │   └── conftest.py                                 
│   │
├── frontend/( MVC REST API with JavaScript, HTML, CSS)
│   ├── assets/
│   │   ├── index.html
│   ├── css/                                     # All stylesheets                        
│   │   ├── layout.css                           
│   │   ├── components.css                       
│   │   └── style.css                            
│   ├── js/                                     
│   │   ├── model/                               # REST API integretion 
│   │   │   ├── inventoryModel.js                # Manages product and inventory     
│   │   │   ├── supplierModel.js                 # Manages supplier data     
│   │   │   ├── stockModel.js                    # Manages stock transaction (in/out)
│   │   │   ├── purchaseOrderModel.js            # Manages purchase orders   
│   │   │   └── authModel.js                     # Handles authentication
│   │   │
│   │   ├── controllers/                         
│   │   │   ├── dashboardController.js           # Fetch data from inventory, stock model , calculating, view for rendering  
│   │   │   ├── inventoryController.js           # render inventory and bind event    
│   │   │   ├── supplierController.js            #   
│   │   │   ├── stockController.js               # manage stock transaction , render stock view    
│   │   │   ├── purchaseController.js            # Handle purchase order(POs) from supplier , update inventory, track stock, update the purchase view                                     
│   │   │   └── authController.js                 
│   │   │
│   │   ├── views/                              # UI logic and scripts
│   │   │   ├── dashboardView.js                # Summary , Charts, alert  
│   │   │   ├── inventoryView.js                # Inventory table , forms
│   │   │   ├── supplierView.js                 # Supplier list & forms
│   │   │   ├── stockView.js                    # Stock transaction table & from       
│   │   │   ├── purchaseOrderView.js            # Optional : PO list, froms  / purchase order list and forms
│   │   │   └── authView.js                    # Login form & messages  
│   │   │
│   │   ├── utils/                              # Helper functions                               
│   │   │   └── api.js
│   │   │
│   │   └── app.js                    		    # App initializer and routing logic
│   │
│   ├── pages/                           		# All HTML pages
│   │   ├── login.html                  		# Login / Landing page
│   │   ├── dashboard.html
│   │   ├── inventory.html
│   │   ├── suppliers.html
│   │   ├── stock.html
│   │   └── purchase.html
│   │
│   ├── .env                                    # environment variables (for devs, optional)
│   ├── .README.md                              # Project instructions
│   └── package.json                            # If using build tools or npm package (optional)
├── .env                                        
├── requirements.txt                            
├── docker-compose.json                         
└── README.md                                  