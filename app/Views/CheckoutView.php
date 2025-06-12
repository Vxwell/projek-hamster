<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f1f3f5;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mb-4">Konfirmasi Pembayaran</h2>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <?php if (empty($items_keranjang)): ?>
            <div class="alert alert-warning">Keranjang Anda kosong atau terjadi kesalahan. <a href="/keranjang">Lihat Keranjang</a></div>
        <?php else: ?>
            <h4>Detail Pesanan:</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items_keranjang as $item): ?>
                        <tr>
                            <td><?= esc($item['nama_produk']) ?></td>
                            <td><?= $item['jumlah'] ?></td>
                            <td>Rp <?= number_format($item['harga_saat_ini'], 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($item['harga_saat_ini'] * $item['jumlah'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Total Pembayaran</th>
                        <th>Rp <?= number_format($total_harga, 0, ',', '.') ?></th>
                    </tr>
                </tfoot>
            </table>

            <h4 class="mt-4">Metode Pembayaran (Simulasi)</h4>
            <p>Anda akan melanjutkan ke simulasi pembayaran. Setelah konfirmasi, pesanan akan dianggap lunas.</p>

            <form action="<?= base_url('checkout/proses') ?>" method="post">
                <h4 class="mt-4">Informasi Pengiriman</h4>
                <div class="mb-3">
                    <label for="nama_penerima" class="form-label">Nama Penerima</label>
                    <input type="text" class="form-control" id="nama_penerima" name="nama_penerima" required>
                </div>
                <div class="mb-3">
                    <label for="no_hp" class="form-label">Nomor HP</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                </div>
                <div class="mb-3">
                    <label for="alamat_pengiriman" class="form-label">Alamat Pengiriman</label>
                    <textarea class="form-control" id="alamat_pengiriman" name="alamat_pengiriman" rows="3" required></textarea>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="/keranjang" class="btn btn-secondary me-2">Kembali ke Keranjang</a>
                    <button type="submit" class="btn btn-success">Bayar Sekarang</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>