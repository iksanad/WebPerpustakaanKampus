<?php

class Buku extends Controller {
    public function __construct() {
        if(!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function index() {
        // Halaman Management Buku (Admin Only)
        if($_SESSION['role'] != 'admin') {
            header('Location: ' . BASEURL . '/buku/katalog');
            exit;
        }

        $data['judul'] = 'Daftar Buku';
        $data['buku'] = $this->model('Buku_model')->getAllBuku();
        
        $this->view('templates/header', $data);
        $this->view('admin/buku', $data);
        $this->view('templates/footer');
    }

    public function form($id = null) {
        // Form for Add/Edit Book (Admin Only)
        if($_SESSION['role'] != 'admin') {
            header('Location: ' . BASEURL);
            exit;
        }

        $data['judul'] = $id ? 'Edit Buku' : 'Tambah Buku';
        
        if($id) {
            $data['buku'] = $this->model('Buku_model')->getBukuById($id);
        }
        
        $this->view('templates/header', $data);
        $this->view('admin/form_buku', $data);
        $this->view('templates/footer');
    }

    public function katalog() {
        // Halaman Katalog (Public/Student)
        $data['judul'] = 'Katalog Buku';
        $data['buku'] = $this->model('Buku_model')->getAllBuku();
        
        $this->view('templates/header', $data);
        $this->view('katalog', $data);
        $this->view('templates/footer');
    }

    public function cari() {
        $data['judul'] = 'Cari Buku';
        $data['buku'] = $this->model('Buku_model')->cariDataBuku();
        
        $this->view('templates/header', $data);
        $this->view('katalog', $data);
        $this->view('templates/footer');
    }

    public function tambah() {
        if($_SESSION['role'] != 'admin') header('Location: ' . BASEURL);
        
        // Handle File Upload
        if($_FILES['gambar']['error'] === 4) {
            $gambar = 'default.jpg';
        } else {
            $gambar = $this->upload();
            if(!$gambar) {
                return false; 
                // upload method will handle flashing error, but we need to stop execution
                // actually better to check return value
            }
        }

        $data = $_POST;
        $data['gambar'] = $gambar;

        if($this->model('Buku_model')->tambahDataBuku($data) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/buku');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/buku');
            exit;
        }
    }

    public function upload() {
        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpName = $_FILES['gambar']['tmp_name'];

        // Cek apakah tidak ada gambar yang diupload
        if($error === 4) {
            return 'default.jpg';
        }

        // Cek apakah yang diupload adalah gambar
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            Flasher::setFlash('gagal', 'upload gambar (bukan gambar valid)', 'danger');
            header('Location: ' . BASEURL . '/buku');
            exit;
        }

        // Cek ukuran
        if($ukuranFile > 2000000) {
            Flasher::setFlash('gagal', 'upload gambar (ukuran terlalu besar > 2MB)', 'danger');
            header('Location: ' . BASEURL . '/buku');
            exit;
        }

        // Generate nama baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;

        move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

        return $namaFileBaru;
    }

    public function hapus($id) {
        if($_SESSION['role'] != 'admin') header('Location: ' . BASEURL);

        if($this->model('Buku_model')->hapusDataBuku($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/buku');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/buku');
            exit;
        }
    }
    
    public function ubah() {
        if($_SESSION['role'] != 'admin') header('Location: ' . BASEURL);

        $data = $_POST;
        $gambarLama = $_POST['gambarLama'];

        // Cek apakah user pilih gambar baru atau tidak
        if($_FILES['gambar']['error'] === 4) {
            $gambar = $gambarLama;
        } else {
            $gambar = $this->upload();
        }

        $data['gambar'] = $gambar;

        if($this->model('Buku_model')->ubahDataBuku($data) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/buku');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/buku');
            exit;
        }
    }

    public function getubah() {
        echo json_encode($this->model('Buku_model')->getBukuById($_POST['id']));
    }
}
