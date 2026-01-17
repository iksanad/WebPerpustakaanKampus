<?php

class User_model {
    private $table = 'users';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getUserByUsername($username) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE username=:username');
        $this->db->bind('username', $username);
        return $this->db->single();
    }

    public function getUserById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getMahasiswaCount() {
        $this->db->query("SELECT COUNT(*) as total FROM " . $this->table . " WHERE role = 'mahasiswa'");
        return $this->db->single()['total'];
    }

    public function tambahUser($data) {
        $query = "INSERT INTO users (nama, username, npm, email, no_telp, password, role) VALUES (:nama, :username, :npm, :email, :no_telp, :password, 'mahasiswa')";
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('npm', $data['npm']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('no_telp', $data['telp']); // Form input name is 'telp'
        $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
        
        $this->db->execute();
        return $this->db->rowCount();
    }
}
