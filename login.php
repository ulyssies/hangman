<?php
// login.php

include "authentication.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (authenticateUser($username, $password)) {
        // Redirect to hangman.php upon successful login
        header("Location: hangman.php");
        exit();
    } else {
        echo '<div class="alert alert-danger text-center" role="alert">
                  Invalid username or password
              </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "menu.php" ?>

    <div class="container">
        <h1 class="text-center">Login</h1>
        <form method="post" action="" class="row g-5">
            <div class="col-auto">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="col-auto">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Login</button>
            </div>
        </form>
    </div>

    <?php include "footer.php"; ?>
</body>

</html>