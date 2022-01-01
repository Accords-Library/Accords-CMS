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
      <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/../php/tools/users.php") ?>
      <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/../php/tools/admin.php") ?>

      <div class="content">

        <?php

          if (getCurrentUser()->role !== 'admin') {
            header('Location: /admin/users');
            exit();
          }

          if (isset($_GET['slug'])) {
            $user = new User($_GET['slug']);

            if (isset($_GET['confirm'])) {
              $user->delete();
              header('Location: /admin/users');
              exit();
            }

            echo "<h2>Deletion of $user->name</h2>";
            echo "<p>Are you sure you want to delete this page?</p>";
            echo "<a class='button outline' href='/admin'>Cancel<a>";
            echo "<a class='button outline' href='/admin/users/delete.php?slug=$user->slug&confirm=true'>Confirm<a>";
          }

         ?>

      </div>
    </div>
  </body>
</html>
