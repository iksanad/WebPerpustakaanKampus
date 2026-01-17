<?php

class Buku_model {
    private $table = 'books';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllBuku() {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getBukuById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataBuku($data) {
        $query = "INSERT INTO books (judul, pengarang, penerbit, tahun, stok, gambar) VALUES (:judul, :pengarang, :penerbit, :tahun, :stok, :gambar)";
        $this->db->query($query);
        $this->db->bind('judul', $data['judul']);
        $this->db->bind('pengarang', $data['pengarang']);
        $this->db->bind('penerbit', $data['penerbit']);
        $this->db->bind('tahun', $data['tahun']);
        $this->db->bind('stok', $data['stok']);
        $this->db->bind('gambar', $data['gambar']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahDataBuku($data) {
        $query = "UPDATE books SET judul=:judul, pengarang=:pengarang, penerbit=:penerbit, tahun=:tahun, stok=:stok, gambar=:gambar WHERE id=:id";
        $this->db->query($query);
        $this->db->bind('judul', $data['judul']);
        $this->db->bind('pengarang', $data['pengarang']);
        $this->db->bind('penerbit', $data['penerbit']);
        $this->db->bind('tahun', $data['tahun']);
        $this->db->bind('stok', $data['stok']);
        $this->db->bind('gambar', $data['gambar']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusDataBuku($id) {
        $query = "DELETE FROM books WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function cariDataBuku() {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM books WHERE judul LIKE :keyword OR pengarang LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }
}
