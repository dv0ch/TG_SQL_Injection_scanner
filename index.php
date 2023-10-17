<?php
include 'php/config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION);
  header('location:php/login.php');
}

?>

<!doctype html>
<html lang="en" class="h-100">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.84.0">
  <title>Cover Template · Bootstrap v5.0</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">



  <!-- Bootstrap core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../css/index.css">
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

<body class=" h-100 text-center text-white  bg-dark element">


  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark fs-5" >
    <a href="../../index.php" class="navbar-brand">Ssscaner</a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse " id="navbar" navbar>
      <ul class="navbar-nav ">
        <li class="nav-item "><a href="#" class="nav-link">Главная страница</a></li>
        <li class="nav-item "><a href="php/profile.php" class="nav-link">Личный кабинет</a></li>
      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

        <?php if (isset($user_id)): ?>
          <li class="nav-item"><a href="index.php?logout=true" class="nav-link">Выход</a>
          <?php else: ?>
          <li class="nav-item "><a href="/php/login.php" class="nav-link">Логин</a>
          <?php endif;
        ?>
      </ul>
    </div>
  </nav>

  <div class="cover-container d-flex w-100 h-100 p-1 mx-auto flex-column">
    <header class="mb-auto ">
      <div>
        <nav class="nav nav-masthead justify-content-center float-md-end ">

          <a class="nav-link " data-bs-toggle="offcanvas" href="#offcanvasExample" aria-controls="offcanvasExample"
            style="margin-right:1em; font-size:1.5em">
            Особенности
          </a>

          <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel" style="min-width:25%">
            <div class="offcanvas-header" style="background-color:#1e1e1e; color:white;text-align: center">
              <h1 class="offcanvas-title" id="offcanvasExampleLabel" style="font-size:2em">Особенности</h1>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div style="border-bottom:solid #414a4c; margin-bottom: auto;"></div>

            <div class="offcanvas-body" style="background-color:#1e1e1e; color:white">
              <div style="max-width: 300px;margin-top:1em;margin:auto">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                deserunt mollit anim id est laborum
              </div>
              <div><img src="pictures/log.jpg" alt="" style="max-width: 300px;margin-top:1em;"></div>

              <div style="border-bottom:solid #414a4c; margin-bottom: auto;"></div>

              <div class="offcanvas-body" style="background-color:#1e1e1e; color:white">
                <div style="max-width: 300px;margin:auto">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                  dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                  aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                  dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                  officia deserunt mollit anim id est laborum
                </div>
                <div><img src="pictures/log.jpg" alt="" style="max-width: 300px;margin-top:1em;"></div>
              </div>
              <div style="border-bottom:solid #414a4c; margin-bottom: auto;"></div>

              <div class="offcanvas-body" style="background-color:#1e1e1e; color:white">
                <div style="max-width: 300px;margin:auto">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                  dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                  aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                  dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                  officia deserunt mollit anim id est laborum
                </div>
                <div><img src="pictures/log.jpg" alt="" style="max-width: 300px;margin-top:1em;"></div>
              </div>
            </div>

          </div>
          <!---===========================================================================================================--->
          <button class="nav-link" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
            aria-controls="offcanvasRight" style="margin-right:1em; font-size:1.5em">Информация</button>

          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header" style="background-color:#1e1e1e; color:white">
              <h5 class="offcanvas-title" id="offcanvasRightLabel" style="font-size:2em">Информация</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div style="border-bottom:solid #414a4c; margin-bottom: auto;">
            </div>
            <div class="offcanvas-body" style="background-color:#1e1e1e; color:white">
              ...
            </div>
          </div>
        </nav>
      </div>
    </header>

    <main class="px-1">
      <h1>Телеграмм-сканнер</h1>
      <h1>SQL-инъекций</h1>
      <p class="lead" style="font-size:1.5em">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
        officia deserunt mollit anim id est laborum</p>
      <p class="lead">
        <a href="https://t.me/sscanerbot" class="btn btn-lg btn-secondary fw-bold border-white bg-white">Telegram</a>
      </p>
    </main>

    <footer class="mt-auto text-white-50">

    </footer>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>


</body>

</html>