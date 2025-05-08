CREATE TABLE users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    UserName VARCHAR(255) NOT NULL,
    FirstName VARCHAR(255) NOT NULL,
    LastName VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);



CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    quantity INT NOT NULL DEFAULT 0,
    price DECIMAL(10, 2) NOT NULL,
    category_id INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);



INSERT INTO categories (name)
VALUES
('Fruits'),
('Vegetables'),
('Meat & Poultry'),
('Seafood'),
('Dairy Products'),
('Bakery'),
('Snacks'),
('Beverages'),
('Frozen Foods'),
('Canned Goods');



INSERT INTO items (name, description, quantity, price, category_id)
VALUES

('Apple', 'Fresh red apples, 1kg pack', 50, 150.00, 1),
('Banana', 'Yellow bananas, 1 dozen', 80, 120.00, 1),
('Grapes', 'Seedless green grapes, 1kg pack', 30, 200.00, 1),

('Carrot', 'Fresh carrots, 1kg pack', 60, 80.00, 2),
('Lettuce', 'Crisp lettuce, 1 head', 40, 50.00, 2),
('Tomato', 'Fresh red tomatoes, 1kg pack', 70, 90.00, 2),

('Chicken Breast', 'Boneless, skinless chicken breasts, 1kg', 25, 350.00, 3),
('Ground Beef', 'Minced beef, 1kg pack', 20, 400.00, 3),
('Pork Chops', 'Fresh pork chops, 1kg pack', 15, 420.00, 3),

('Salmon Fillet', 'Fresh salmon fillet, 1kg', 10, 800.00, 4),
('Shrimp', 'Frozen shrimp, 1kg pack', 30, 600.00, 4),
('Tuna', 'Fresh tuna steaks, 1kg pack', 12, 950.00, 4),

('Milk', 'Fresh whole milk, 1 liter', 100, 45.00, 5),
('Cheese', 'Cheddar cheese, 500g block', 50, 150.00, 5),
('Yogurt', 'Plain yogurt, 500g', 60, 70.00, 5),

('Bread', 'Whole wheat bread, 1 loaf', 120, 40.00, 6),
('Croissant', 'Butter croissants, pack of 6', 30, 120.00, 6),
('Muffins', 'Blueberry muffins, pack of 6', 45, 150.00, 6),

('Chips', 'Potato chips, 200g pack', 80, 50.00, 7),
('Chocolate', 'Milk chocolate bar, 100g', 100, 60.00, 7),
('Cookies', 'Chocolate chip cookies, pack of 12', 90, 120.00, 7),

('Coffee', 'Ground coffee, 250g pack', 50, 250.00, 8),
('Tea', 'Black tea bags, 50 count', 70, 150.00, 8),
('Orange Juice', 'Fresh orange juice, 1 liter', 60, 120.00, 8),

('Frozen Pizza', 'Frozen margherita pizza, 500g', 40, 450.00, 9),
('Ice Cream', 'Vanilla ice cream, 1 liter', 35, 200.00, 9),
('Frozen Fries', 'Frozen French fries, 1kg pack', 50, 100.00, 9),

('Canned Beans', 'Canned black beans, 400g', 90, 35.00, 10),
('Canned Tuna', 'Canned tuna, 180g', 80, 50.00, 10),
('Canned Soup', 'Tomato soup, 400g', 70, 60.00, 10);