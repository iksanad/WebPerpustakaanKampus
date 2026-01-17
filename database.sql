-- Database for WebPerpustakaanKampus

CREATE DATABASE IF NOT EXISTS perpustakaan_kampus;
USE perpustakaan_kampus;

-- Table: users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    npm VARCHAR(20) DEFAULT NULL,
    email VARCHAR(100) DEFAULT NULL,
    no_telp VARCHAR(20) DEFAULT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'mahasiswa') NOT NULL DEFAULT 'mahasiswa',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: books
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    pengarang VARCHAR(100) NOT NULL,
    penerbit VARCHAR(100) NOT NULL,
    tahun INT NOT NULL,
    stok INT NOT NULL DEFAULT 0,
    deskripsi TEXT DEFAULT NULL,
    gambar VARCHAR(255) DEFAULT 'default.jpg',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: loans
CREATE TABLE loans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    tanggal_pinjam DATE NOT NULL,
    tanggal_kembali_rencana DATE NOT NULL,
    tanggal_kembali_realisasi DATE,
    status ENUM('diajukan', 'dipinjam', 'dikembalikan', 'ditolak') DEFAULT 'diajukan',
    denda DECIMAL(10, 2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
);

-- Insert Default Admin (password: admin123)
INSERT INTO users (nama, username, password, role) VALUES 
('Administrator', 'admin', '$2y$10$ObjrvA9DLYakwfEo2.IRUuCmVpWxwQ22NXAnnTtttiBVyyvW4t5Ti', 'admin');

