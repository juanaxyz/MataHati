<?php
include './config/database.php'; // Pastikan koneksi database sudah benar
session_start();

$account_type = isset($_SESSION['accountType']);
// Memeriksa apakah pengguna sudah login
if ($account_type != "blind") {
    header("Location: comp/error.html");
    exit();
}

if (isset($_POST["logout"])) {
    session_unset();
    session_destroy();
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>MataHati</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=O4BwsMp0"></script>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .full-height {
            height: 100vh;
            display: flex;
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

        .active-users-panel {
            width: 30%;
            background-color: #f0f0f0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .volunteer-call-panel {
            width: 70%;
            background-color: #e6f2ff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .call-volunteer-btn {
            width: 80%;
            max-width: 600px;
            height: 400px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .call-volunteer-btn:hover {
            background-color: #2980b9;
        }

        /* Responsiveness */
        @media screen and (max-width: 768px) {
            .full-height {
                flex-direction: column;
            }

            .active-users-panel,
            .volunteer-call-panel {
                width: 100%;
                height: 50%;
            }

            .call-volunteer-btn {
                height: 200px;
                font-size: 18px;
                width: 90%;
            }
        }

        @media screen and (max-width: 480px) {
            .call-volunteer-btn {
                height: 150px;
                font-size: 16px;
            }
        }
    </style>
</head>

<body>

    <div class="logout-container">
        <form action="blind.php" method="POST" >
            <button type="submit" class="logout-btn" name="logout">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>

    <div class="full-height">
        <div class="active-users-panel" id="statusPanel">
            <p>Jumlah Pengguna Aktif: <span id="onlinePeople">5</span></p>
        </div>
        <div class="volunteer-call-panel">
            <button class="call-volunteer-btn" id="speakButton">
                Call Volunteer
            </button>
        </div>
    </div>

    <script src="./assets/js/bootstrap.min.js"></script>
    <script>
        function speak(text) {
            responsiveVoice.speak(text, "Indonesian Female");
        }

        document.getElementById('statusPanel').addEventListener('click', function() {
            const onlineCount = document.getElementById('onlinePeople').textContent;
            const text = `Jumlah orang online ada: ${onlineCount} pengguna`;
            speak(text);
        });

        document.getElementById('speakButton').addEventListener('click', function() {
            const text = "Melakukan Panggilan. Silahkan Tunggu...!";
            speak(text);
        });
    </script>
</body>

</html>