<?php
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}
;

if (isset($_GET['logout'])) {
   session_destroy();
   unset($_SESSION);
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="description" content="">
   <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
   <meta name="generator" content="Hugo 0.84.0">
   <title>Sidebars · Bootstrap v5.0</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/profile.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   <style>
      .bd-placeholder-img {
         font-size: 1.125rem;
         text-anchor: middle;
         -webkit-user-select: none;
         -moz-user-select: none;
         user-select: none;
      }

      @media (min-width: 768px) {
         .bd-placeholder-img-lg {
            font-size: 3.5rem;
         }
      }
   </style>
</head>

<body>
   <div class="row">
      <div class="d-flex flex-column flex-shrink-0 p-1 text-white bg-dark sticky-top " style="width: 280px; height: 100vh;">
         <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <svg class="bi me-2" width="40" height="32">
               <use xlink:href="#bootstrap" />
            </svg>
            <span class="fs-4" href="../index.php">Ssscaner</span>
         </a>
         <hr>
         <ul class="nav nav-pills cover-container d-flex flex-column  col-sm p-1 mx-auto" style="height: 100vh;">
            <li class="nav-item">
               <a href="../index.php" class="nav-link active" aria-current="page">
                  Главная
               </a>
            </li>
            <li>
               <a href="update_profile.php" class="nav-link text-white">
                  Изменить данные профиля
               </a>
            </li>
            <li>
               <a href="profile.php?logout=true" class="nav-link text-white">
                  Выход
               </a>
            </li>
         </ul>
         <hr>
         <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
               id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
               <img src="../pictures/telegram-ico.jpg" alt="" width="32" height="32" class="rounded-circle me-2">
               <?php
               $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
               if (mysqli_num_rows($select) > 0) {
                  $fetch = mysqli_fetch_assoc($select);
               }
               ?>
               <h3>
                  <?php echo $fetch['name']; ?>
               </h3>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">

               <li><a class="dropdown-item" href="profile.php?logout=true">Sign out</a></li>
            </ul>
         </div>
      </div>


      <div class="col-sm  bg-gradient table_part" style="padding:0">
         <table class="table table-dark  table-bordered table-striped table-hover table_table" style= "width:90%">
            <thead>
               <tr>
                  <th>#</th>
                  <td colspan="2" class="">Страница</td>
                  <td>Результат сканирования</td>
               <tr>
            </thead>
            <tbody>
               <tr>
                  <th scope="row">1</th>
                  <td colspan="2" class="table-active">http://testphp.vulnweb.com/artists.php?artist=1</td>
                  <td>http://testphp.vulnweb.com/artists.php?artist=1:___:[+] SQL Injection vulnerability detected, link: http://testphp.vulnweb.com/artists.php?artist=1'<br>
http://testphp.vulnweb.com/listproducts.php:___:[+] SQL Injection vulnerability not detected in URL. Cheking for forms. [+] Forms with vulnerability not detected.<br>
http://testphp.vulnweb.com/login.php:___:[+] SQL Injection vulnerability not detected in URL. Cheking for forms. [+] Forms with vulnerability not detected.<br>
http://testphp.vulnweb.com/Mod_Rewrite_Shop/Details/web-camera-a4tech/2/:___:None<br>
http://testphp.vulnweb.com/signup.php:___:[+] SQL Injection vulnerability not detected in URL. Cheking for forms. [+] Forms with vulnerability not detected.<br>
http://testphp.vulnweb.com/disclaimer.php:___:[+] SQL Injection vulnerability not detected in URL. Cheking for forms. [+] Forms with vulnerability not detected.<br>
http://testphp.vulnweb.com/Mod_Rewrite_Shop/:___:None<br>
http://testphp.vulnweb.com/hpp/:___:None<br>
http://testphp.vulnweb.com/userinfo.php:___:[+] SQL Injection vulnerability not detected in URL. Cheking for forms. [+] Forms with vulnerability not detected.<br>
http://testphp.vulnweb.com/categories.php:___:[+] SQL Injection vulnerability not detected in URL. Cheking for forms. [+] Forms with vulnerability not detected.<br>
http://testphp.vulnweb.com/Mod_Rewrite_Shop/Details/color-printer/3/:___:None<br>
http://testphp.vulnweb.com/Mod_Rewrite_Shop/BuyProduct-3/:___:None<br>
http://testphp.vulnweb.com/artists.php:___:[+] SQL Injection vulnerability not detected in URL. Cheking for forms. [+] Forms with vulnerability not detected.<br>
http://testphp.vulnweb.com/cart.php:___:[+] SQL Injection vulnerability not detected in URL. Cheking for forms. [+] Forms with vulnerability not detected.<br>
http://testphp.vulnweb.com/guestbook.php:___:[+] SQL Injection vulnerability not detected in URL. Cheking for forms. [+] Forms with vulnerability not detected.<br>
http://testphp.vulnweb.com/index.php:___:[+] SQL Injection vulnerability not detected in URL. Cheking for forms. [+] Forms with vulnerability not detected.<br>
http://testphp.vulnweb.com/Mod_Rewrite_Shop/BuyProduct-1/:___:None<br>
http://testphp.vulnweb.com/privacy.php:___:None<br>
http://testphp.vulnweb.com/Mod_Rewrite_Shop/RateProduct-1.html:___:None<br>
http://testphp.vulnweb.com/AJAX/index.php:___:None<br>
http://testphp.vulnweb.com/Mod_Rewrite_Shop/Details/network-attached-storage-dlink/1/:___:None<br>
http://testphp.vulnweb.com/Mod_Rewrite_Shop/RateProduct-3.html:___:None<br></td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>


   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"></script>
   <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

   <script>/* global bootstrap: false */
      (function () {
         'use strict'
         var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
         tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl)
         })
      })()
   </script>
</body>

</html>