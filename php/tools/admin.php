<?php

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  function unixToDate($unixTime) {
    return date('Y-m-d', $unixTime);
  }

  function sluggify($string) {
    $string = strtolower($string);
    $string = str_replace(' ', '-', $string);

    $string = str_split($string);
    $result = "";
    $slugAcceptable = "abcdefghijklmnopqrstuvwxyz0123456789-";
    foreach ($string as $c) {
      if (stripos($slugAcceptable, $c) !== false) $result .= $c;
    }
    $result = trim($result, "-");
    return $result;
  }

 ?>
