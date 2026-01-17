<div class="row mt-4">
    <div class="col-md-6">
        <h3>Tambah Peminjaman (Admin)</h3>
        <form action="<?= BASEURL; ?>/peminjaman/prosessAdmin" method="post">
            <div class="mb-3">
                <label for="user_id" class="form-label">Pilih Mahasiswa</label>
                <select class="form-select" name="user_id" required>
                    <?php foreach($data['users'] as $u): ?>
                        <option value="<?= $u['id']; ?>"><?= $u['nama']; ?> (<?= $u['username']; ?>)</option>
                    <?php endforeach; ?>
                </select>
                <div class="form-text">Jika mahasiswa belum terdaftar, <a href="<?= BASEURL; ?>/auth/register">Daftarkan Disini</a> (Logout dulu atau gunakan mode samaran). *Fitur tambah user via Admin belum dibuat spesifik, gunakan register biasa.*</div>
            </div>
            
            <div class="mb-3">
                <label for="book_id" class="form-label">Pilih Buku</label>
                <select class="form-select" name="book_id" required>
                    <?php foreach($data['buku'] as $b): ?>
                        <?php if($b['stok'] > 0): ?>
                            <option value="<?= $b['id']; ?>"><?= $b['judul']; ?> (Stok: <?= $b['stok']; ?>)</option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                <input type="date" class="form-control" name="tanggal_kembali" required min="<?= date('Y-m-d'); ?>">
            </div>
            
            <button type="submit" class="btn btn-primary">Proses Peminjaman</button>
            <a href="<?= BASEURL; ?>/admin" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
