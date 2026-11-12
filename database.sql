CREATE DATABASE IF NOT EXISTS shopease CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE shopease;

CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(120) NOT NULL,
 email VARCHAR(190) NOT NULL UNIQUE,
 password VARCHAR(255) NOT NULL,
 role ENUM('customer','admin') NOT NULL DEFAULT 'customer',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE products (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(180) NOT NULL,
 category VARCHAR(80) NOT NULL,
 description TEXT,
 price DECIMAL(10,2) NOT NULL,
 image TEXT NOT NULL,
 stock INT NOT NULL DEFAULT 0,
 active TINYINT(1) NOT NULL DEFAULT 1,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE orders (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 customer_name VARCHAR(120) NOT NULL,
 phone VARCHAR(20) NOT NULL,
 address TEXT NOT NULL,
 city VARCHAR(100) NOT NULL,
 pin_code VARCHAR(10) NOT NULL,
 total DECIMAL(10,2) NOT NULL,
 payment_method VARCHAR(40) NOT NULL,
 status VARCHAR(40) NOT NULL DEFAULT 'Placed',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(user_id) REFERENCES users(id)
);
CREATE TABLE order_items (
 id INT AUTO_INCREMENT PRIMARY KEY,
 order_id INT NOT NULL,
 product_id INT NULL,
 product_name VARCHAR(180) NOT NULL,
 price DECIMAL(10,2) NOT NULL,
 quantity INT NOT NULL,
 FOREIGN KEY(order_id) REFERENCES orders(id) ON DELETE CASCADE,
 FOREIGN KEY(product_id) REFERENCES products(id) ON DELETE SET NULL
);

INSERT INTO products(name,category,description,price,image,stock) VALUES
('Relaxed Fit Polo','Men','A refined everyday polo in soft cotton with a relaxed silhouette.',2499,'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=900',20),
('Linen Blend Shirt','Men','Lightweight linen blend shirt for effortless warm-weather dressing.',2999,'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=900',15),
('Premium Cotton Tee','Tops','An elevated essential tee with a clean, structured fit.',1499,'https://images.unsplash.com/photo-1529375423168-8a3b9b1f7a3c?w=900',30),
('Tailored Trousers','Women','Modern tailored trousers with a fluid drape and polished finish.',3499,'https://images.unsplash.com/photo-1509631179647-0177331693ae?w=900',12),
('Utility Overshirt','Men','A versatile layer made for relaxed, everyday styling.',3299,'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?w=900',10),
('Ribbed Knit Polo','Women','A soft ribbed knit top with a timeless, understated look.',2699,'https://images.unsplash.com/photo-1551163943-3f6a855d1153?w=900',18),
('Everyday Tote','Accessories','A minimal carry-all for your everyday essentials.',1899,'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=900',14),
('Classic Blazer','Women','A beautifully cut blazer that moves from work to weekend.',4999,'https://images.unsplash.com/photo-1591369822096-ffd140ec948f?w=900',8);
