Full-Stack-IMS-Directory-Structure/
│
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
├── backend/
│   ├── config/
│   │   ├── database.php
│   │   ├── constants.php
│   │   └── config.php
│   ├── public/
│   │   ├── index.php
│   │   ├── css/
│   │   ├── js/
│   │   └── uploads/
│   │
│   ├── app/
│   │   ├── controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── CustomerController.php
│   │   │   ├── OrderController.php
│   │   │   ├── ItemController.php
│   │   │   ├── ProductsController.php
│   │   │   ├── CategoryController.php
│   │   │   ├── PurchaseController.php
│   │   │   └── VendorController.php
│   │   │
│   │   ├── models/
│   │   │   ├── User.php
│   │   │   ├── Customers.php
│   │   │   ├── Order.php
│   │   │   ├── Item.php
│   │   │   ├── Product.php
│   │   │   ├── Category.php
│   │   │   ├── Purchase.php
│   │   │   └── Vendor.php
│   │   │
│   │   ├── services/
│   │   │   ├── InventoryService.php
│   │   │   ├── ReportService.php
│   │   │   └── AuthService.php               
│   │   │
│   │   ├── routes/
│   │   │   ├── api.php
│   │   │   └── web.php
│   │   ├── helpers/
│   │   │   ├── auth_helpers.php
│   │   │   ├── response_helper.php
│   │   │   └── input_helper.php
│   │   │ 
│   ├── middleware/                      # Reguest filtering (auth, permission)
│   │   └── AuthMiddleware.php
│   │ 
│   ├── migrations/                      # SQL schema / versions DB script 
│   │   ├── create_users_table.sql
│   │   ├── create_customers_table.sql
│   │   ├── create_orders_table.sql
│   │   ├── create_items_table.sql
│   │   ├── create_products_table.sql
│   │   ├── create_categories_table.sql
│   │   ├── create_purchases_table.sql
│   │   └── create_vendors_table.sql
│   │ 
│   ├── logs/                            # error or debug logs
│   │   └── app.log
│   │ 
│   ├── storage/                         # file uploads or generate content
│   │   └── invoices/
│   │ 
│   ├── tests/
│   │   └── ProductTest.php
│   │ 
├── storage/
│   ├── uploads/
│   ├── logs/
│   │   └── app.log
│   ├── tests/
│   │   ├── Feature/
│   │   └── Unit/
│   └── migrations/
│       ├── create_tables.sql
│       └── seed_data.sql
│
├── vendor/
│   └── (Composer dependencies)
│
├── .env
├── composer.json
└── README.md
