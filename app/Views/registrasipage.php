<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registrasi - Toko Langgan Hamster</title>
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

        function cekPassword2() {
            const msg = document.getElementById('feedback2');
            const pwd2 = document.getElementById('pwd2');
            if (pwd2.value.length < 6) {
                msg.textContent = 'Password harus terdiri dari 6 karakter atau lebih';
            } else {
                msg.textContent = '';
            }
        }

        function verifForm() {
            const pwd = document.getElementById('pwd').value;
            const pwd2 = document.getElementById('pwd2').value;

            if (pwd.length < 6 || pwd2.length < 6) {
                alert('Password harus terdiri dari 6 karakter atau lebih');
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<div class="container">
    <div class="card p-4">

        <h2 class="text-center mb-4">Registrasi Toko Langgan Hamster</h2>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"> <?= session()->getFlashdata('error') ?> </div>
        <?php endif; ?>

        <form method="post" action="/registrasi" onsubmit="return verifForm();">
            
            <div class="mb-3">
                <label for="user" class="form-label">Username</label>
                <input type="text" class="form-control" id="user" name="user" required>
            </div>

            <div class="mb-3">
                <label for="pwd" class="form-label">Password</label>
                <input type="password" class="form-control" id="pwd" name="pwd" onkeyup="cekPassword();" required>
                <div id="feedback" class="form-text text-danger"></div>
            </div>

            <div class="mb-3">
                <label for="pwd2" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="pwd2" name="pwd2" onkeyup="cekPassword2();" required>
                <div id="feedback2" class="form-text text-danger"></div>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-warning">Registrasi</button>
            </div>

            <div class="text-center">
                <p>Sudah mempunyai akun? <a href="/login" class="btn btn-outline-secondary btn-sm">Login</a></p>
            </div>

        </form>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>