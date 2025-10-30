Full-Stack-IMS-Directory-Structure/(RESTful inventory management system)
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
│   │   ├── inventory/
│   │   │   ├── products.html
│   │   │   ├── categories.html
│   │   │   ├── purchases.html
│   │   │   ├── vendors.html
│   │   │   └── stock.html
│   │   ├── orders/
│   │   │   ├── orders.html
│   │   │   ├── invoice.html
│   │   │   └── items.html
│   │   ├── customers/
│   │   │   └── customers.html
│   │   ├── users/
│   │   │   ├── users.html
│   │   │   ├── profile.html
│   │   │   └── roles.html
│   │   └── reports.html
│   │
│   ├── components/                     	# Reusable HTML UI snippets components
│   │   ├── header.html
│   │   ├── sidebar.html
│   │   ├── footer.html
│   │   ├── model.html
│   │   └── notification.html
│   │
│   ├── assets/
│   │   ├── css/
│   │   │   ├── main.css
│   │   │   ├── layout.css
│   │   │   ├── reset.css
│   │   │   ├── theme.css
│   │   │   └── modules/
│   │   │       ├── navbars.css
│   │   │       ├── table.css
│   │   │       ├── form.css
│   │   │       └── modal.css
│   │   ├── js/
│   │   │   ├── app.js                       # Entry point
│   │   │   ├── router.js
│   │   │   ├── api.js                       # AJAX request to backend
│   │   │   ├── auth.js                      # Login/session Logic
│   │   │   ├── state.js
│   │   │   ├── utils/                       # Helper function
│   │   │   │   ├── modal.js
│   │   │   │   ├── dropdown.js
│   │   │   │   ├── sidebar.js
│   │   │   │   └── formatter.js
│   │   │   └── modules/
│   │   │       ├── dashboard.js
│   │   │       ├── inventory/
│   │   │       │   ├── products.js
│   │   │       │   ├── catetories.js
│   │   │       │   ├── purchases.js
│   │   │       │   ├── vendors.js
│   │   │       │   └── stock.js
│   │   │       ├── orders/
│   │   │       │   ├── orders.js
│   │   │       │   ├── invoices.js
│   │   │       │   └── items.js
│   │   │       ├── customer/
│   │   │       │   └── customers.js
│   │   │       ├── users/
│   │   │       │   ├── users.js
│   │   │       │   ├── profile.js
│   │   │       │   └── roles.js
│   │   │       └── reports.js
│   │   └── images/
│   │       ├── logo.png
│   │       └── icons/
│   │           ├── product.svg
│   │           ├── customer.svg
│   │           └── user.svg
│   │
├── data/
│   ├── customers.json
│   ├── products.json
│   └── orders.json
│
├── uploads/
├── dist/
│   └── (optional for build tools)
│
├── .env
├── package.json
├── composer.json
└── README.md
