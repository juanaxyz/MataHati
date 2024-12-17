<?php
session_start();
include ".\database.php";

$_SESSION["isLogin"] = false;

$login_message = " ";
if ($_SESSION["isLogin"]) {
    if ($_SESSION['accountType'] == "blind") {
        header("location: ../blind.php");
        exit;
    } else {
        header("location: ../volunteer.php");
        exit;
    }
}

// Fungsi untuk mendapatkan lokasi dari IP
function dapatkanLokasiDariIP()
{
    $ip = $_SERVER['REMOTE_ADDR'];
    $geolokasi = @file_get_contents("https://ipapi.co/{$ip}/json/");

    if ($geolokasi) {
        $data = json_decode($geolokasi, true);
        return [
            'latitude' => $data['latitude'] ?? null,
            'longitude' => $data['longitude'] ?? null
        ];
    }

    return null;
}

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = md5($_POST["password"]);

    // Tambahan lokasi dari parameter POST
    $latitude = $_POST["latitude"] ?? null;
    $longitude = $_POST["longitude"] ?? null;

    $query  = "SELECT * FROM users WHERE email = '$email' AND password = '$password' ";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $_SESSION["userID"] = $data["id"];
        $_SESSION["accountType"] = $data["account_type"];
        $_SESSION["isLogin"] = true;

        // Update lokasi user
        if ($latitude && $longitude) {
            $update_lokasi_query = "UPDATE users SET latitude = ?, longitude = ? WHERE id = ?";
            $stmt = $conn->prepare($update_lokasi_query);
            $stmt->bind_param("ddi", $latitude, $longitude, $data["id"]);
            $stmt->execute();
        } else {
            // Jika tidak ada lokasi dari browser, gunakan IP
            $lokasi = dapatkanLokasiDariIP();
            if ($lokasi) {
                $update_lokasi_query = "UPDATE users SET latitude = ?, longitude = ? WHERE id = ?";
                $stmt = $conn->prepare($update_lokasi_query);
                $stmt->bind_param("ddi", $lokasi['latitude'], $lokasi['longitude'], $data["id"]);
                $stmt->execute();
            }
        }

        if ($_SESSION["accountType"] == "blind") {
            header("location: ../blind.php");
            exit;
        } else {
            header("location: ../volunteer.php");
            exit;
        }
    }
    $login_message = "akun tidak ditemukan";
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login MataHati</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            background-color: #f4f4f4;
        }

        .login-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-box {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            padding: 30px;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-container img {
            max-width: 150px;
            margin-bottom: 15px;
        }

        .switch-form {
            display: block;
            text-align: center;
            margin-top: 15px;
            background: none;
            border: none;
        }

        .switch-form a {
            color: #007bff;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .login-container {
                justify-content: center;
            }

            .login-box {
                width: 90%;
                max-width: 100%;
            }
        }
    </style>

    <script>
        function dapatkanLokasi() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(posisi) {
                    // Simpan latitude dan longitude ke input tersembunyi
                    document.getElementById('latitudeInput').value = posisi.coords.latitude;
                    document.getElementById('longitudeInput').value = posisi.coords.longitude;
                }, function(error) {
                    // Jika gagal, biarkan input kosong
                    console.log("Gagal mendapatkan lokasi: " + error.message);
                });
            } else {
                console.log('Geolokasi tidak didukung');
            }
        }

        // Panggil fungsi dapatkanLokasi saat halaman dimuat
        window.onload = dapatkanLokasi;
    </script>
</head>

<body>
    <!-- bg animate -->
    <?php include "../comp/bg-animation.html" ?>
    <section class="ftco-section bg-dark bg-gradient text-light" style="height: 100vh;">
        <div class="container ">
            <div class="row justify-content-center animate__animated animate__fadeInDown">
                <div class="logo-container text-light">
                    <img src="../assets/img/logo.png" alt="logo MataHati" />
                    <h2>MataHati</h2>
                    <p class="text-center">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    </p>
                </div>
            </div>
            <div class="row justify-content-center animate__animated animate__fadeInUp">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center">Have an account?</h3>
                        <form action="login.php" method="POST">
                            <input type="hidden" name="action" value="login">
                            <input type="hidden" id="latitudeInput" name="latitude">
                            <input type="hidden" id="longitudeInput" name="longitude">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="emailLogin"
                                    aria-describedby="emailHelp" placeholder="example@mail.com" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="passwordLogin"
                                    placeholder="Enter your password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" name="login">Login</button>
                        </form>
                        <div class="switch-form">
                            <a href="signup.php">Don't have an account? Sign Up</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <script src="../assets/js/bootstrap.min.js"></script>
</body>

<?php if (isset($login_message) && $login_message != " "): ?>
    <script>
        Swal.fire({
            title: "Error! ",
            text: "<?= $login_message ?> cek kembali kata sandi dan password anda",
            icon: "error"
        });
    </script>
<?php endif; ?>

</html>