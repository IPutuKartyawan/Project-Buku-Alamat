CREATE DATABASE buku_alamat;
USE buku_alamat;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
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

INSERT INTO contacts (user_id, name, phone, email, address, category)
VALUES
(1, 'Ibu Sari', '081234567890', 'sari@gmail.com', 'Jl. Merdeka No. 1', 'Keluarga'),
(1, 'Pakyan KOster', '08256789055', 'goodbegood@gmail.com', 'Jl. Tengah Merdeka', 'Keluarga'),
(1, 'Budi Santoso', '082345678901', 'budi@gmail.com', 'Jl. Sudirman No. 10', 'Teman'),
(1, 'Rina Wijaya', '083456789012', 'rina@gmail.com', 'Jl. Diponegoro No. 5', 'Kerja'),
(1, 'Ahmad Fauzi', '084567890123', 'ahmad@gmail.com', 'Jl. Ahmad Yani No. 7', 'Kerja'),
(1, 'Dewi Lestari', '085678901234', 'dewi@gmail.com', 'Jl. Melati No. 3', 'Lainnya'),
(1, 'Wayan Jenar', '0856784677382', 'yanjenaar@gmail.com', 'Jl. Gajahmada dangin puri', 'Teman');
