-- Create database
CREATE DATABASE IF NOT EXISTS restaurant_db;
USE restaurant_db;

-- Create reservations table
CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    reservation_date DATE NOT NULL,
    reservation_time TIME NOT NULL,
    num_people INT NOT NULL
);

-- Create menu_items table
CREATE TABLE menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    rating DECIMAL(3,2)
);

-- Create reservation_menu table
CREATE TABLE reservation_menu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reservation_id INT,
    menu_item_id INT,
    FOREIGN KEY (reservation_id) REFERENCES reservations(id) ON DELETE CASCADE,
    FOREIGN KEY (menu_item_id) REFERENCES menu_items(id) ON DELETE CASCADE
);

-- Sample menu items
INSERT INTO menu_items (item_name, price, rating) VALUES
('Paneer Butter Masala', 180.00, 4.5),
('Veg Biryani', 150.00, 4.2),
('Butter Naan', 25.00, 4.0),
('Chicken 65', 200.00, 4.7);
