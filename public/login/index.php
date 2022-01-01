<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Accord's Library - Login</title>
    <link rel="stylesheet" href="/css/master.css">
    <link rel="stylesheet" href="/css/login.css">
  </head>

   <div id="container">
     <form method="POST" action="/login" id="myForm">
       <img src="/img/favicon.png" alt="">
       <h1>Accord's Library</h1>
       <input type="text" name="username" placeholder="Username" value="<?php if (isset($_POST['username'])) echo $_POST['username'] ?>" autocomplete="username" required>
       <input type="password" name="password" placeholder="Password" autocomplete="current-password" required>
       <button type="submit" name="submitButton" value="Submit">Sign In</button>
     </form>

      <?php

        if ($_POST['submitButton'] == "Submit") {

          $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
          $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

          require_once($_SERVER["DOCUMENT_ROOT"] . "/../php/tools/crypto.php");

          if (session_status() == PHP_SESSION_NONE) {
            session_start();
          }

          if (verifyKey($username, $password)) {
            $_SESSION['loginUsername'] = $username;
            header('Location: /admin/pages');
          } else {
            unset($_SESSION['loginUsername']);
            echo '<p id="answer">The account name or password that you have entered is incorrect.</p>';
            echo '<style>body{animation: bw 1s;animation-fill-mode: forwards;}#container{animation: shake 0.2s;animation-iteration-count: 2;}</style>';
          }

        }

        ?>

   </div>

 </html>
