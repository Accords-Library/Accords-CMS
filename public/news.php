<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>



    <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/../php/tools/pages.php") ?>

    <?php
      if (isset($_GET['slug'])) {
        $slug = substr($_GET['slug'], 6);
        $page = new Page($slug);
        echo $page->parse();
      }

     ?>

  </body>
</html>
