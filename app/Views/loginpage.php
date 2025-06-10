<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - Toko Langgan Hamster</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fffbea;
        }
        .card {
            max-width: 500px;
            margin: 60px auto;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            background-color: #fff3cd;
            border: 1px solid #ffeeba;
        }
        .form-label {
            font-weight: 500;
        }
    </style>

    <script>
        function cekPassword() {
            const msg = document.getElementById('feedback');
            const pwd = document.getElementById('pwd');
            if (pwd.value.length < 6) {
                msg.textContent = 'Password harus terdiri dari 6 karakter atau lebih';
            } else {
                msg.textContent = '';
            }
        }
    </script>
</head>
<body>
<div class="container">
    <div class="card p-4">

        <h2 class="text-center mb-4">Masuk Toko Langgan Hamster</h2>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"> <?= session()->getFlashdata('success') ?> </div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger">Username / Password Salah!</div>
        <?php endif; ?>

        <form method="post" action="/login">

            <div class="mb-3">
                <label for="user" class="form-label">Username</label>
                <input type="text" class="form-control" id="user" name="user" required>
            </div>

            <div class="mb-3">
                <label for="pwd" class="form-label">Password</label>
                <input type="password" class="form-control" id="pwd" name="pwd" onkeyup="cekPassword();" required>
                <div id="feedback" class="form-text text-danger"></div>
            </div>
            
            <div class="d-grid">
                <button type="submit" class="btn btn-warning">Masuk</button>
            </div>

        </form>

        <p class="mt-3 text-center">Belum mempunyai akun? <a href="/registrasi" class="btn btn-outline-dark btn-sm">Registrasi</a></p>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>