<?php
$Write = "<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
file_put_contents('UIDContainer.php', $Write);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Home : NodeMCU V3 ESP8266 / ESP12E with MYSQL Database</title>
    <script src="jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#getUID").load("UIDContainer.php");
            setInterval(function() {
                $("#getUID").load("UIDContainer.php");
            }, 500);
        });
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 1200px;
            margin: 0 auto;
        }

        nav {
            background: linear-gradient(to right, #ffffff 0%, #3498db 50%, #ffffff 100%);
            color: #fff;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline-block;
            margin-right: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #ffd700;
        }

        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            width: 100%;
            padding: 20px 0;
        }

        .welcome {
            margin-bottom: 20px;
        }

        .card-row {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            width: 100%;
            margin-top: 20px;
        }

        .card {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            width: 90%;
            max-width: 300px;
            margin: 10px;
            text-align: center;
        }

        .card h3 {
            margin-bottom: 15px;
        }

        .card p {
            margin-bottom: 20px;
            color: #333;
        }

        .btnn {
            display: block;
            text-align: center;
            margin: 0 auto;
            width: fit-content;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btnn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="registration.php">Registrasi</a></li>
                <li><a href="read tag.php">Absen</a></li>
            </ul>
        </nav>
    </div>
    <div class="container content">
        <div class="welcome">
            <h2>SELAMAT DATANG DI SISTEM ABSENSI SISWA BERBASIS RFID</h2>
        </div>
        <div class="card-row">
            <div class="card">
                <h3>Home</h3>
                <p>Sistem ini dirancang untuk
                    memudahkan transaksi di lingkungan
                    sekolah dan memberikan kemudahan
                    bagi siswa dan orang tua dalam
                    mengelola keuangan sehari-hari.</p>
                <a href="home.php" class="btnn">Home</a>
            </div>
            <div class="card">
                <h3>Registrasi</h3>
                <p>Registrasi dilakukan dengan
                    menempelkan kartu pelajar pada
                    alat pembaca RFID, kemudian
                    mengisi nama lengkap, jenis
                    kelamin, email, dan nomor HP
                    siswa dan chatID Telegram.</p>
                <a href="registration.php" class="btnn">Registrasi</a>
            </div>
            <div class="card">
                <h3>Absen</h3>
                <p>Halaman "Absen" digunakan untuk
                    melakukan absensi harian dengan
                    menempelkan kartu pelajar pada
                    alat pembaca RFID yang terhubung
                    dengan NodeMCU ESP8266.
                </p>
                <a href="read tag.php" class="btnn">Absen</a>
            </div>
        </div>
    </div>
</body>

</html>