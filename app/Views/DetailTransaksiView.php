<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Transaksi</title>
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

        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mb-4">Detail Transaksi #<?= $transaksi['id'] ?></h2>
        <p><strong>Tanggal Transaksi:</strong> <?= date('d M Y H:i', strtotime($transaksi['tanggal_transaksi'])) ?></p>
        <p><strong>Total Pembayaran:</strong> Rp <?= number_format($transaksi['total_harga'], 0, ',', '.') ?></p>
        <p><strong>Status Pembayaran:</strong> <span class="badge bg-<?= ($transaksi['status_pembayaran'] == 'lunas' ? 'success' : 'warning') ?>"><?= esc(ucfirst($transaksi['status_pembayaran'])) ?></span></p>
        <p><strong>Metode Pembayaran:</strong> <?= esc($transaksi['metode_pembayaran']) ?></p>
        <p><strong>Alamat Pengiriman:</strong> <?= esc($transaksi['alamat_pengiriman']) ?></p>

        <h4 class="mt-4">Produk yang Dibeli:</h4>
        <?php if (empty($detail_items)): ?>
            <div class="alert alert-warning">Tidak ada detail produk untuk transaksi ini.</div>
        <?php else: ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Gambar</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga Satuan</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detail_items as $item): ?>
                        <tr>
                            <td><img src="<?= base_url('uploads/' . $item['gambar_produk']) ?>" class="product-img" alt="<?= esc($item['nama_produk']) ?>"></td>
                            <td><?= esc($item['nama_produk']) ?></td>
                            <td><?= $item['jumlah'] ?></td>
                            <td>Rp <?= number_format($item['harga_satuan'], 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <div class="mt-3">
            <a href="/transaksi" class="btn btn-secondary">Kembali ke Riwayat Transaksi</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>