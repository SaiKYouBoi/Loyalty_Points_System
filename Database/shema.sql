
    CREATE TABLE users (

    id INT PRIMARY KEY AUTO_INCREMENT,

    email VARCHAR(100) UNIQUE NOT NULL,

    password_hash VARCHAR(255) NOT NULL,

    name VARCHAR(100),

    total_points INT DEFAULT 0,

    createdat TIMESTAMP DEFAULT CURRENTTIMESTAMP

    );


    CREATE TABLE points_transactions (

    id INT PRIMARY KEY AUTO_INCREMENT,

    user_id INT NOT NULL,

    type ENUM('earned', 'redeemed', 'expired') NOT NULL,

    amount INT NOT NULL,

    description VARCHAR(255),

    balance_after INT NOT NULL,

    createdat TIMESTAMP DEFAULT CURRENTTIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE

    );


    CREATE TABLE rewards (

    id INT PRIMARY KEY AUTO_INCREMENT,

    name VARCHAR(100) NOT NULL,

    points_required INT NOT NULL,

    description TEXT,

    stock INT DEFAULT -1 

    );

    CREATE TABLE products (

    id INT PRIMARY KEY AUTO_INCREMENT,

    name VARCHAR(100) NOT NULL,

    price DECIMAL(10,2) NOT NULL,

    description TEXT,

    image_url VARCHAR(255)
    );

    CREATE TABLE orders (

    id INT PRIMARY KEY AUTO_INCREMENT,

    user_id INT NOT NULL,

    total_amount INT NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    );


    INSERT INTO products (name, price, description, image_url) VALUES
    ('Wireless Pro Headphones', 149.99, 'High quality wireless over-ear headphones in matte black.', ''),
    ('Smart Watch Series 7', 329.00, 'Modern smartwatch with stainless steel band and digital face.', ''),
    ('Eco-Steel Bottle', 35.00, 'Eco-friendly insulated water bottle in forest green.', ''),
    ('Leather Travel Bag', 120.00, 'Classic leather weekender bag in tan brown.', ''),
    ('Organic Cotton Tee', 28.00, 'Organic cotton t-shirt in minimalist white.', ''),
    ('Minimalist Desk Lamp', 55.00, 'Minimalist wooden desk lamp with warm light.', ''),
    ('Noise Cancelling Earbuds', 129.99, 'Sleek black noise cancelling earbuds in charging case.', ''),
    ('Portable Power Bank', 45.00, 'Compact portable power bank with multiple ports.', '');