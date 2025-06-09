<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registrasi</title>

    <style>
        /* Agar body memenuhi seluruh tinggi layar dan menggunakan flexbox */
        body {
            height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;     /* arah vertikal */
            justify-content: center; /* horizontal center */
            align-items: center;     /* vertikal center */
        }
        table{
            border: 1px;
            color: solid black;
            border-collapse: collapse;
            margin: auto; /* agar di tengah layar */
        }
        td{
            border: 5px solid black;
            padding: 15px; /* agar tidak menabrak garis tabel  */
        }
        h1{
            font-size: 36px;
            text-align: center;
            margin-bottom: 20px; /* Jarak antar elemen */
        }
        .align-label {
            display: flex;
            align-items: start;
            margin-bottom: 10px;
            gap: 10px; /* jarak antara label dan input */
        }
        label{
            width: 100px;
        }
    </style>

    <script type="text/javascript">
      function cekPassword() {
      var msg = document.getElementById('feedback');
      var pwd = document.getElementById('pwd');
      if (pwd.value.length < 6) {
        msg.textContent = 'Password harus terdiri dari 6 karakter atau lebih';
      } else {
        msg.textContent = '';
      }
    }

    function cekPassword2() {
      var msg = document.getElementById('feedback2');
      var pwd2 = document.getElementById('pwd2');
      if (pwd2.value.length < 6) {
        msg.textContent = 'Password harus terdiri dari 6 karakter atau lebih';
      } else {
        msg.textContent = '';
      }
    }

    function verifForm() {
        const pwd = document.getElementById('pwd').value;
        const pwd2 = document.getElementById('pwd2').value;

        if (pwd.length < 6) {
            alert('Password harus terdiri dari 6 karakter atau lebih');
            return false; // mencegah submit
        }
        if (pwd2.length < 6) {
            alert('Password harus terdiri dari 6 karakter atau lebih');
            return false; // mencegah submit
        }

        return true;
    }

    </script>
    
</head>
<body>
    <?php if (session()->getFlashdata('error')): ?>
        <script>
            alert("<?= session()->getFlashdata('error') ?>");
        </script>
    <?php endif; ?>

    <h1 style="margin-bottom: 80px;">Toko Langgan Hamster</h1>

    <Form method="post" action="/registrasi" onsubmit="return verifForm();">
        <table>
            <tr>
                <td>

                    <h1 style="margin-bottom: 50px;">Registrasi Ke Toko Langgan Hamster</h1>
                    <div class="align-label">
                        <label for="user" style="font-size: 20px;">Username:</label>
                        <input name="user" id="user" type="text" style="font-size: 20px; width: 75%;">
                    </div>
                    
                    <div class="align-label">
                        <label for="pwd" style="font-size: 20px;">Password:</label>
                        <input name="pwd" id="pwd" type="password" onkeypress="cekPassword();" style="font-size: 20px; width: 75%;">
                    </div>
                    <div id="feedback" style="color: red; font-style: italic; font-size: 16px; margin-left: 110px; margin-bottom: 30px;"></div>

                    <div class="align-label">
                        <label for="pwd2" style="font-size: 20px;">Konfirmasi Password:</label>
                        <input name="pwd2" id="pwd2" type="password" onkeypress="cekPassword2();" style="font-size: 20px; width: 75%;">
                    </div>
                    <div id="feedback2" style="color: red; font-style: italic; font-size: 16px; margin-left: 110px; margin-bottom: 30px;"></div>

                    <div style="text-align: center;">
                        <input name="submit" type="submit" value="Registrasi" style="font-size: 20px; width: 45%;">
                    </div>

                </td>
            </tr>
        </table>
    </form>
    
</body>
</html>