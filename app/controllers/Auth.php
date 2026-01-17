<?php

class Auth extends Controller {
    public function index() {
        $data['judul'] = 'Login';
        $this->view('templates/header', $data);
        $this->view('auth/login', $data);
        $this->view('templates/footer');
    }

    public function login() {
        if(isset($_POST['username']) && isset($_POST['password'])) {
            $user = $this->model('User_model')->getUserByUsername($_POST['username']);
            if($user) {
                if(password_verify($_POST['password'], $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['nama'] = $user['nama'];
                    if($user['role'] == 'admin') {
                        header('Location: ' . BASEURL . '/admin');
                    } else {
                        header('Location: ' . BASEURL . '/mahasiswa');
                    }
                    exit;
                } else {
                    Flasher::setFlash('Password salah', 'gagal', 'danger');
                    header('Location: ' . BASEURL . '/auth');
                    exit;
                }
            } else {
                Flasher::setFlash('Username tidak ditemukan', 'gagal', 'danger');
                header('Location: ' . BASEURL . '/auth');
                exit;
            }
        }
    }

    public function register() {
        $data['judul'] = 'Register';
        $this->view('templates/header', $data);
        $this->view('auth/register', $data);
        $this->view('templates/footer');
    }

    public function tambah() {
        if($this->model('User_model')->tambahUser($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/auth');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/auth/register');
            exit;
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ' . BASEURL . '/auth');
        exit;
    }
}
