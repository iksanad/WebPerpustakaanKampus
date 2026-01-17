<div class="row mt-4">
    <div class="col-md-12">
        <?php Flasher::flash(); ?>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3><?= isset($data['buku']) ? 'Edit Buku' : 'Tambah Buku Baru'; ?></h3>
            <a href="<?= BASEURL; ?>/buku" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Buku
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="<?= BASEURL; ?>/buku/<?= isset($data['buku']) ? 'ubah' : 'tambah'; ?>" method="post" enctype="multipart/form-data">
                    
                    <?php if(isset($data['buku'])): ?>
                        <input type="hidden" name="id" value="<?= $data['buku']['id']; ?>">
                        <input type="hidden" name="gambarLama" value="<?= $data['buku']['gambar']; ?>">
                    <?php endif; ?>
                    
                    <div class="row">
                        <!-- Image Upload Section -->
                        <div class="col-md-12 mb-4">
                            <label for="gambar" class="form-label fw-bold">Gambar Buku</label>
                            <?php if(isset($data['buku']) && !empty($data['buku']['gambar'])): ?>
                                <div class="mb-3">
                                    <img src="<?= BASEURL; ?>/img/<?= $data['buku']['gambar']; ?>" 
                                         alt="Current Image" 
                                         class="img-thumbnail" 
                                         style="max-width: 200px; max-height: 280px; object-fit: cover;"
                                         id="previewGambar">
                                </div>
                            <?php else: ?>
                                <div class="mb-3">
                                    <img src="" alt="Preview" id="previewGambar" class="img-thumbnail d-none" style="max-width: 200px;">
                                </div>
                            <?php endif; ?>
                            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, GIF (Max 2MB)</small>
                        </div>

                        <!-- Judul -->
                        <div class="col-md-6 mb-3">
                            <label for="judul" class="form-label fw-bold">Judul Buku <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control" 
                                   id="judul" 
                                   name="judul" 
                                   value="<?= isset($data['buku']) ? $data['buku']['judul'] : ''; ?>"
                                   required>
                        </div>

                        <!-- Pengarang -->
                        <div class="col-md-6 mb-3">
                            <label for="pengarang" class="form-label fw-bold">Pengarang <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control" 
                                   id="pengarang" 
                                   name="pengarang" 
                                   value="<?= isset($data['buku']) ? $data['buku']['pengarang'] : ''; ?>"
                                   required>
                        </div>

                        <!-- Penerbit -->
                        <div class="col-md-6 mb-3">
                            <label for="penerbit" class="form-label fw-bold">Penerbit <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control" 
                                   id="penerbit" 
                                   name="penerbit" 
                                   value="<?= isset($data['buku']) ? $data['buku']['penerbit'] : ''; ?>"
                                   required>
                        </div>

                        <!-- Tahun -->
                        <div class="col-md-3 mb-3">
                            <label for="tahun" class="form-label fw-bold">Tahun Terbit <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control" 
                                   id="tahun" 
                                   name="tahun" 
                                   value="<?= isset($data['buku']) ? $data['buku']['tahun'] : ''; ?>"
                                   min="1900"
                                   max="<?= date('Y'); ?>"
                                   required>
                        </div>

                        <!-- Stok -->
                        <div class="col-md-3 mb-3">
                            <label for="stok" class="form-label fw-bold">Stok <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control" 
                                   id="stok" 
                                   name="stok" 
                                   value="<?= isset($data['buku']) ? $data['buku']['stok'] : ''; ?>"
                                   min="0"
                                   required>
                        </div>

                        <!-- Deskripsi -->
                        <div class="col-md-12 mb-3">
                            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="4"
                                      placeholder="Masukkan deskripsi buku..."><?= isset($data['buku']) ? $data['buku']['deskripsi'] : ''; ?></textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="<?= BASEURL; ?>/buku" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> <?= isset($data['buku']) ? 'Update Buku' : 'Simpan Buku'; ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Image preview
document.getElementById('gambar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('previewGambar');
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        }
        reader.readAsDataURL(file);
    }
});
</script>
