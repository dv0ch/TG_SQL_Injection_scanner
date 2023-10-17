<?php
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];
echo($user_id);
if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   session_destroy();
   unset($_SESSION);
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

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
      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item "><a href="update_profile.php" class="nav-link">Изменить данные профиля</a>
      </ul>
    </div>
  </nav>
<div class="container">

   <div class="profile">
      <?php
         $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
     
    
      ?>
      <h3><?php echo $fetch['name']; ?></h3>

      <a class="delete-btn" href="profile.php?logout=true">Выход</a>
      
   </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>