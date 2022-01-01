<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/css/master.css">
    <link rel="stylesheet" href="/css/admin/admin.css">
    <link rel="stylesheet" href="/css/admin/pages/edit.css">
  </head>
  <body>

    <div class="container">

      <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/../templates/admin/adminbar.php") ?>
      <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/../php/tools/pages.php") ?>
      <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/../php/tools/admin.php") ?>

      <div class="content">

      <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

          $originalSlug = $_POST['originalSlug'];
          $newSlug = sluggify($_POST['slug']);



          if (!$originalSlug) {
            // This is the creation of a new page
            $page = new Page();
            $page->title = $_POST['title'];
            $page->slug = $newSlug;
            $page->author = $_SESSION['loginUsername'];
            $page->cDate = time();
            $page->mDate = time();
            $page->content = $_POST['content'];

          } else {
            // This is modification of an existing page
            $page = new Page($originalSlug);
            $page->title = $_POST['title'];
            $page->mDate = time();
            $page->content = $_POST['content'];
            if ($originalSlug !== $newSlug) {
              // The page needs to be moved
              $page->slug = $originalSlug;
              $page->rename($newSlug);
            }
          }

          $page->write();

          header('Location: /admin/pages');
          exit();

        } else if (isset($_GET['slug'])) {

          $page = new Page($_GET['slug']);

          if ($page->slug) {
            echo "<h2>Editing $page->title</h2>";
          } else {
            echo "<h2>Editing a new page</h2>";
          }

          echo "
          <form action='edit.php' method='post'>
            https://new.accords-library.com/<input type='text' name='slug' placeholder='' value='$page->slug' required><br>
            Title: <input type='text' name='title' placeholder='A great title...' value='$page->title' required><br>
            <textarea name='content' placeholder='Some awesome content...'>$page->content</textarea><br>
            <input type='hidden' name='originalSlug' value='" . $_GET['slug'] . "'>
            <input class='button outline' type='submit'>
          </form>
          ";
        }

       ?>

  </body>
</html>
