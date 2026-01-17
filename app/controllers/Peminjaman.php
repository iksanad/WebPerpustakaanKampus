<?php

class Peminjaman extends Controller {
    public function __construct() {
        if(!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function index() {
        if($_SESSION['role'] == 'admin') {
            $data['judul'] = 'Daftar Peminjaman';
            $data['peminjaman'] = $this->model('Peminjaman_model')->getAllPeminjaman();
            $this->view('templates/header', $data);
            $this->view('peminjaman/index', $data); // We need to create this view or reuse admin dashboard part
            $this->view('templates/footer');
        } else {
            header('Location: ' . BASEURL . '/mahasiswa');
            exit;
        }
    }

    public function setujui($id) {
        if($_SESSION['role'] != 'admin') header('Location: ' . BASEURL);

        if($this->model('Peminjaman_model')->setujuiPinjam($id) > 0) {
            Flasher::setFlash('berhasil', 'disetujui', 'success');
        } else {
            Flasher::setFlash('gagal', 'disetujui', 'danger');
        }
        header('Location: ' . BASEURL . '/admin');
        exit;
    }

    public function tolak($id) {
        if($_SESSION['role'] != 'admin') header('Location: ' . BASEURL);

        if($this->model('Peminjaman_model')->tolakPinjam($id) > 0) {
            Flasher::setFlash('berhasil', 'ditolak', 'success');
        } else {
            Flasher::setFlash('gagal', 'ditolak', 'danger');
        }
        header('Location: ' . BASEURL . '/admin');
        exit;
    }

    public function kembali($id) {
        if($_SESSION['role'] != 'admin') header('Location: ' . BASEURL);

        if($this->model('Peminjaman_model')->kembalikanBuku($id) > 0) {
            Flasher::setFlash('berhasil', 'dikembalikan', 'success');
        } else {
            Flasher::setFlash('gagal', 'dikembalikan', 'danger');
        }
        header('Location: ' . BASEURL . '/admin');
        exit;
    }

    public function ajukan() {
        if($_SESSION['role'] != 'mahasiswa') header('Location: ' . BASEURL);

        // Validasi input
        if(empty($_POST['book_id']) || empty($_POST['tanggal_kembali'])) {
             Flasher::setFlash('gagal', 'diajukan: Data tidak lengkap', 'danger');
             header('Location: ' . BASEURL . '/mahasiswa');
             exit;
        }

        $data = [
            'user_id' => $_SESSION['user_id'],
            'book_id' => $_POST['book_id'],
            'tanggal_kembali' => $_POST['tanggal_kembali']
        ];

        if($this->model('Peminjaman_model')->ajukanPinjam($data) > 0) {
            Flasher::setFlash('berhasil', 'diajukan', 'success');
        } else {
            Flasher::setFlash('gagal', 'diajukan: Stok habis atau error', 'danger');
        }
        header('Location: ' . BASEURL . '/mahasiswa');
        exit;
    }

    public function tambah() {
        if($_SESSION['role'] != 'admin') header('Location: ' . BASEURL);

        $data['judul'] = 'Tambah Peminjaman';
        // Need to get all users (mahasiswa) and books
        // Quick model usage
        $this->db = new Database;
        $this->db->query("SELECT * FROM users WHERE role='mahasiswa'");
        $data['users'] = $this->db->resultSet();
        $data['buku'] = $this->model('Buku_model')->getAllBuku();

        $this->view('templates/header', $data);
        $this->view('peminjaman/create', $data);
        $this->view('templates/footer');
    }

    public function prosessAdmin() {
        if($_SESSION['role'] != 'admin') header('Location: ' . BASEURL);

        $data = [
            'user_id' => $_POST['user_id'],
            'book_id' => $_POST['book_id'],
            'tanggal_kembali' => $_POST['tanggal_kembali']
        ];

        // Using ajukanPinjam but we need to auto-approve it or stick to "Diajukan" -> "Setujui". 
        // Requirement: "Admin Input buku yang dipinjam – Setelah selesai stok buku otomatis terupdate."
        // So it should be 'dipinjam' immediately.
        
        // Let's create a specific model method or just reuse and update.
        // I'll reuse ajukan but assume it's approved immediately? 
        // Better: Custom logic here.
        
        $db = new Database;
        // Check stock
        $db->query("SELECT stok FROM books WHERE id = :book_id");
        $db->bind('book_id', $data['book_id']);
        $book = $db->single();

        if ($book['stok'] > 0) {
            $query = "INSERT INTO loans (user_id, book_id, tanggal_pinjam, tanggal_kembali_rencana, status) VALUES (:user_id, :book_id, CURDATE(), :tanggal_kembali, 'dipinjam')";
            $db->query($query);
            $db->bind('user_id', $data['user_id']);
            $db->bind('book_id', $data['book_id']);
            $db->bind('tanggal_kembali', $data['tanggal_kembali']);
            $db->execute();
            
            // Decrease Stock
            $db->query("UPDATE books SET stok = stok - 1 WHERE id = :book_id");
            $db->bind('book_id', $data['book_id']);
            $db->execute();

            Flasher::setFlash('berhasil', 'dipinjamkan', 'success');
        } else {
            Flasher::setFlash('gagal', 'dipinjamkan: Stok habis', 'danger');
        }
        header('Location: ' . BASEURL . '/admin');
        exit;
    }
}
