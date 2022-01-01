<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/css/master.css">
    <link rel="stylesheet" href="/css/admin/admin.css">
    <link rel="stylesheet" href="/css/admin/pages/delete.css">
  </head>
  <body>

    <div class="container">

      <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/../templates/admin/adminbar.php") ?>
      <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/../php/tools/pages.php") ?>
      <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/../php/tools/admin.php") ?>

      <div class="content">

        <?php

          if (isset($_GET['slug'])) {
            $page = new Page($_GET['slug']);

            if (isset($_GET['confirm'])) {
              $page->delete();
              header('Location: /admin/pages');
              exit();
            }

            echo "<h2>Deletion of $page->title</h2>";
            echo "<p>Are you sure you want to delete this page?</p>";
            echo "<a class='button outline' href='/admin'>Cancel<a>";
            echo "<a class='button outline' href='/admin/pages/delete.php?page=$page->slug&confirm=true'>Confirm<a>";
          }

         ?>

      </div>
    </div>
  </body>
</html>
