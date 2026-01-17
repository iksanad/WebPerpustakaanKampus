$(function () {
    $('.tombolTambahData').on('click', function () {
        $('#judulModal').html('Tambah Data Buku');
        $('.modal-footer button[type=submit]').html('Tambah Data');
        $('.modal-body form').attr('action', 'http://localhost:8080/WebPerpustakaanKampus/buku/tambah');
        $('#judul').val('');
        $('#pengarang').val('');
        $('#penerbit').val('');
        $('#tahun').val('');
        $('#stok').val('');
        $('#id').val('');
        $('#gambarLama').val('');
        $('#previewGambar').attr('src', '').addClass('d-none');
        $('#gambar').val('');
    });

    $('.modalUbah').on('click', function () {
        $('#judulModal').html('Ubah Data Buku');
        $('.modal-footer button[type=submit]').html('Ubah Data');
        $('.modal-body form').attr('action', 'http://localhost:8080/WebPerpustakaanKampus/buku/ubah');

        const id = $(this).attr('request-id');

        $.ajax({
            url: 'http://localhost:8080/WebPerpustakaanKampus/buku/getubah',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#judul').val(data.judul);
                $('#pengarang').val(data.pengarang);
                $('#penerbit').val(data.penerbit);
                $('#tahun').val(data.tahun);
                $('#stok').val(data.stok);
                $('#id').val(data.id);
                $('#gambarLama').val(data.gambar);
                if (data.gambar) {
                    $('#previewGambar').attr('src', 'http://localhost:8080/WebPerpustakaanKampus/public/img/' + data.gambar).removeClass('d-none');
                } else {
                    $('#previewGambar').attr('src', '').addClass('d-none');
                }
            }
        });
    });
});
