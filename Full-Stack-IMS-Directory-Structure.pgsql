Full-Stack-IMS-Directory-Structure/
├── backend/
│   ├── app/
│   │   ├── core/
│   │   │   ├── App.php                   
│   │   │   ├── Router.php
│   │   │   ├── Controller.php
│   │   │   ├── Model.php
│   │   │   ├── View.php
│   │   │   ├── Request.php
│   │   │   ├── Response.php
│   │   │   ├── Validator.php
│   │   │   ├── Auth.php   
│   │   │   └── Database.php
│   │   ├── Http/
│   │   │   ├── Controllers/
│   │   │   │   ├── Auth/
│   │   │   │   │   ├── LoginController.php
│   │   │   │   │   ├── RegisterController.php
│   │   │   │   │	└── ForgotPasswordController.php
│   │   │   │   ├── Admin/
│   │   │   │   │   ├── DashboardController.php
│   │   │   │   │   ├── UserController.php
│   │   │   │   │   ├── RoleController.php
│   │   │   │   │	└── SettingController.php
│   │   │   │   ├── Inventory/
│   │   │   │   │   ├── ProductController.php
│   │   │   │   │   ├── CategoryController.php
│   │   │   │   │   ├── SupplierController.php
│   │   │   │   │   ├── PurchaseController.php
│   │   │   │   │   ├── OrderController.php
│   │   │   │   │   ├── InvoiceController.php
│   │   │   │   │	└── StockController.php
│   │   │   │   ├── Customer/
│   │   │   │   │	└── CustomerController.php
│   │   │   │   └── API/
│   │   │   │       ├── v1/
│   │   │   │       │	└── ProductApiController.php
│   │   │   │   	└── v2/
│   │   │   │       	└── ProductApiController.php
│   │   │   ├── Middleware/
│   │   │   │   ├── AuthMiddleware.php
│   │   │   │   ├── AdminMiddleware.php
│   │   │   │   └── ApiTokenMiddleware.php
│   │   │   └── Requests/
│   │   │       ├── Auth/
│   │   │       │   ├── LoginRequest.php
│   │   │      	│	└── RegisterRequest.php
│   │   │       ├── Inventory/
│   │   │       │   ├── ProductRequest.php
│   │   │       │   ├── PurchaseRequest.php
│   │   │       │	└── OrderRequest.php
│   │   │       └── Customer/
│   │   │      		└── CustomerRequest.php
│   │   ├── models/
│   │   │   ├── Inventory/
│   │   │   │   ├── Product.php
│   │   │   │   ├── Category.php
│   │   │   │   ├── Supplier.php
│   │   │   │   ├── Stock.php
│   │   │   │   ├── Purchase.php
│   │   │   │   ├── Order.php
│   │   │   │   ├── Invoice.php
│   │   │   │   └── Item.php                              # OrderItem or InvoiceItem
│   │   │   ├── Customer/
│   │   │   │   └── Customer.php
│   │   │   ├── User/
│   │   │   │   ├── User.php
│   │   │   │   ├── Role.php
│   │   │   │   └── Permission.php      
│   │   │   └── BaseModel.php
│   │   ├── views/
│   │   │   ├── layouts/
│   │   │   │   ├── master.php
│   │   │   │   ├── header.php
│   │   │   │   └── footer.php                              # OrderItem or InvoiceItem
│   │   │   ├── auth/
│   │   │   │   ├── login.php
│   │   │   │   ├── register.php
│   │   │   │   └── forgot_password.php
│   │   │   ├── dashboard/
│   │   │   │   └── index.php
│   │   │   ├── Inventory/
│   │   │   │   ├── products/
│   │   │   │   │   ├── index.php
│   │   │   │   │   ├── create.php
│   │   │   │   │   ├── edit.php
│   │   │   │   │   └── show.php  
│   │   │   │   ├── categories/
│   │   │   │   │   ├── index.php
│   │   │   │   │   └── form.php 
│   │   │   │   ├── suppliers/
│   │   │   │   │   ├── index.php
│   │   │   │   │   └── form.php 
│   │   │   │   └── stock/ 
│   │   │   │       └── movements.php 
│   │   │   ├── orders/
│   │   │   │   ├── index.php
│   │   │   │   ├── create.php
│   │   │   │   └── invoice.php
│   │   │   ├── customers/
│   │   │   │   └── index.php
│   │   │   ├── users/
│   │   │   │   ├── index.php
│   │   │   │   ├── create.php
│   │   │   │   └── profile.php     
│   │   │   └── errors/
│   │   │       ├── 404.php
│   │   │       └── 500.php
│   ├── public/
│   │   ├── index.php
│   │   ├── css/
│   │   ├── js/
│   │   └── uploads/
│   ├── config/
│   │   ├── database.php
│   │   ├── constants.php
│   │   ├── config.php
│   │   └── web.php
│   ├── routes/
│   │   └── web.php
│   │   
├── frontend/
│   ├── index.html
│   ├── login.html
│   ├── register.html
│   ├── pages/
│   │   ├── dashboard.html
│   │   ├── customers.html
│   │   ├── orders.html
│   │   ├── items.html
│   │   ├── products.html
│   │   ├── categories.html
│   │   ├── purchases.html
│   │   ├── vendors.html
│   │   └── reports.html
│   │
│   ├── components/                     # Reusable frontend components
│   │   ├── header.html
│   │   ├── sidebar.html
│   │   ├── footer.html
│   │   └── modal.html
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
│   │   ├── js/
│   │   │   ├── app.js                       # Entry point
│   │   │   ├── api.js                       # AJAX request to backend
│   │   │   ├── auth.js                      # Login/session Logic
│   │   │   ├── utils/                       # Helper function
│   │   │   │   ├── modal.js
│   │   │   │   ├── dropdown.js
│   │   │   │   └── sidebar.js
│   │   │   └── modules/
│   │   │       ├── customers.js
│   │   │       ├── orders.js
│   │   │       ├── items.js
│   │   │       ├── products.js
│   │   │       ├── categories.js
│   │   │       ├── purchases.js
│   │   │       ├── vendors.js
│   │   │       └── users.js
│   │   └── images/
│   │       ├── logo.png
│   │       └── icons/
│
├── data/
│   ├── customers.json
│   └── products.json
│
├── uploads/
├── package.json
│

│
├── .env
├── composer.json
└── README.md
