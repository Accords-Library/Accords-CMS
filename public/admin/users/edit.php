<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/css/master.css">
    <link rel="stylesheet" href="/css/admin/admin.css">
    <link rel="stylesheet" href="/css/admin/users/edit.css">
  </head>
  <body>

    <div class="container">

      <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/../templates/admin/adminbar.php") ?>
      <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/../php/tools/users.php") ?>
      <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/../php/tools/admin.php") ?>

      <div class="content">

      <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

          $originalSlug = $_POST['originalSlug'];
          $newSlug = sluggify($_POST['slug']);



          if (!$originalSlug) {
            // This is the creation of a new page
            $page = new User();
            $page->name = $_POST['name'];
            $page->slug = $newSlug;
            $page->role = $_POST['role'];
            $page->password = $_POST['password'];
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

          $user = new User($_GET['slug']);

          if ($user->slug) {
            echo "<h2>Editing $user->slug</h2>";
          } else {
            echo "<h2>Creating a new user</h2>";
          }

          echo "
          <form action='edit.php' method='post'>
            <input type='text' name='slug' placeholder='Username...' value='$user->slug' required><br>
            <input type='text' name='name' placeholder='Displayed name...' value='$user->slug' required><br>
            <select name='role'>
              <option value='contributor'>Contributor</option>
              <option value='author'>Author</option>
              <option value='editor'>Editor</option>
              <option value='admin'>Admin</option>
            </select>
            <br>
            <input type='password' name='password' placeholder='Password...' required><br>
            <textarea name='content' placeholder='Description...'>$user->content</textarea><br>
            <input type='hidden' name='originalSlug' value='" . $_GET['slug'] . "'>
            <input class='button outline' type='submit'>
          </form>
          ";
        }

       ?>




  </body>
</html>
