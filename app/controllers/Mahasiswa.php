<?php

class Mahasiswa extends Controller {
    public function __construct() {
        if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'mahasiswa') {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function index() {
        $data['judul'] = 'Dashboard Mahasiswa';
        // Only fetch history
        $data['riwayat'] = $this->model('Peminjaman_model')->getPeminjamanByUser($_SESSION['user_id']);
        
        $this->view('templates/header', $data);
        $this->view('mahasiswa/index', $data);
        $this->view('templates/footer');
    }

    public function cari() {
        $data['judul'] = 'Cari Buku';
        $data['buku'] = $this->model('Buku_model')->cariDataBuku();
        $data['riwayat'] = $this->model('Peminjaman_model')->getPeminjamanByUser($_SESSION['user_id']);
        
        $this->view('templates/header', $data);
        $this->view('mahasiswa/index', $data);
        $this->view('templates/footer');
    }
}
