
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
('Wireless Pro Headphones', 149.99, 'High quality wireless over-ear headphones in matte black.', 'https://lh3.googleusercontent.com/aida-public/AB6AXuBtQPL-4LcWSsz2DMxIHf2j7DKvNc2NvO3amYyPg9IopAyPNGpuzr4F4adgGTvcyZGQtW63ZXUeRtrORWwoLMsfW75TJDRa6Q5IIpZ9y-3YDt7uKGpVPG8qkOvsBOqlLGpW0hc0j3-5limUGyKgBt8G67oz20ahLltDF8zs9mdUr0PRBWVhFy58gM2lEQycA2t3gMF4yLxKNwtnFWZVwW1bAIQGNmToKrAMKf64dqT5g3fQ-YN1vcZ8XPw6Ql-3-MvLFmobVfHki4bT'),
('Smart Watch Series 7', 329.00, 'Modern smartwatch with stainless steel band and digital face.', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCNTsUKkLYP75mKrOby6NfwbtKf6zRn2dfizl1WnZ2DnPMED2asAOazg8bRr-62Z0ZRQx3AyZTVrQYLEY2Bpw7g5iypIKeSFymy1OifIf3457xCu_iMQO2FEUPXD601S5iRCgNAAbuspJd5OpRp8mkNc5d8_yAr0zDw0zgVrCcMc-s5L1XXhbgWVqmIDOSBWelmXzkMR2XFgEQt34N6haIqKS645tk9k5qR4FL6GF2EQkQcSMKSU8MOYG8pq4YiVpQhQaIlvcoCW2Ud'),
('Eco-Steel Bottle', 35.00, 'Eco-friendly insulated water bottle in forest green.', 'https://lh3.googleusercontent.com/aida-public/AB6AXuAk2A5k85qdrN5Ty-CetGwU9v-mwVxskReYJKxmbIMVOECKtpAbrQLKUhLZHcgn-7sLs82RrE5s5BT9JZZbWvz28pyYh5PFaW8QG3qMiFPLrKLxjT-5HDSwm-VrP3rmyagNOcIiyu4QBtonJ6JT3ASgC8aFbt5FSgCjWfznxafSokQxKhLlcunpwGy8RfYxHSJfgKvGPP32fn7C5Xh3Jif9gYUuWcHsdnkmYQq40vRbYINO-bmUUWjv9KnDMxFnHeTJ6mxiSEEn2K_B'),
('Leather Travel Bag', 120.00, 'Classic leather weekender bag in tan brown.', 'https://lh3.googleusercontent.com/aida-public/AB6AXuA4qmZ3B-RwBVLrxLKt6TVhE1qyjz5YqNbXKzOcnCtUogihOpb6FPx6f7nkyR-d4jCRbTm6u6uGQdKbmGIwxqx3du_bF2CO_TpNuVKV0QooGLKrOFMWqPY9czJ1Evog5_OF5-xSmg2DiOq00Z5Mp2Fsui--RNH_7anvTAxEALKtxiV9FDiAYooM1sQQkyU-_E2riw34_jXOm2qaJMtpJUO-rJhvtsgTOGkT9yqBDqwNMRXv8VmljE7jY5WZwHgoWPawlDZkmDnqie_S'),
('Organic Cotton Tee', 28.00, 'Organic cotton t-shirt in minimalist white.', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDX7QSVb1ul529YniXvHUAeGlc_CiwE8KjOKk4ZznakSMTh_JdKftAiDixtaGMrQ37TE8weOap3mc0Qx87--LQdgaPTR_K5sk0r29LWE4rkWG9VMi2mNHUcxzPWWhFUFTVMSqFI2O1pRqdXpYMSFAOTqb-kr2k0Br47QQsuibNpj8qwKEg1qGYzLtiXpOyIJouM9fWbqP46zAre3hDAfRPdwsmrD8BpusgKZFU2-RZIcoAecpKYfpgWqIKMO8ksrk8UU0v6ZQGYNC'),
('Minimalist Desk Lamp', 55.00, 'Minimalist wooden desk lamp with warm light.', 'https://lh3.googleusercontent.com/aida-public/AB6AXuBpQ8hQyx_nBBa4a92YoDxqI7Sioc4RVox9TZUQbVfizIdq8pCRn5guGZAygw5oNQsWkRxli8sH5iwZzsPJE2wMWSXm5p-heo2E8jDduVkevoRRwWtmeNCkBCvrKueOhg-tp_omECQOVxNxCSXjxguSdmGtJBfdzErxdCOl-PG-Sx7q-bOHCZKoqZ7KzbuHjOMPgaJVWBHOorF7WkyKMLqkkiXOKNcjZl2zDunldER8YYU42vR5jy6EgCIWny-RBkFlYfO3E5NzZPTx'),
('Noise Cancelling Earbuds', 129.99, 'Sleek black noise cancelling earbuds in charging case.', 'https://lh3.googleusercontent.com/aida-public/AB6AXuC9as8JGCvkTKeQlwTlwpBQLhstAGnWEXMig5_rYraXPjy-s_5Ez4M-GQ9UI_JWFDtDQyzuwKXan4ZVOAHOZsEpWpeUABUzI4TlMXum140uByYXBDjlpSwhSVjLoLjrog9eFp48UeQm8zN1PmZXgEfAfS5AR16GGHMo-a6P_lbuzyPyo7kr_8opHxGlcjLkGRori2IOgk0Rcv4lX7puRXR8Odz6An3OGCd4KfH7qDL9aQjgkbj98T45sNM4uahQM9T-J1jXa25QcSX'),
('Portable Power Bank', 45.00, 'Compact portable power bank with multiple ports.', 'https://lh3.googleusercontent.com/aida-public/AB6AXuASaXg--4OsAVAALIM35kmor7IjJCSty0qiNem_PhbgxR9JEV5F6-IQwbsrIhByIeHdnPNvv_rW0s-rl_E5gxrYRIn_8-Ad-02dJO9q1Z-gLFFEuEQM-2Z4cOazqKkv3scfmCbrlFCXstUI0Uc3NdxHfF4qHSP4MGE59RNVFY-8yH6ZZQwXnyG1bnypEuwI4W6Hbah-qF8wXMMaQSf6m7wFQr1FMX6DjB0UNTwhD5xBk0Gbf2TEa6W0qkufSqP7CZ00GVHuy7QHg0dR');