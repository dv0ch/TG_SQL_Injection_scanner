<?php

include 'config.php';
session_start();

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

    $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

    if (mysqli_num_rows($select) > 0) {
        $row = mysqli_fetch_assoc($select);
        $_SESSION['user_id'] = $row['id'];
        header('location:profile.php');
    } else {
        $message[] = 'incorrect email or password!';
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/reg_and_log.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a href="../index.php" class="navbar-brand">Ssscaner</a>
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
    <div class="form-container" style='background-image: url(../pictures/log.jpg)'>

        <form action="" method="post" enctype="multipart/form-data">
            <h3>login now</h3>
            <?php
            if (isset($message)) {
                foreach ($message as $message) {
                    echo '<div class="message">' . $message . '</div>';
                }
            }
            ?>
            <div class="box">
                <input type="email" name="email" required>
                <label for="">Email</label>
            </div>
            <div class="box">
                <input type="password" name="password" required>
                <label for="">Password</label>
            </div>
            <input type="submit" name="submit" value="login now" class="btn btn-lg btn-primary">
            <p>don't have an account? <a href="register.php">register now</a></p>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <body>