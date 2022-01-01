<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Accord's CMS</title>
    <link rel="stylesheet" href="/css/master.css">
    <link rel="stylesheet" href="/css/admin/admin.css">
    <link rel="stylesheet" href="/css/admin/pages/pages.css">

  </head>
  <body>

    <div class="container">

      <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/../templates/admin/adminbar.php") ?>
      <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/../php/tools/pages.php") ?>
      <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/../php/tools/admin.php") ?>

      <div class="content">

        <div class="title">
          <h2>Pages</h2>
          <a class='button outline' href='/admin/pages/edit.php?slug='><i class="fa-solid fa-plus"></i></a>
        </div>

        <div class="page-list">

          <p>Title</p>
          <p>Author</p>
          <p>Last edit</p>
          <p></p>
          <p></p>
          <p></p>

          <?php

            // Get all MD files
            foreach (getListSlugPages() as $pageSlug) {

              $page = new Page($pageSlug);

              echo "<p> - " . $page->title . "</p>";
              echo "<p>" . $page->author . "</p>";
              echo "<p>" . unixToDate($page->mDate) . "</p>";
              echo "<a class='button' href='/news/$page->slug'><i class='fa-solid fa-eye'></i></a>";
              echo "<a class='button' href='/admin/pages/edit.php?slug=$page->slug'><i class='fa-solid fa-pen-to-square'></i></a>";
              echo "<a class='button' href='/admin/pages/delete.php?slug=$page->slug'><i class='fa-solid fa-trash-can'></i></a>";
            }
            echo '</div>';

           ?>

      </div>

    </div>

  </body>
</html>
