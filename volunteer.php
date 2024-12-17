<?php
include './config/database.php'; // Pastikan koneksi database sudah benar
session_start();

if (isset($_SESSION['accountType']) != "volunteer") {
    header("Location: comp/error.html");
    exit();
}

if (isset($_POST["logout"])) {

    session_unset();
    session_destroy();
    header("location: ./index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MataHati</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <style>
        .local {
            width: 80px;
            height: 80px;
            background-color: #223344;
            top: 15px;
            right: 15px;
            z-index: 1;
        }

        .remote {
            width: 500px;
            height: 500px;
            background-color: #384552;
        }

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


    <div class="d-flex justify-content-center w-100 p-2">

        <div class="p-2 rounded shadow-lg position-relative">
            <div id="local" class="d-flex p-1 justify-content-center rounded position-absolute local shadow-lg "></div>
            <div id="remote" class="d-flex p-1 justify-content-center rounded remote shaow-lg "></div>
            <div class="d-flex justify-content-center">
                <i class="fa fa-video-camera" id="btnCam" aria-hidden="true "></i>
                <i class="fa fa-microphone " id="btnMic" aria-hidden="true "></i>
                <button class="call-volunteer-btn" id="btnPlug" onclick="window.location.href='videocall\index.html';">
                    Call Volunteer
                </button>
            </div>
        </div>

    </div>

</body>

</html>