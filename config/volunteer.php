<?php
include 'database.php'; // Pastikan koneksi database sudah benar
session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    die("Anda harus login terlebih dahulu.");
}

// Mengambil data pengguna yang sedang login
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);

// Cek apakah query berhasil dan data ditemukan
if (!$result) {
    die("Query error: " . mysqli_error($conn));
}

$user = mysqli_fetch_assoc($result);

// Memeriksa apakah pengguna adalah tipe 'blind'
if (!$user) {
    die("Pengguna tidak ditemukan.");
}

if ($user['account_type'] != 'volunteer') {
    header("Location: ../comp/error.html");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MataHati</title>
</head>
<body>
    
</body>
</html>