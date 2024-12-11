<?php
session_start();
require_once "database.php";
$register_message = " ";
$success_message = "";

$_SESSION["isLogin"] = false;

if ($_SESSION["isLogin"]) {
    if ($_SESSION['accountType'] == "blind") {
        header("location: ../blind.php");
        exit;
    } else {
        header("location: ../volunteer.php");
        exit;
    }
}


if (isset($_POST['register'])) {
    $username = $_POST["name"];
    $email = $_POST["email"];
    $password = md5($_POST["password"]);
    $account_type = $_POST["account_type"];


    try {
        $sql = "INSERT INTO users (name,email,password,account_type) VALUES ('$username','$email','$password','$account_type')";

        if ($conn->query($sql)) {
            $success_message = "Daftar Akun Berhasil Silahkan Login";
        } else {
            $register_message = "Daftar Akun Gagal Silahkan Daftar Kembali";
        }
    } catch (mysqli_sql_exception) {
        $register_message = "Email sudah ada. Silahkan ganti yang lain";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Sign Up MataHati</title>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            background-color: #f4f4f4;
        }

        .signup-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .signup-box {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            padding: 30px;
        }

        .logo-container {
            text-align: center;
        }

        .logo-container img {
            max-width: 150px;
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
            .signup-container {
                justify-content: center;
            }

            .signup-box {
                width: 90%;
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- bg animate -->
    <?php include "../comp/bg-animation.html" ?>

    <section class="ftco-section bg-dark bg-gradient text-light " style="height: 100vh;">
        <div class="container ">
            <div class="row justify-content-center  animate__animated animate__fadeInDown">
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
                    <div class="signup-wrap p-0">
                        <h3 class="text-center">Don't Have an account?</h3>
                        <form method="POST" action="signup.php" class="align-middle rounded mt-3">
                            <input type="hidden" name="action" value="signup">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="nameSignup" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="emailSignup" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="passwordSignup" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="accountType" class="form-label">Account Type</label>
                                <select class="form-select" id="accountType" name="account_type" required>
                                    <option value="blind">Blind</option>
                                    <option value="volunteer">Volunteer</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" name="register">Signup</button>
                        </form>
                        <button class="switch-form ">
                            <a href="./login.php">Already have an account? Login</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>


    <script src="../assets/js/bootstrap.min.js"></script>
</body>
<?php if (isset($register_message) && $register_message != " "): ?>
    <script>
        Swal.fire({
            title: "Error! ",
            text: "<?= $register_message ?>",
            icon: "error"
        });
    </script>
<?php endif; ?>

<?php if (isset($success_message) && $success_message != ""): ?>
    <script>
        Swal.fire({
            title: "DAFTAR BERHASIL!!",
            text: "<?= $success_message ?>",
            icon: "success"
        }).then((result) => {
            if (result.isConfirmed) {
                // Mengarahkan pengguna ke halaman login setelah menekan tombol konfirmasi
                window.location.href = 'login.php';
            }
        });
    </script>
<?php endif; ?>

</html>