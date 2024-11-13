<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
</head>

<body>
    <section class="d-flex h-100 justify-content-center align-items-center " id="Login">
        <form class="bg-secondary p-3  align-middle rounded">
            <label for="password" class="form-label">masukkan username  </label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="username">@</span>
                <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="username">
            </div>


            <label for="password" class="form-label">masukkan email</label>
            <div class="input-group mb-3">
                <input type="email" class="form-control" aria-label="email address" placeholder="example@example.com">
            </div>

            <label for="password" class="form-label">masukkan password</label>
            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control" aria-label="password" placeholder="">
            </div>

            <p>sudah memiliki akun silahkan <a href="index.php">login disini</a></p>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </section>
</body>

</html>