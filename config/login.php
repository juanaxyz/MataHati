<?php
session_start();
include "./database.php";

$login_message = " ";
if (isset($_SESSION["isLogin"])) {
    if ($_SESSION['accountType'] == "blind") {
        header("location: ../blind.php");
        exit;
    } else {
        header("location: ../volunteer.php");
        exit;
    }
}
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = md5($_POST["password"]);

    $query  = "SELECT * FROM users WHERE email = '$email' AND password = '$password' ";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $_SESSION["username"] = $data["name"];
        $_SESSION["accountType"] = $data["account_type"];
        $_SESSION["isLogin"] = true;

        if ($data['account_type'] == "blind") {
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
</head>

<body>
    <!-- bg animate -->
    <?php include "../comp/bg-animation.html" ?>

    <section class="ftco-section bg-dark bg-gradient text-light" style="height: 100vh;">
        <div class="container ">
            <div class="row justify-content-center">
                <div class="logo-container text-light">
                    <img src="../assets/img/logo.png" alt="logo MataHati" />
                    <h2>MataHati</h2>
                    <p class="text-center">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    </p>
                </div>
            </div>
            <div class="row justify-content-center ">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center">Have an account?</h3>
                        <form action="login.php" method="POST">
                            <input type="hidden" name="action" value="login">
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
                            <a href="./signup.php">Don't have an account? Sign Up</a>
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