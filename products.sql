-- Laboratory Exercise No. 5 - products table
-- Run this against your Aiven MySQL database (e.g. via the Aiven console's
-- SQL editor, or `mysql --host ... --port ... -u avnadmin -p defaultdb < products.sql`)

CREATE TABLE IF NOT EXISTS products (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    description TEXT NULL,
    price DECIMAL(10,2) NOT NULL DEFAULT 0,
    quantity INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Optional sample records for testing the Read operation
INSERT INTO products (product_name, description, price, quantity)
VALUES
('Wireless Mouse', 'Ergonomic 2.4GHz wireless mouse', 499.00, 25),
('Mechanical Keyboard', 'RGB backlit mechanical keyboard', 1899.00, 10),
('USB-C Hub', '7-in-1 USB-C hub with HDMI', 999.00, 15);
