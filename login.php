<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: login.php');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = 'lo sentimos tu correo o contraseña son incorrectas';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: inicio.html");
    } else {
      $message = 'lo sentimos tu correo o contraseña son incorrectas';
    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Animes Fox</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="./css/video.css">
  </head>
  <body >
  <video src="./anime/fondo/1.mp4" autoplay muted loop  ></video>
 
    <?php require 'partials/header.php' ?>
    <center>
<main>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Login</h1>
    <span>or <a href="signup.php">SignUp</a></span>

    <form action="login.php" method="POST">
      <input name="email" type="text" placeholder="Enter your email">
      <input name="password" type="password" placeholder="Enter your Password">
      <input type="submit" value="Submit">
    </form>
    </main>
    </center>
  </body>
</html>
