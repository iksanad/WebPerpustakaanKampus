<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h4>Login Perpustakaan</h4>
            </div>
            <div class="card-body">
                <?php Flasher::flash(); ?>
                <form action="<?= BASEURL; ?>/auth/login" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="<?= BASEURL; ?>/auth/register">Belum punya akun? Daftar</a>
            </div>
        </div>
    </div>
</div>
