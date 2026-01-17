<?php

class Admin extends Controller {
    public function __construct() {
        // Middleware: Cek jika login dan role admin
        if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function index() {
        $data['judul'] = 'Dashboard Admin';
        $data['total_buku'] = count($this->model('Buku_model')->getAllBuku());
        
        $db = new Database;
        // Count Active Loans
        $db->query("SELECT COUNT(*) as count FROM loans WHERE status = 'dipinjam'");
        $data['active_loans'] = $db->single()['count'];

        // Count Overdue Loans
        $db->query("SELECT COUNT(*) as count FROM loans WHERE status = 'dipinjam' AND tanggal_kembali_rencana < CURDATE()");
        $data['overdue_loans'] = $db->single()['count'];
        
        $this->view('templates/header', $data);
        $this->view('admin/index', $data);
        $this->view('templates/footer');
    }
}
