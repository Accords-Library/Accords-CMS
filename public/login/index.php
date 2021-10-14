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

        if (session_status() == PHP_SESSION_NONE) {
          session_start();
        }

        function verifyKey($username, $password) {
          $csv = file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/../credentials.csv');
          $hashes = explode(PHP_EOL, $csv);
          foreach ($hashes as $hash) {
            $hash = explode(';', $hash);
            if ($hash[0] == $username) {
              $hash = substr($hash[2], 0, -1);
              return password_verify($password, $hash);
            }
          }
          return false;
        }

        if ($_POST['submitButton'] == "Submit") {

          $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
          $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

          if (verifyKey($username, $password)) {
            $_SESSION['loginUsername'] = $username;
            header('Location: /admin');
          } else {
            unset($_SESSION['loginUsername']);
            echo '<p id="answer">The account name or password that you have entered is incorrect.</p>';
            echo '<style>body{animation: bw 1s;animation-fill-mode: forwards;}#container{animation: shake 0.2s;animation-iteration-count: 2;}</style>';
          }

          //echo '<p>' . $username . ';' . password_hash($password, PASSWORD_DEFAULT) . '</p>';

        }

        ?>

   </div>

 </html>
