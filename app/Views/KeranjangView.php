<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
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
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mb-4">Keranjang Belanja Anda</h2>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <?php if (empty($items_keranjang)): ?>
            <div class="alert alert-info text-center">Keranjang Anda kosong. Yuk, <a href="/home">mulai belanja</a>!</div>
        <?php else: ?>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total_belanja = 0;
                    $no = 1; ?>
                    <?php foreach ($items_keranjang as $item): ?>
                        <tr>
                            <th scope="row"><?= $no++ ?></th>
                            <td><img src="<?= base_url('uploads/' . $item['gambar_produk']) ?>" class="product-img" alt="<?= esc($item['nama_produk']) ?>"></td>
                            <td><?= esc($item['nama_produk']) ?></td>
                            <td>Rp <?= number_format($item['harga_saat_ini'], 0, ',', '.') ?></td>
                            <td><?= $item['jumlah'] ?></td>
                            <td>Rp <?= number_format($item['harga_saat_ini'] * $item['jumlah'], 0, ',', '.') ?></td>
                            <td>
                                <form action="<?= base_url('keranjang/hapus/' . $item['id']) ?>" method="post" style="display:inline;">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus item ini dari keranjang?');">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <?php $total_belanja += ($item['harga_saat_ini'] * $item['jumlah']); ?>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" class="text-end">Total Belanja</th>
                        <th colspan="2">Rp <?= number_format($total_belanja, 0, ',', '.') ?></th>
                    </tr>
                </tfoot>
            </table>
            <div class="d-flex justify-content-end mt-4">
                <a href="/home" class="btn btn-secondary me-2">Lanjut Belanja</a>
                <a href="/checkout" class="btn btn-warning">Lanjutkan ke Pembayaran</a>
            </div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>