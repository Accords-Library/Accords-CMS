<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Accord's CMS</title>
    <link rel="stylesheet" href="/css/master.css">
    <link rel="stylesheet" href="/css/admin/admin.css">
    <link rel="stylesheet" href="/css/admin/users/users.css">

  </head>
  <body>

    <div class="container">

      <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/../templates/admin/adminbar.php") ?>
      <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/../php/tools/users.php") ?>

      <div class="content">

        <div class="title">
          <h2>Users</h2>
          <a class='button outline' href='/admin/users/add.php'><i class="fa-solid fa-plus"></i></a>
        </div>

        <div class="user-list">

          <p>Name</p>
          <p>Role</p>
          <p></p>
          <p></p>
          <p></p>

          <?php

            // Get all MD files
            foreach (getListSlug() as $slug) {

              $user = new User($slug);

              echo "<p> - " . $user->name . "</p>";
              echo "<p>" . $user->role . "</p>";
              echo "<a class='button' href='/$user->slug'><i class='fa-solid fa-eye'></i></a>";
              if (getCurrentUser()->role === 'admin') {
                echo "<a class='button' href='/admin/users/edit.php?slug=$user->slug'><i class='fa-solid fa-pen-to-square'></i></a>";
                echo "<a class='button' href='/admin/users/delete.php?slug=$user->slug'><i class='fa-solid fa-trash-can'></i></a>";
              } else {
                echo "<a class='button disabled'><i class='fa-solid fa-pen-to-square'></i></a>";
                echo "<a class='button disabled'><i class='fa-solid fa-trash-can'></i></a>";
              }
            }
            echo '</div>';

           ?>

      </div>


      </div>

    </div>

  </body>
</html>
