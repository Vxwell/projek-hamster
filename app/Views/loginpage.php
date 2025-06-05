<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>

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
</head>
<body>

    <h1 style="margin-bottom: 80px;">Toko Langgan Hamster</h1>

    <Form method="post" action="/login">
        <table>
            <tr>
                <td>
                    <?php if ( isset($error) ) : ?>
                        <p style="color: red; font-style: italic;">Username / Password Salah!</p>
                    <?php endif; ?>

                    <h1 style="margin-bottom: 50px;">Masuk Ke Toko Langgan Hamster</h1>
                    <div class="align-label">
                        <label for="user" style="font-size: 20px;">Username:</label>
                        <input name="user" id="user" type="text" style="font-size: 20px; width: 75%;">
                    </div>
                    <div class="align-label">
                        <label for="pwd" style="font-size: 20px;">Password:</label>
                        <input name="pwd" id="pwd" type="password" style="font-size: 20px; width: 75%; margin-bottom: 30px;">
                    </div>
                    <div style="text-align: center;">
                        <input name="submit" type="submit" value="Masuk" style="font-size: 20px; width: 45%;">
                    </div>
                </td>
            </tr>
        </table>
    </form>
    
</body>
</html>