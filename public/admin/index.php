<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Accord's CMS</title>
    <link rel="stylesheet" href="/css/master.css">
    <link rel="stylesheet" href="/css/admin.css">
  </head>
  <body>

    <div class="container">

      <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/admin-bar.php") ?>
      <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/tools.php") ?>

      <div class="content">

        <div class="title">
          <h2>Pages</h2>
          <a class='button' href='/admin/edit.php?page='>Create a new page</a>
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
            echo "<a class='button' href='/$page->slug'>View</a>";
            echo "<a class='button' href='/admin/edit.php?page=$page->slug'>Edit</a>";
            echo "<a class='button' href='/admin/delete.php?page=$page->slug'>Delete</a>";
          }
          echo '</div>';

         ?>

      </div>

    </div>

  </body>
</html>
