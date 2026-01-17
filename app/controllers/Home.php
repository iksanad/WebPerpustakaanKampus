<?php

class Home extends Controller {
    public function index() {
        // Fix for old sessions that don't have username
        if(isset($_SESSION['user_id']) && !isset($_SESSION['username'])) {
            $user = $this->model('User_model')->getUserById($_SESSION['user_id']);
            if($user) {
                $_SESSION['username'] = $user['username'];
            }
        }
        
        $data['judul'] = 'Home';
        $data['count_buku'] = $this->model('Buku_model')->getBukuCount();
        $data['count_mhs'] = $this->model('User_model')->getMahasiswaCount();
        $data['count_pinjam'] = $this->model('Peminjaman_model')->getPeminjamanBulanIniCount();
        
        $this->view('home', $data);
    }
}
