<?php
require "connection.php";
session_start();
if (isset($_SESSION['status']) && $_SESSION['status'] == "login") {
    header("location:dashboard/index.php?message=Selamat datang kembali..");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Absensi Page</title>
</head>
<body>
    <div class="container">
        <div class="wrapper">
            <h3 class="login-title">Login System</h3>
            <form action="login.php" method="POST" class="login-form">
                <?php
                if (isset($_GET['message'])) {
                    echo $_GET['message'];
                }
                ?>
                <input name="user_id" type="text" class="login-input" />
                <input name="password" type="password"  class="login-input" />
                <button type="submit" name="login" class="login-button">Masuk</button>
            </form> 
        </div>
    </div>
</body>
</html>