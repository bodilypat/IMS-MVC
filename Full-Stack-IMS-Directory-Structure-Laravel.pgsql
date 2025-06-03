Full-Stack-IMS-Directory-Structure-laravel/
│
├── app/                                  # Core Laravel application logic
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php
│   │   │   │   ├── RegisterController.php
│   │   │   │   └── ForgotPasswordController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── ProductController.php
│   │   │   ├── CategoryController.php
│   │   │   ├── SupplierController.php
│   │   │   ├── PurchaseController.php
│   │   │   ├── OrderController.php
│   │   │   ├── InvoiceController.php
│   │   │   ├── CustomerController.php
│   │   │   └── UserController.php
│   │   ├── Middleware/
│   │   └── Requests/                     # Form request validation
│   ├── Models/
│   │   ├── Product.php
│   │   ├── Category.php
│   │   ├── Supplier.php
│   │   ├── Purchase.php
│   │   ├── Order.php
│   │   ├── Invoice.php
│   │   ├── Customer.php
│   │   ├── User.php
│   │   └── Item.php
│   └── Providers/
│
├── routes/
│   ├── web.php                            # Blade routes
│   └── api.php                            # API (AJAX or SPA)
│
├── database/
│   ├── migrations/
│   ├── seeders/
│   ├── factories/
│   └── schema.sql                         # Optional raw SQL
│
├── resources/
│   ├── views/
│   │   ├── layouts/                       # Blade layouts (header, sidebar, footer)
│   │   ├── auth/
│   │   ├── dashboard/
│   │   ├── products/
│   │   ├── categories/
│   │   ├── suppliers/
│   │   ├── purchases/
│   │   ├── orders/
│   │   ├── invoices/
│   │   ├── customers/
│   │   ├── users/
│   │   └── components/                   # Modals, partials, etc.
│   ├── css/                              # Tailwind or custom styles
│   │   └── app.css
│   ├── js/                               # Vue/React or plain JS
│   │   └── app.js
│   └── assets/
│       └── images/
│
├── public/
│   ├── assets/
│   │   ├── css/
│   │   ├── js/
│   │   └── images/
│   ├── uploads/                          # Publicly accessible files
│   └── index.php                         # Laravel entry point
│
├── storage/
│   ├── app/
│   │   └── uploads/                      # Secure file uploads
│   ├── logs/
│   └── framework/
│
├── tests/
│   ├── Feature/
│   └── Unit/
│
├── config/
│   ├── app.php
│   ├── database.php
│   └── ims.php                           # Custom IMS config (optional)
│
├── bootstrap/
│   └── app.php
│
├── .env
├── .gitignore
├── artisan                               # Laravel CLI tool
├── composer.json                         # PHP dependencies
├── package.json                          # JS frontend (Vite/webpack) dependencies
├── vite.config.js                        # Vite asset bundling
└── README.md
