-- Create customers table
CREATE TABLE customers (
    customer_id SERIAL PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create items/products table
CREATE TABLE items (
    item_id SERIAL PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    stock_quantity INTEGER DEFAULT 0
);

-- Create orders table
CREATE TABLE orders (
    order_id SERIAL PRIMARY KEY,
    customer_id INTEGER REFERENCES customers(customer_id) ON DELETE CASCADE,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_amount DECIMAL(10,2) DEFAULT 0,
    status VARCHAR(20) DEFAULT 'pending'
);

-- Create order_items table 
CREATE TABLE order_items (
    order_item_id SERIAL PRIMARY KEY,
    order_id INTEGER REFERENCES orders(order_id) ON DELETE CASCADE,
    item_id INTEGER REFERENCES items(item_id) ON DELETE CASCADE,
    quantity INTEGER NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) GENERATED ALWAYS AS (quantity * unit_price) STORED
);

-- Insert sample data into customers
INSERT INTO customers (first_name, last_name, email, phone) VALUES
('Sean', 'Pangilinan', 'sean@email.com', '09608319429'),
('Winter', 'Wysteria', 'winter@email.com', '09124595445'),
('Crow', 'Talo', 'crow@email.com', '09399378951'),
('Shin', 'Mori', 'shin@email.com', '09054821280');

-- Insert sample data into items
INSERT INTO items (product_name, price, stock_quantity) VALUES
('Railblade', 1000, 10),
('Soulthorn', 2000, 20),
('Trinity_force', 3000, 30),
('Black_cleaver', 4000, 40),
('Guardian_angel', 5000, 50),
('Thornnail', 6000, 60),
('Sunfire_aegis', 7000, 70),
('Warmogs', 8000, 80),
('Licht_bane', 9000, 90),
('Rabadons', 10000, 100),
('Nashor_tooth', 42000, 65),
('Ludens_echo', 7572, 85),
('Kyrswinter', 7452, 25);

-- Insert sample data into orders
INSERT INTO orders (customer_id, total_amount, status) VALUES
(1, 3000, 'completed'),
(2, 5000, 'pending'),
(3, 2000, 'completed'),
(4, 10000, 'processing');

-- Insert sample data into order_items
INSERT INTO order_items (order_id, item_id, quantity, unit_price) VALUES
(1, 1, 3, 1000),
(2, 2, 2, 2000),
(2, 3, 1, 3000),
(3, 5, 1, 5000),
(4, 10, 1, 10000);