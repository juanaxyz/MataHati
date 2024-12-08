
<?php
session_start();
include "./database.php";

$login_message = " ";

if(isset($_POST["login"])){
    $email = $_POST["email"];
    $password = md5($_POST["password"]);

    $query  = "SELECT * FROM users WHERE email = '$email' AND password = '$password' ";
    $result = $conn ->query($query);

    if($result -> num_rows > 0){
        $data = $result -> fetch_assoc();
        $_SESSION["username"] = $data["name"];
        $_SESSION["accountType"] = $data["account_type"];
        $_SESSION["isLogin"] = true;

        if($data['account_type'] == "blind"){
            header("location: ../blind.php");
            exit;
        }else{
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

</head>

<body>

    <!-- bg animate -->
    <?php include "../comp/bg-animation.html" ?>

    <div class="row" style="height: 100vh;">
        <div class="col-5 bg-dark bg-gradient logo-container text-light">
            <img src="../assets/img/logo.png" alt="logo MataHati" class="col-5">
            <h2>MataHati</h2>
            <span class="col-7">Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio provident voluptas corrupti quia laudantium mollitia?</span>
        </div>

        <!-- login form -->
        <div class=" col-7 h-100 d-flex justify-content-center align-items-center" id="loginform">
            <div class="col-5">
                <h2>Login into MataHati</h2>
                <span>Enter your login details below</span>

                
                <form class="align-middle rounded mt-3" action="login.php" method="POST">
                    <input type="hidden" name="action" value="login">
                    <div class="mb-2">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="emailLogin" aria-describedby="emailHelp" placeholder="example@mail.com" required>
                    </div>
                    <div class="mb-2 ">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="passwordLogin" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="login">Submit</button>
                </form>
                <button class="switch-form"><a href="./signup.php">Didn't have an account? Sign-Up here</a></button>
            </div>
        </div>
    </div>
</body>
<script src="../assets/js/bootstrap.min.js"></script>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if (isset($login_message) && $login_message != ""): ?>
                Swal.fire({
                    title: "Error! ",
                    text: "<?= $login_message ?> cek kembali kata sandi dan password anda",
                    icon: "error"
                });

            <?php endif; ?>
        });
    </script>

</html>