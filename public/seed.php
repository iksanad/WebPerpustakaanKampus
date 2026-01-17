<?php
// seed.php
require_once 'app/config/config.php';
require_once 'app/core/Database.php';

echo "Seeding Database...\n";

$db = new Database;

// 1. Reset Tables
// Disable foreign key checks
$db->query("SET FOREIGN_KEY_CHECKS = 0");
$db->execute();

$db->query("TRUNCATE TABLE loans");
$db->execute();
$db->query("TRUNCATE TABLE books");
$db->execute();
$db->query("TRUNCATE TABLE users");
$db->execute();

// Enable foreign key checks
$db->query("SET FOREIGN_KEY_CHECKS = 1");
$db->execute();

// 2. Insert Admin
$passAdmin = password_hash('admin123', PASSWORD_DEFAULT);
$db->query("INSERT INTO users (nama, username, password, role) VALUES ('Administrator', 'admin', :pass, 'admin')");
$db->bind('pass', $passAdmin);
$db->execute();
echo "Admin created (user: admin, pass: admin123)\n";

// 3. Insert Mahasiswa
$passMhs = password_hash('mhs123', PASSWORD_DEFAULT);
$db->query("INSERT INTO users (nama, username, password, role) VALUES ('Budi Santoso', 'budi', :pass, 'mahasiswa')");
$db->bind('pass', $passMhs);
$db->execute();
echo "Mahasiswa created (user: budi, pass: mhs123)\n";

// 4. Insert Books
$books = [
    ['Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', 2005, 5],
    ['Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', 1980, 3],
    ['Algoritma dan Pemrograman', 'Rinaldi Munir', 'Informatika', 2011, 10],
    ['Filosofi Teras', 'Henry Manampiring', 'Kompas', 2018, 7],
    ['Clean Code', 'Robert C. Martin', 'Prentice Hall', 2008, 2]
];

foreach ($books as $b) {
    $db->query("INSERT INTO books (judul, pengarang, penerbit, tahun, stok) VALUES (:judul, :pengarang, :penerbit, :tahun, :stok)");
    $db->bind('judul', $b[0]);
    $db->bind('pengarang', $b[1]);
    $db->bind('penerbit', $b[2]);
    $db->bind('tahun', $b[3]);
    $db->bind('stok', $b[4]);
    $db->execute();
}
echo "Books seeded.\n";

echo "Done.";
