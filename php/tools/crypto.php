<?php

  require_once($_SERVER["DOCUMENT_ROOT"] . "/../php/tools/users.php");

  function verifyKey($username, $password) {
    $user = new User($username);
    return password_verify($password, $user->hash);
  }

  function generateHash($password) {
    return password_hash($password, PASSWORD_DEFAULT);
  }


  function verifyKeyOld($username, $password) {
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

 ?>
