<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/tools.php") ?>

    <?php

      if (isset($_GET['p'])) {
        $page = new Page($_GET['p']);
        echo $page->parse();
      }

     ?>

  </body>
</html>
