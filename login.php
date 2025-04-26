<?php
//Mengkoneksikan login.php dengan connection.php
include("connection.php");

$user = new Users();

if(isset($_POST['login'])) { //Isset utk cek variabel, udh ada/blm
    $user->set_login_data($_POST['user_id'], $_POST['password']);

    $user_id = $user->get_user_id();
    $password = $user->get_password();

    $sql = "SELECT * FROM users WHERE user_id='$user_id' AND password='$password'";
    $result = $db->query($sql);

    if($result->num_rows > 0) {
        //Mapping data atau memunculkan data yg diinginkan dari db
        while ($data = $result->fetch_assoc()) {
            session_start();
            $_SESSION['user_id'] = $data['user_id'];
            $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
            $_SESSION['role'] = $data['role'];
            $_SESSION['status'] = "login";

            if($data['role'] == "Admin") {
                header("location:dashboard/index-admin.php?message=Berhasil login admin!");
            } else {
            header("location:dashboard/index.php?message=Selamat datang😀");
            }
        }

    } else {
        header("location:index.php?message=Silahkan masukkan data yang benar!😐");
    }
}


?>