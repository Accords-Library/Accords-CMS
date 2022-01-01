<link rel="stylesheet" href="/css/admin/adminbar.css">
<link rel="stylesheet" href="/css/fontawesome.css">

<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/../php/tools/users.php") ?>

<?php
  // Authentification check
  if (session_status() == PHP_SESSION_NONE) session_start();
  if (!isset($_SESSION['loginUsername'])) {
    header('Location: /');
  }
 ?>

 <?php

    function isActive($url) {
      return $url === dirname($_SERVER["PHP_SELF"]);
    }

  ?>

<div id="admin-bar">
  <h1>Accord's CMS</h1>
  <a class="button icon invert <?php if (isActive('/admin/pages')) echo 'active'; ?>" href="/admin/pages"><i class="fa-solid fa-file-lines"></i></a>
  <a class="button icon invert <?php if (isActive('/admin/users')) echo 'active'; ?>" href="/admin/users"><i class="fa-solid fa-user"></i></a>
  <a class="button icon invert <?php if (isActive('/admin/comments')) echo 'active'; ?>" href="/admin/comments"><i class="fa-solid fa-comment"></i></a>
  <a class="button icon invert <?php if (isActive('/admin/scripts')) echo 'active'; ?>" href="/admin/scripts"><i class="fa-solid fa-code"></i></a>
  <a class="button icon invert <?php if (isActive('/admin/settings')) echo 'active'; ?>" href="/admin/settings"><i class="fa-solid fa-gear"></i></a>
  <div id="logout">
    <p>Welcome <?php echo getCurrentUser()->name; ?></p>
    <a class="button invert outline" href="/admin/logout.php">Logout</a>
  </div>
</div>
