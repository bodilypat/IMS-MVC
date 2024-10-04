CREATE DATABASE INVENTORY;

USE INVENTORY;

CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','staff') NOT NULL,
    updationDate VARCHAR(255) NOT NULL,
    created_at TIMESTAMP CURRENT_TIMESTAMP
);

CREATE TABLE suppliers(
    supplier_id INT PRIMARY KEY,
    name VARCHAR(255),
    contactInfo VARCHAR(255),
    address VARCHAR(255),
);

CREATE TABLE categories(
    category_id PRIMARY KEY,
    name VARCHAR(255),
    description TEXT
);

CREATE TABLE products(
    product_id INT PRIMARY KEY,
    description TEXT,
    category_id INT,
    price DECIMAL(10,2),
    supplier_id INT,
    quantityInStock INT,
    recordLevel INT,
    FOREIGN KEY (category_id) REFERENCES categories(category_id),
    FOREIGN KEY (supplier_id) REFERENCES suppliers(supplier_id),
);

CREATE TABLE transections(
    transection_id INT PRIMARY KEY,
    product_id INT,
    quantity INT,
    transectionType ENUM('IN','OUT'),
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT,
    FOREIGN KEY (product_id) REFERENCES  products(product_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
