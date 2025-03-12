CREATE TABLE Products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,                   /* Unique identifier for each product */
    product_name VARCHAR(255) NOT NULL,                          /* Name of the Product */
    description TEXT,                                            /* Description of product */
    category_id INT,                                             /* Foreign key linking to the Caregories table */
    supplier_id INT,                                             /* Foreing key Linking to the Supplier table */
    price DECIMAL(10,2) NOT NULL,                                /* Price of the product */
    quantity_in_stock INT DEFAULT 0,                             /* Number of Item in stock, defaults to 0 */
    reorder_level INT DEFAULT 10,                                /* minimum stock level to trigger a reorder */
    last_restock_date DATE,                                      /* Date the product was last restocked table */
    FOREIGN KEY (category_id) REFERENCE Categories(category_id), /* link to Categories table */
    FOREIGN KEY (supplier_id) REFERENCE Suppliers(supplier_id)   /* link to Suppliers table */
);

CREATE TABLE Categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name INT VARCHAR(255) NOT NULL,
);

CREATE TABLE Suppliers(
    supplier_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    contact_info VARCHAR(255)      /* Optional, for storing supplier contect details */
);

CREATE TABLE Orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,                        /* Unique identifier for each order */
    order_date DATE NOT NULL,                                       /* Date the order was placed */
    customer_id INT,                                                /* Foreign key linking to the customers */
    totol_amount DECIMAL(10, 2) NOT NULL,                           /* Total amount of the order */
    order_status VARCHAR(50) DEFAULT 'Pending',                     /* Totol amount of the order */
    payment_status VARCHAR(50) DEFAULT 'Unpaid',                    /* Payment status (e.g., Unpaid, Paid) */
    shipping_address VARCHAR(255),                                  /* Shipping address for the order */
    FOREIGN KEY (customer_id) REFERENCE Customers(customer_id)      /* Link to the Customers table */
);
CREATE TABLE customer (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,                     /* Unique identifier for each customer */
    name VARCHAR(255) NOT NULL,                                     /* Customer's full name */
    email VARCHAR(255),                                             /* Customer's email address */
    phone VARCHAR(20),                                              /* Customer's phone number */
    address VARCHAR(255)                                            /* Customer's address */
);
CREATE TABLE Purchase (
    purchase_id INT AUTO_INCREMENT PRIMARY KEY,                     /* Unique identifier for each order item product */
    order_id INT,                                                   /* Foreign key Linking to the orders table */
    product_id INT,                                                 /* Foreign key Linking to the products table */
    quantity INT NOT NULL,                                          /* Quantity of the Product in the order */
    prince DECIMAL(10, 2) NOT NULL,                                 /* Price of the product at the time of the */ 
    subtotal DECIMAL(10,2) NOT NULL,                                /* Subtotal for this item (quantity * price)  */
    FOREIGN KEY (order_id) REFERENCES Orders(order_id),             /* Link to Orders table */
    FOREIGN KEY (product_id) REFERENCES Products(product_id),       /* Link to Products table */
);
