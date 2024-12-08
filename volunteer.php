<?php
include 'database.php'; // Pastikan koneksi database sudah benar
session_start();

if (!isset($_SESSION['accountType']) != "volunteer") {
    header("Location: comp/error.html");
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