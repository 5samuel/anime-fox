<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to you WebApp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="./css/video.css">
  </head>
  <body>
  <video src="./anime/fondo/1.mp4" autoplay muted lopp ></video>
    <?php require 'partials/header.php' ?>
    <center>
<main>
    <?php if(!empty($user)): ?>
      <br> Bienvenido/a <?= $user['email']; ?>
      <br>Ha iniciado sesión correctamente
      <a href="logout.php">
      Cerras Sesion
      </a>
    </main>
    </center>
    <?php else: ?>

      <center>
        <main>
     

      <a href="login.php">Login</a> or
      <a href="signup.php">SignUp</a>
    </main>
      </center>
    <?php endif; ?>
  </body>
</html>
