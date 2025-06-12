<?php $session = session(); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Hamster</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #f8f9fa;">
    <div class="container py-5">
        <a href="<?= base_url('/dashboard') ?>" class="btn btn-secondary mb-3">&larr; Kembali</a>

        <div class="card mb-4">
            <div class="row g-0">
                <div class="col-md-5">
                    <img src="<?= base_url('uploads/' . $hamster['gambar']) ?>" class="img-fluid rounded-start" alt="<?= esc($hamster['jenis']) ?>">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h3 class="card-title"><?= esc($hamster['jenis']) ?></h3>
                        <h5 class="text-success mb-3">Rp <?= number_format($hamster['harga'], 0, ',', '.') ?></h5>
                        <p class="card-text"><strong>Stok:</strong> <?= $hamster['stok'] ?></p>
                        <p class="card-text"><?= esc($hamster['keterangan']) ?></p>

                        <?php if ($session->get('logged_in')) : ?>
                            <form action="<?= base_url('keranjang/tambah') ?>" method="post" class="mt-3">
                                <input type="hidden" name="id_produk" value="<?= $hamster['id_hamster'] ?>">
                                <input type="hidden" name="jenis_produk" value="hamster">
                                <input type="hidden" name="jumlah" value="1">
                                <button type="submit" class="btn btn-warning">Masukkan ke Keranjang</button>
                            </form>
                        <?php else : ?>
                            <a href="/login" class="btn btn-outline-warning mt-3">Login untuk Membeli</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
