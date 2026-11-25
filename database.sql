-- Database untuk Praktikum 9 (PHP Modular)
CREATE DATABASE IF NOT EXISTS db_latihan CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE db_latihan;

CREATE TABLE IF NOT EXISTS users (
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama       VARCHAR(100) NOT NULL,
    email      VARCHAR(120) NOT NULL UNIQUE,
    alamat     TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (nama, email, alamat) VALUES
('Rina Marlina',  'rina@example.com',  'Jl. Merdeka No. 10, Bekasi. Dekat stasiun, lantai 2, gedung biru.'),
('Budi Santoso',  'budi@example.com',  'Jl. Sudirman No. 25, Jakarta Selatan.'),
('Siti Aminah',   'siti@example.com',  'Perumahan Griya Asri Blok C3 No. 7, Cikarang, Kabupaten Bekasi, Jawa Barat.');
