<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/css/master.css">
    <link rel="stylesheet" href="/css/admin.css">
  </head>
  <body>

    <div class="container">

      <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/admin-bar.php") ?>
      <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/tools.php") ?>

      <div class="content">

      <?php

        if (isset($_GET['page'])) {
          $page = new Page($_GET['page']);

          if (isset($_GET['confirm'])) {
            $page->delete();
            header('Location: /admin');
            exit();
          }

          echo "<h2>Deletion of $page->title</h2>";
          echo "<p>Are you sure you want to delete this page?</p>";
          echo "<a class='button' href='/admin'>Cancel<a>";
          echo "<a class='button' href='/admin/delete.php?page=$page->slug&confirm=true'>Confirm<a>";
        }

       ?>
  </body>
</html>
