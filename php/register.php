<?php

include 'config.php';

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    $tel_user_id = mysqli_real_escape_string($conn, $_POST['tel_user_id']);

    $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

    if (mysqli_num_rows($select) > 0) {
        $message[] = 'user already exist';
    } else {
        if ($pass != $cpass) {
            $message[] = 'confirm password not matched!'; 
        } else {
            $insert = mysqli_query($conn, "INSERT INTO `user_form`(name, email, password,tel_user_id) VALUES('$name', '$email', '$pass','$tel_user_id')") or die('query failed');

            if ($insert) {
                $message[] = 'registered successfully!';
                header('location:login.php');
            } else {
                $message[] = 'registeration failed!';
            }
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/reg_and_log.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a href="../../index.php" class="navbar-brand">Ssscaner</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse " id="navbar" navbar>
            <ul class="navbar-nav ">
                <li class="nav-item "><a href="../index.php" class="nav-link">Главная страница</a></li>
                <li class="nav-item "><a href="profile.php" class="nav-link">Личный кабинет</a></li>
            </ul>
        </div>
    </nav>
    <div class="form-container" style='background-image: url(../pictures/reg.jpg);'>

        <form action="" method="post" enctype="multipart/form-data">
            <h3>register now</h3>
            <?php
            if (isset($message)) {
                foreach ($message as $message) {
                    echo '<div class="message">' . $message . '</div>';
                }
            }
            ?>
            <div class="box">
                <input type="text" name="name" required>
                <label for="">Username</label>
            </div>
            <div class="box">
                <input type="email" name="email" required>
                <label for="">Email</label>
            </div>
            <div class="box">
                <input type="password" name="password" required>
                <label for="">Password</label>
            </div>
            <div class="box">
                <input type="password" name="cpassword" required>
                <label for="">Confirm password</label>
            </div>
            <div class="box">
                <input type="tel_user_id" name="tel_user_id" required>
                <label for="">Уникальный ключ для регистрации</label>
            </div>
            <input type="submit" name="submit" value="register now" class="btn btn-lg btn-primary">
            <p>already have an account? <a href="login.php">login now</a></p>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <body>