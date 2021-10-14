<div id="admin-bar">
  <h1>Accord's CMS</h1>
  <?php
    if (session_status() == PHP_SESSION_NONE) session_start();
    if (isset($_SESSION['loginUsername'])) {
      echo '<div id="logout">Welcome ' . $_SESSION['loginUsername'] . '<a class="button" href="/admin/logout.php">Logout</a></div>';
    } else {
      header('Location: /');
    }
   ?>
</div>
