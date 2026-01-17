<?php

class Peminjaman_model {
    private $table = 'loans';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllPeminjaman() {
        $query = "SELECT l.*, u.nama as nama_peminjam, b.judul as judul_buku 
                  FROM loans l 
                  JOIN users u ON l.user_id = u.id 
                  JOIN books b ON l.book_id = b.id
                  ORDER BY l.created_at DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getPeminjamanByUser($user_id) {
        $query = "SELECT l.*, b.judul as judul_buku 
                  FROM loans l 
                  JOIN books b ON l.book_id = b.id 
                  WHERE l.user_id = :user_id 
                  ORDER BY l.created_at DESC";
        $this->db->query($query);
        $this->db->bind('user_id', $user_id);
        return $this->db->resultSet();
    }

    public function ajukanPinjam($data) {
        // Cek stok dulu
        $this->db->query("SELECT stok FROM books WHERE id = :book_id");
        $this->db->bind('book_id', $data['book_id']);
        $book = $this->db->single();

        if ($book['stok'] > 0) {
            $query = "INSERT INTO loans (user_id, book_id, tanggal_pinjam, tanggal_kembali_rencana, status) VALUES (:user_id, :book_id, CURDATE(), :tanggal_kembali, 'diajukan')";
            $this->db->query($query);
            $this->db->bind('user_id', $data['user_id']);
            $this->db->bind('book_id', $data['book_id']);
            $this->db->bind('tanggal_kembali', $data['tanggal_kembali']);
            $this->db->execute();
            return $this->db->rowCount();
        } else {
            return 0; // Stok habis
        }
    }

    public function setujuiPinjam($id) {
        // Update status
        $query = "UPDATE loans SET status = 'dipinjam' WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        // Kurangi stok
        $this->db->query("UPDATE books SET stok = stok - 1 WHERE id = (SELECT book_id FROM loans WHERE id = :id)");
        $this->db->bind('id', $id);
        $this->db->execute();

        return 1;
    }

    public function kembalikanBuku($id) {
        // Update status dan tanggal kembali
        $query = "UPDATE loans SET status = 'dikembalikan', tanggal_kembali_realisasi = CURDATE() WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        // Tambah stok lagi
        $this->db->query("UPDATE books SET stok = stok + 1 WHERE id = (SELECT book_id FROM loans WHERE id = :id)");
        $this->db->bind('id', $id);
        $this->db->execute();

        return 1;
    }
    
    public function tolakPinjam($id) {
        $query = "UPDATE loans SET status = 'ditolak' WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getPeminjamanBulanIniCount() {
        $this->db->query("SELECT COUNT(*) as total FROM loans WHERE MONTH(tanggal_pinjam) = MONTH(CURRENT_DATE()) AND YEAR(tanggal_pinjam) = YEAR(CURRENT_DATE())");
        return $this->db->single()['total'];
    }
}
