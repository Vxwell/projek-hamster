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
            background-color: #f8f9fa;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidebar a {
            padding: 15px;
            display: block;
            color: #333;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #e9ecef;
            color: #0d6efd;
        }

        .content {
            flex: 1;
            padding: 30px;
            background-color: #f1f3f5;
        }

        .active {
            background-color: #0d6efd !important;
            color: white !important;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center">🐹 HamsterApp</h4>
        <a href="#" class="active" onclick="showSection('jenis')">Jenis Hamster</a>
        <a href="#" onclick="showSection('peralatan')">Peralatan</a>
        <a href="#" onclick="showSection('tentang')">Tentang Aplikasi</a>
        <a href="#" onclick="showSection('bantuan')">Bantuan</a>
    </div>

    <!-- Content -->
    <div class="content">
        <div id="jenis">
            <h2>Jenis Hamster</h2>
            <p>Beberapa jenis hamster yang populer: Syrian, Roborovski, Campbell, Winter White, dan Chinese.</p>
        </div>
        <div id="peralatan" style="display:none;">
            <h2>Peralatan</h2>
            <p>Kandang, roda putar, botol minum, tempat makan, dan serbuk kayu adalah peralatan dasar untuk hamster.</p>
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

    <!-- Bootstrap JS and JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showSection(section) {
            const sections = ['jenis', 'peralatan', 'tentang', 'bantuan'];
            sections.forEach(id => {
                document.getElementById(id).style.display = id === section ? 'block' : 'none';
            });

            // update active class
            document.querySelectorAll('.sidebar a').forEach(a => a.classList.remove('active'));
            event.target.classList.add('active');
        }
    </script>

</body>
</html>
