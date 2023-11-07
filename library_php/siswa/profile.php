<?php
session_start(); // Mulai sesi
include "koneksi.php"; // Sertakan file koneksi

if (!isset($_SESSION['username'])) {
    // Redirect ke halaman login jika sesi tidak aktif
    header('location:login.php');
}

$username = $_SESSION['username']; // Ambil username dari sesi
$petugas = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username='$username'");
$data = mysqli_fetch_array($petugas);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Profil Petugas</title>
    <link rel="icon" href="lib.png" type="image/x-icon">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #007BFF; /* Warna latar belakang baru */
            color: #fff; /* Warna teks */
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h1 {
            color: #fff; /* Warna teks judul */
            margin: 20px 0; /* Atur margin atas dan bawah untuk pusatkan teks */
        }

        p {
            font-size: 18px;
            margin: 10px 0;
        }

        a {
            display: inline-block;
            background-color: #0056b3; /* Warna tombol saat dihover */
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #004187; /* Warna tombol saat dihover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>ㅤProfile Petugas</h1>
        <hr style="border: 1px solid #fff; margin: 0px;"> <!-- Garis putih sebagai pembatas -->
        <p>Username: <?php echo $data['username']; ?></p>
        <p>Nama: <?php echo $data['nama_petugas']; ?></p>
        <!-- Tambahkan tombol kembali ke dashboard.php -->
        <a href="/siswa/index.php?">Dashboard</a>
        <a href="logout.php">Logout</a> <!-- Tambahkan tautan logout jika diperlukan -->
    </div>
</body>
</html>
