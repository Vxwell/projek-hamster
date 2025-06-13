<?php $session = session(); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Hamster</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { min-height: 100vh; display: flex; }
        .sidebar { width: 250px; background-color: rgb(253, 177, 13); padding-top: 20px; box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); }
        .sidebar h4 { padding: 10px; color: white; background-color: rgb(253, 129, 13); margin-bottom: 20px; }
        .sidebar a { padding: 15px; display: block; color: #333; text-decoration: none; }
        .sidebar a:hover { background-color: rgb(255, 222, 36); color: rgb(0, 0, 0); }
        .content { flex: 1; padding: 30px; background-color: #f1f3f5; }
        .active { background-color: rgb(255, 222, 36) !important; color: white !important; }
        @media (max-width: 768px) {
            body { flex-direction: column; }
            .sidebar { width: 100%; display: flex; flex-direction: row; justify-content: space-around; padding: 10px 0; }
            .sidebar a { padding: 10px; text-align: center; flex: 1; }
            .sidebar h4 { display: none; }
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h4 class="text-center">Hamster Langgan</h4>
        <div class="d-flex justify-content-center gap-2 mb-2">
            <?php if ($session->get('logged_in')) : ?>
                <span class="text-dark fw-bold"><?= esc($session->get('username')) ?></span>
            <?php else : ?>
                <a href="/registrasi">Register</a>
                <div style="width: 1px; height: 48px; background-color: #000;"></div>
                <a href="/login">Login</a>
            <?php endif; ?>
        </div>
        <a href="#" onclick="showSection('jenis', event)">Jenis Hamster</a>
        <a href="#" onclick="showSection('peralatan', event)">Kebutuhan Hamster</a>
        <?php if ($session->get('logged_in')) : ?>
            <a href="/keranjang">Keranjang Belanja</a>
            <a href="/transaksi">Riwayat Transaksi</a>
        <?php endif; ?>
        <a href="#" onclick="showSection('tentang', event)">Tentang Aplikasi</a>
        <a href="#" onclick="showSection('bantuan', event)">Bantuan</a>
        <?php if ($session->get('logged_in')) : ?>
            <div class="mt-4 text-center">
                <a href="/logout" class="btn btn-danger btn-sm">Logout</a>
            </div>
        <?php endif; ?>
    </div>

    <div class="content">

        <!-- Carousel -->
        <div id="hamsterCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php for ($i = 1; $i <= 4; $i++) : ?>
                    <div class="carousel-item <?= $i == 1 ? 'active' : '' ?>">
                        <img src="<?= base_url("uploads/slider$i.png") ?>" class="d-block w-100" alt="slider<?= $i ?>" style="height: 300px; object-fit: cover;">
                    </div>
                <?php endfor; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#hamsterCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#hamsterCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>

        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"> <?= session()->getFlashdata('success') ?> </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"> <?= session()->getFlashdata('error') ?> </div>
        <?php endif; ?>

        <!-- Jenis Hamster -->
        <div id="jenis">
            <h2 class="mb-3">Daftar Jenis Hamster</h2>
            <div class="row row-cols-2 row-cols-md-4 g-3">
                <?php foreach ($hamster as $h) : ?>
                    <div class="col">
                        <div class="card h-100">
                            <a href="<?= base_url('hamster/detail/' . $h->id_hamster) ?>">
                                <img src="<?= base_url('uploads/' . $h->gambar) ?>" class="card-img-top" alt="<?= esc($h->jenis) ?>">
                            </a>
                            <div class="card-body p-2">
                                <h5 class="card-title" style="font-size: 1rem;">
                                    <a href="<?= base_url('hamster/detail/' . $h->id_hamster) ?>" class="text-decoration-none text-dark">
                                        <?= esc($h->jenis) ?>
                                    </a>
                                </h5>
                                <p class="card-text" style="font-size: 0.9rem;">Rp <?= number_format($h->harga, 0, ',', '.') ?></p>
                                <p class="card-text" style="font-size: 0.85rem;">Stok: <?= $h->stok ?></p>
                                <?php if ($session->get('logged_in')) : ?>
                                    <form action="<?= base_url('keranjang/tambah') ?>" method="post">
                                        <input type="hidden" name="id_produk" value="<?= $h->id_hamster ?>">
                                        <input type="hidden" name="jenis_produk" value="hamster">
                                        <input type="hidden" name="jumlah" value="1">
                                        <button type="submit" class="btn btn-sm btn-warning">Masukkan Keranjang</button>
                                    </form>
                                <?php else : ?>
                                    <a href="/login" class="btn btn-sm btn-outline-warning">Login untuk Beli</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Peralatan -->
        <div id="peralatan" style="display:none;">
            <h2 class="mb-3">Daftar Peralatan Hamster</h2>
            <div class="row row-cols-2 row-cols-md-4 g-3">
                <?php foreach ($peralatan as $p) : ?>
                    <div class="col">
                        <div class="card h-100">
                            <a href="<?= base_url('kebutuhan/detail/' . $p['id']) ?>">
                                <img src="<?= base_url('uploads/' . $p['gambar']) ?>" class="card-img-top" alt="<?= esc($p['nama']) ?>">
                            </a>
                            <div class="card-body p-2">
                                <h5 class="card-title" style="font-size: 1rem;">
                                    <a href="<?= base_url('kebutuhan/detail/' . $p['id']) ?>" class="text-decoration-none text-dark">
                                        <?= esc($p['nama']) ?>
                                    </a>
                                </h5>
                                <p class="card-text" style="font-size: 0.9rem;">Rp <?= number_format($p['harga'], 0, ',', '.') ?></p>
                                <p class="card-text" style="font-size: 0.85rem;">Stok: <?= $p['stok'] ?></p>

                                <?php if ($session->get('logged_in')) : ?>
                                    <form action="<?= base_url('keranjang/tambah') ?>" method="post">
                                        <input type="hidden" name="id_produk" value="<?= $p['id'] ?>">
                                        <input type="hidden" name="jenis_produk" value="kebutuhan">
                                        <input type="hidden" name="jumlah" value="1">
                                        <button type="submit" class="btn btn-sm btn-warning">Masukkan Keranjang</button>
                                    </form>
                                <?php else : ?>
                                    <a href="/login" class="btn btn-sm btn-outline-warning">Login untuk Beli</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Tentang -->
        <div id="tentang" style="display:none;">
            <h2>Tentang Aplikasi</h2>
            <p>Aplikasi ini dirancang untuk membantu pecinta hamster dalam mengenal jenis dan cara perawatannya.</p>
            <p>Aplikasi ini dibuat oleh mahasiswa Sanata Dharma yang bernama Chandra sang jagoan jaringan terkuat.</p>
        </div>

        <!-- Bantuan -->
        <div id="bantuan" style="display:none;">
            <h2>Bantuan</h2>
            <p>Untuk bantuan, silakan hubungi admin atau buka menu bantuan di bagian pengaturan.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showSection(section, event) {
            const sections = ['jenis', 'peralatan', 'tentang', 'bantuan'];
            sections.forEach(id => {
                document.getElementById(id).style.display = id === section ? 'block' : 'none';
            });

            document.querySelectorAll('.sidebar a').forEach(a => a.classList.remove('active'));
            if (event && !event.target.getAttribute('href').startsWith('/')) {
                event.target.classList.add('active');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const jenisLink = document.querySelector('.sidebar a[onclick*="showSection(\'jenis\')"]');
            if (jenisLink) jenisLink.classList.add('active');
        });
    </script>
</body>

</html>
