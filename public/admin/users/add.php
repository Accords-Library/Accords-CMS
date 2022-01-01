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
      <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/../php/tools/crypto.php") ?>

      <div class="content">

      <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $user = new User();
          $user->name = $_POST['name'];
          $user->slug = sluggify($_POST['slug']);
          $user->role = $_POST['role'];
          $user->hash = generateHash($_POST['password']);
          $user->content = $_POST['content'];

          $user->write();

          header('Location: /admin/users');
          exit();

        } else {


          $user = new User();

          echo "
          <h2>Creating a new user</h2>
          <form action='/admin/users/add.php' method='post'>
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
            <input class='button outline' type='submit'>
          </form>
          ";
        }

       ?>

  </body>
</html>
