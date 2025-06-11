<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Hamster</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: rgb(253, 177, 13);
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidebar h4 {
            padding: 10px;
            color: white;
            background-color: rgb(253, 129, 13);
            margin-bottom: 20px;
        }

        .sidebar a {
            padding: 15px;
            display: block;
            color: #333;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: rgb(255, 222, 36);
            color: rgb(0, 0, 0);
        }

        .content {
            flex: 1;
            padding: 30px;
            background-color: #f1f3f5;
        }

        .active {
            background-color: rgb(255, 222, 36) !important;
            color: white !important;
        }

        /* Responsif untuk mobile */
        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                display: flex;
                flex-direction: row;
                justify-content: space-around;
                padding: 10px 0;
            }

            .sidebar a {
                padding: 10px;
                text-align: center;
                flex: 1;
            }

            .sidebar h4 {
                display: none;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center">Hamster Langgan</h4>
        <a href="#" onclick="showSection('jenis', event)">Jenis Hamster</a>
        <a href="#" onclick="showSection('peralatan', event)">Kebutuhan Hamster</a>
        <a href="#" onclick="showSection('tentang', event)">Tentang Aplikasi</a>
        <a href="#" onclick="showSection('bantuan', event)">Bantuan</a>
    </div>


    <!-- Content -->
    <div class="content">

        <!-- Carousel -->
<div id="hamsterCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?= base_url('uploads/slider1.png') ?>" class="d-block w-100" alt="slider1" style="height: 300px; object-fit: cover;">
    </div>
    <div class="carousel-item">
      <img src="<?= base_url('uploads/slider2.png') ?>" class="d-block w-100" alt="slider2" style="height: 300px; object-fit: cover;">
    </div>
    <div class="carousel-item">
      <img src="<?= base_url('uploads/slider3.png') ?>" class="d-block w-100" alt="slider3" style="height: 300px; object-fit: cover;">
    </div>
    <div class="carousel-item">
      <img src="<?= base_url('uploads/slider4.png') ?>" class="d-block w-100" alt="slider4" style="height: 300px; object-fit: cover;">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#hamsterCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#hamsterCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

        <div id="jenis">
    <h2 class="mb-3">Daftar Jenis Hamster</h2>
    <div class="row row-cols-2 row-cols-md-4 g-3">
        <?php foreach ($hamster as $h) : ?>
            <div class="col">
                <div class="card h-100">
                    <img src="<?= base_url('uploads/' . $h->gambar) ?>" class="card-img-top" alt="<?= esc($h->jenis) ?>">
                    <div class="card-body p-2">
                        <h5 class="card-title" style="font-size: 1rem;"><?= esc($h->jenis) ?></h5>
                        <p class="card-text" style="font-size: 0.9rem;">Rp <?= number_format($h->harga, 0, ',', '.') ?></p>
                        <p class="card-text" style="font-size: 0.85rem;">Stok: <?= $h->stok ?></p>
                        <a href="#" class="btn btn-sm btn-warning">Masukkan Keranjang</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<div id="peralatan" style="display:none;">
    <h2 class="mb-3">Daftar Peralatan Hamster</h2>
    <div class="row row-cols-2 row-cols-md-4 g-3">
        <?php foreach ($peralatan as $p) : ?>
            <div class="col">
                <div class="card h-100">
                    <img src="<?= base_url('uploads/' . $p['gambar']) ?>" class="card-img-top" alt="<?= esc($p['nama']) ?>">
                    <div class="card-body p-2">
                        <h5 class="card-title" style="font-size: 1rem;"><?= esc($p['nama']) ?></h5>
                        <p class="card-text" style="font-size: 0.9rem;">Rp <?= number_format($p['harga'], 0, ',', '.') ?></p>
                        <a href="#" class="btn btn-sm btn-warning">Masukkan Keranjang</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


        <div id="tentang" style="display:none;">
            <h2>Tentang Aplikasi</h2>
            <p>Aplikasi ini dirancang untuk membantu pecinta hamster dalam mengenal jenis dan cara perawatannya.</p>
        </div>
        <div id="bantuan" style="display:none;">
            <h2>Bantuan</h2>
            <p>Untuk bantuan, silakan hubungi admin atau buka menu bantuan di bagian pengaturan.</p>
        </div>
    </div>

    <!-- Bootstrap JS dan Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showSection(section, event) {
            const sections = ['jenis', 'peralatan', 'tentang', 'bantuan'];
            sections.forEach(id => {
                document.getElementById(id).style.display = id === section ? 'block' : 'none';
            });

            // Update class aktif
            document.querySelectorAll('.sidebar a').forEach(a => a.classList.remove('active'));
            event.target.classList.add('active');
        }
    </script>

</body>
</html>
