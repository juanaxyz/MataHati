<?php
// Memulai sesi
session_start();
require_once "./database.php";


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['action']) && $_POST['action'] === 'signup') {
        // Proses Sign-Up
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = md5($_POST['password']); // MD5 hashing
        $account_type = $_POST['account_type'];

        $stmt = $conn->prepare("INSERT INTO users (name,email, password, account_type) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss",$name, $email, $password, $account_type);

        if ($stmt->execute()) {
            // Simpan data sementara di session untuk aktivitas
            $_SESSION['signup_email'] = $email;
            $_SESSION['signup_account_type'] = $account_type;
            // Redirect to daily activities form
            header("Location: ../comp/dailyActivities.php"); // Change to your actual page
            exit();
        } else {
            echo "<script>alert('Gagal membuat akun. Email mungkin sudah terdaftar.');</script>";
        }
    }

    if (isset($_POST['action']) && $_POST['action'] === 'login') {
        // Proses Login
        $email = $_POST['email'];
        $password = md5($_POST['password']); // MD5 hashing

        $stmt = $conn ->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if ($password == $user['password']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['account_type'] = $user['account_type'];

                if ($user['account_type'] == 'blind') {
                    header("Location: blind.php");
                } else {
                    header("Location: volunteer.php");
                }
                exit();
            } else {
                echo "<script>alert('Email atau password salah.');</script>";
            }
        } else {
            echo "<script>alert('Email tidak ditemukan.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MataHati</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>
    <!-- bg animate -->
    <div>
        <div class='light x1'></div>
        <div class='light x2'></div>
        <div class='light x3'></div>
        <div class='light x4'></div>
        <div class='light x5'></div>
        <div class='light x6'></div>
        <div class='light x7'></div>
        <div class='light x8'></div>
        <div class='light x9'></div>
    </div>

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
                <form method="POST" action="" id="signup-form">
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
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <button class="switch-form" onclick="switchForm('loginForm')">Already have an account? Login</button>
            </div>
        </div>


        <!-- login form -->
        <div class="d-none col-7 h-100 d-flex justify-content-center align-items-center" id="loginform">
    <div class="col-5">
        <h2>Login into MataHati</h2>
        <span>Enter your login details below</span>
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error_message) ?>
            </div>
        <?php endif; ?>
        <form class="align-middle rounded mt-3" action="" method="POST">
            <input type="hidden" name="action" value="login">
            <div class="mb-2">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="emailLogin" aria-describedby="emailHelp" placeholder="example@mail.com" required>
            </div>
            <div class="mb-2 ">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="passwordLogin" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <button class="switch-form" onclick="switchForm('signupform')">Didn't have an account? Sign-Up here</button>
    </div>
</div>
    </div>
</body>
<script src="../assets/js/bootstrap.min.js"></script>
<script>
   //buat script disini
   function switchForm(targetForm) {
    const signupForm = document.getElementById('signupform');
    const loginForm = document.getElementById('loginform');

    // Add exit animation to current active form
    const activeForm = document.querySelector('.active');
    activeForm.classList.add('form-exit');

    // Remove exit animation and switch forms after transition
    setTimeout(() => {
        activeForm.classList.remove('active', 'form-exit');
        activeForm.classList.add('d-none');

        if (targetForm === 'loginForm') {
            loginForm.classList.remove('d-none');
            loginForm.classList.add('active', 'form-enter');
        } else {
            signupForm.classList.remove('d-none');
            signupForm.classList.add('active', 'form-enter');
        }

        // Remove enter animation after transition
        setTimeout(() => {
            document.querySelector('.form-enter').classList.remove('form-enter');
        }, 500);
    }, 500);
}

function showDailyActivities() {
    const signupForm = document.getElementById('signupform');
    const dailyActivitiesForm = document.getElementById('dailyActivitiesForm');

    signupForm.classList.add('form-exit');

    setTimeout(() => {
        signupForm.classList.remove('active', 'form-exit');
        signupForm.classList.add('d-none');
        dailyActivitiesForm.classList.remove('d-none');
        dailyActivitiesForm.classList.add('active', 'form-enter');

        setTimeout(() => {
            document.querySelector('.form-enter').classList.remove('form-enter');
        }, 500);
    }, 500);
}
</script>
</html>