<?php


  $pagesFolder = $_SERVER["DOCUMENT_ROOT"] . '/../pages/';

  class Page {
    public $title;
    public $slug;
    public $author;
    public $cDate;
    public $mDate;
    public $content;

    function __construct($pageSlug = '') {
      if (existPage($pageSlug)) {
        $pageJSON = json_decode(file_get_contents(getPageJSONPath($pageSlug)));
        foreach ($pageJSON as $key => $value) {
          $this->$key = $value;
        }
        $this->slug = $pageSlug;
      }
    }

    function write() {
      $filePath = getPageJSONPath($this->slug);

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
      $filePath = getPageJSONPath($this->slug);
      if (file_exists($filePath)) {
        unlink($filePath);
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

  function getListSlugPages() {
    global $pagesFolder;
    $pages = scandir($pagesFolder);
    $pages = array_slice($pages, 2);
    $result = array();
    foreach ($pages as $page) {
      if (substr($page, -5, 5) == '.json') {
        array_push($result, substr($page, 0, -5));
      }
    }
    return $result;
  }

  function existPage($pageSlug) {
    return file_exists(getPageJSONPath($pageSlug));
  }

  function getPageJSONPath($pageSlug) {
    global $pagesFolder;
    return $pagesFolder . $pageSlug . '.json';
  }


 ?>
