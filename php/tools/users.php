<?php


  $rootFolder = $_SERVER["DOCUMENT_ROOT"] . '/../users/';

  class User {
    public $name;
    public $slug;
    public $role;
    public $hash;
    public $content;

    function __construct($slug = '') {
      if (exist($slug)) {
        $json = json_decode(file_get_contents(getPathJSON($slug)));
        foreach ($json as $key => $value) {
          $this->$key = $value;
        }
        $this->slug = $slug;
      }
    }

    function write() {
      $filePath = getPathJSON($this->slug);

      // Remove attributes that should be serialized
      $slug = $this->slug;
      unset($this->slug);

      $file = fopen($filePath, 'w');
      fwrite($file, json_encode($this));
      fclose($file);

      // Add them back
      $this->slug = $slug;
    }

    function delete() {
      if (exist($this->slug)) {
        unlink(getPathJSON($this->slug));
      }
    }

    function rename($newSlug) {
      rename(getPageJSONPath($this->slug), getPageJSONPath($newSlug));
      $this->slug = $newSlug;
    }

    function parse() {
      require_once($_SERVER["DOCUMENT_ROOT"] . "/../php/Parsedown.php");
      $parsedown = new Parsedown();
      $parsedown->setSafeMode(true);
      return $parsedown->text($this->content);
    }
  }

  function getListSlug() {
    global $rootFolder;
    $items = scandir($rootFolder);
    $result = array();
    foreach ($items as $item) {
      if (substr($item, -5, 5) == '.json') {
        array_push($result, substr($item, 0, -5));
      }
    }
    return $result;
  }

  function exist($slug) {
    return file_exists(getPathJSON($slug));
  }

  function getPathJSON($slug) {
    global $rootFolder;
    return $rootFolder . $slug . '.json';
  }

  function getCurrentUser() {
    return new User($_SESSION['loginUsername']);
  }


 ?>
