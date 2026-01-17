<div class="row mt-4">
    <div class="col-md-12">
        <h3>Katalog Buku</h3>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <form action="<?= BASEURL; ?>/buku/cari" method="post" class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Cari buku..." name="keyword" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Cari</button>
        </form>
    </div>
</div>

<div class="row">
    <?php foreach($data['buku'] as $buku): ?>
    <div class="col-md-3 mb-4">
        <div class="card h-100 card-custom">
            <?php 
                $img = (!empty($buku['gambar']) && file_exists('img/' . $buku['gambar'])) ? $buku['gambar'] : 'default.jpg';
            ?>
            <img src="<?= BASEURL; ?>/img/<?= $img; ?>" class="card-img-top" alt="<?= $buku['judul']; ?>" style="height: 300px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title"><?= $buku['judul']; ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?= $buku['pengarang']; ?></h6>
                <p class="card-text">
                    <small>Penerbit: <?= $buku['penerbit']; ?></small><br>
                    <small>Tahun: <?= $buku['tahun']; ?></small><br>
                    <small>Stok: <strong><?= $buku['stok']; ?></strong></small>
                </p>
                <p class="card-text text-muted" style="font-size: 0.9em;">
                    <?= (str_word_count($buku['deskripsi'] ?? '') > 10 ? substr($buku['deskripsi'] ?? '',0,50)."..." : $buku['deskripsi'] ?? ''); ?>
                </p>
                <button type="button" class="btn btn-info btn-sm w-100 mb-2 tombolDetail" data-bs-toggle="modal" data-bs-target="#modalDetail" data-deskripsi="<?= htmlspecialchars($buku['deskripsi'] ?? ''); ?>" data-judul="<?= $buku['judul']; ?>">
                    Detail
                </button>
                <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'mahasiswa'): ?>
                    <?php if($buku['stok'] > 0): ?>
                        <button type="button" class="btn btn-primary btn-sm w-100 tomabolPinjam" data-bs-toggle="modal" data-bs-target="#modalPinjam" data-id="<?= $buku['id']; ?>" data-judul="<?= $buku['judul']; ?>">
                            Pinjam
                        </button>
                    <?php else: ?>
                        <button class="btn btn-secondary btn-sm w-100" disabled>Stok Habis</button>
                    <?php endif; ?>
                <?php else: ?>
                    <!-- If not logged in or admin -->
                    <?php if(!isset($_SESSION['user_id'])): ?>
                         <a href="<?= BASEURL; ?>/auth" class="btn btn-outline-primary btn-sm w-100">Login untuk Pinjam</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<!-- Modal Pinjam (Only needed if logged in as student, but including just in case or we can move it to footer/header if global) -->
<!-- Actually, looking at Mahasiswa view, it has a specific modal. I will replicate it here if Student is logged in, or generic. -->
<!-- For simplicity, I will copy the Modal structure from Mahasiswa index if needed, but since this is 'Katalog' it might be accessed by Guest. -->

<?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'mahasiswa'): ?>
<!-- Modal Pinjam -->
<div class="modal fade" id="modalPinjam" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ajukan Peminjaman</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= BASEURL; ?>/peminjaman/ajukan" method="post">
      <div class="modal-body">
          <input type="hidden" name="book_id" id="book_id_pinjam">
          <p>Anda akan meminjam buku: <strong id="judul_buku_pinjam"></strong></p>
          <div class="mb-3">
            <label for="tanggal_kembali" class="form-label">Tanggal Pengembalian (Rencana)</label>
            <input type="date" class="form-control" name="tanggal_kembali" required min="<?= date('Y-m-d'); ?>">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Ajukan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailJudul">Detail Buku</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="detailDeskripsi"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Modal Pinjam
        const modalPinjam = document.getElementById('modalPinjam')
        if (modalPinjam) {
            modalPinjam.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget
                const id = button.getAttribute('data-id')
                const judul = button.getAttribute('data-judul')
                
                const inputId = modalPinjam.querySelector('#book_id_pinjam')
                const textJudul = modalPinjam.querySelector('#judul_buku_pinjam')
                
                inputId.value = id
                textJudul.textContent = judul
            })
        }

        // Modal Detail
        const modalDetail = document.getElementById('modalDetail')
        if (modalDetail) {
            modalDetail.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget
                const deskripsi = button.getAttribute('data-deskripsi')
                const judul = button.getAttribute('data-judul')
                
                const textDeskripsi = modalDetail.querySelector('#detailDeskripsi')
                const textJudul = modalDetail.querySelector('#detailJudul')
                
                textDeskripsi.textContent = deskripsi ? deskripsi : 'Tidak ada deskripsi.'
                textJudul.textContent = judul
            })
        }
    });
</script>
<?php endif; ?>
