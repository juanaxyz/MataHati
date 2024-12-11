<?php
include './config/database.php'; // Pastikan koneksi database sudah benar
session_start();

if (isset($_SESSION['accountType']) != "volunteer") {
    header("Location: comp/error.html");
}

if (isset($_POST["logout"])) {

    session_unset();
    session_destroy();
    header("location: ./index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MataHati</title>

    <style>
        .logout-container {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 1000;
        }

        .logout-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
<div class="logout-container">
        <form action="volunteer.php" method="POST">
            <button type="submit" class="logout-btn" name="logout">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>

</body>
</html>