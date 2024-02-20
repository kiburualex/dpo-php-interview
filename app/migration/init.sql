USE master;

IF NOT EXISTS (SELECT name FROM sys.databases WHERE name = 'dpo_db')
BEGIN
    CREATE DATABASE dpo_db;
END

USE dpo_db;

-- Create users table
CREATE TABLE users (
    user_id INT PRIMARY KEY,
    username VARCHAR(255),
    email VARCHAR(255)
);

-- Create orders table
CREATE TABLE orders (
    order_id INT PRIMARY KEY,
    user_id INT,
    amount DECIMAL(10, 2),
    order_date DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- insert users
INSERT INTO users (user_id, username, email)
VALUES 
(1, 'John Doe', 'johndoe@example.com'),
(2, 'Jane Doe', 'janedoe@example.com'),
(3, 'James Doe', 'jamesdoe@example.com');

-- insert orders
INSERT INTO users (order_id, user_id, amount, order_date)
VALUES 
(1, 2, 400.0, sysdate),
(2, 2, 230.0, sysdate),
(3, 1, 100.0, sysdate);