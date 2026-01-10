CREATE DATABASE buku_alamat;
USE buku_alamat;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','user'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    email VARCHAR(100),
    address TEXT,
    category ENUM('Keluarga','Teman','Kerja','Lainnya') DEFAULT 'Lainnya',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO users (name, email, password)
VALUES (
    'Admin',
    'admin@gmail.com',
    '$2y$10$CwTycUXWue0Thq9StjUM0uJ8eZ3gqf2S4GJYB9l1H8h3Z0Z5H6b6m'
);

INSERT INTO contacts (user_id, name, phone, email, address, category)VALUES
(1, 'Ibu Sari', '081234567890', 'sari@gmail.com', 'Jl. Merdeka No. 1', 'Keluarga'),
(1, 'Pakyan KOster', '08256789055', 'goodbegood@gmail.com', 'Jl. Tengah Merdeka', 'Keluarga'),
(1, 'Budi Santoso', '082345678901', 'budi@gmail.com', 'Jl. Sudirman No. 10', 'Teman'),
(1, 'Rina Wijaya', '083456789012', 'rina@gmail.com', 'Jl. Diponegoro No. 5', 'Kerja'),
(1, 'Ahmad Fauzi', '084567890123', 'ahmad@gmail.com', 'Jl. Ahmad Yani No. 7', 'Kerja'),
(1, 'Dewi Lestari', '085678901234', 'dewi@gmail.com', 'Jl. Melati No. 3', 'Lainnya'),
(1, 'Wayan Jenar', '0856784677382', 'yanjenaar@gmail.com', 'Jl. Gajahmada dangin puri', 'Teman');

UPDATE users SET role='admin' WHERE email='admin@gmail.com';

UPDATE users
SET password = '$2y$10$8wQyJ1qf9jJ9Xl2y4Q8N5O7xv8rF6l5HkY8zv3y0xF9Y6PqG'
WHERE email = 'admin@gmail.com';
SELECT id, name, email, password FROM users WHERE email='admin@gmail.com';
ALTER TABLE users
ADD role ENUM('admin','user') DEFAULT 'user';
UPDATE users
SET role = 'admin'
WHERE email = 'admin@gmail.com';
UPDATE users SET role='admin' WHERE email='admin@gmail.com';


