<?php
session_start();
require_once "database.php";
$register_message = "";

if (isset($_POST['register'])) {
    $username = $_POST["name"];
    $email = $_POST["email"];
    $password = md5($_POST["password"]);
    $account_type = $_POST["account_type"];


    try {
        $sql = "INSERT INTO users (name,email,password,account_type) VALUES ('$username','$email','$password','$account_type')";

        if ($conn->query($sql)) {
            $register_message = "Daftar Akun Berhasil Silahkan Login";
            header("location: login.php");
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
    <title>Sign Up MataHati</title>
</head>

<body>
    <?php include "../comp/bg-animation.html" ?>

    <div class="row" style="height: 100vh;">
        <div class="col-5 bg-dark bg-gradient logo-container text-light">
            <img src="../assets/img/logo.png" alt="logo MataHati" class="col-5">
            <h2>MataHati</h2>
            <span class="col-7">Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio provident voluptas corrupti quia laudantium mollitia?</span>
        </div>

        <!-- sign-up -->
        <div class="active col-7 h-100 d-flex justify-content-center align-items-center" id="signupform">
            <div class="col-5">
                <h2>Sign-Up into MataHati</h2>
                <span>Enter your sign-up details below</span>

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
                    <button type="submit" class="btn btn-primary" name="register">Submit</button>
                </form>
                <button class="switch-form"><a href="./login.php">Already have an account? Login</a></button>
            </div>
        </div>
    </div>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (isset($register_message) && $register_message != ""): ?>
            Swal.fire({
                title: "Error! ",
                text: "<?= $register_message ?>",
                icon: "error"
            });

        <?php endif; ?>
    });
</script>

</html>