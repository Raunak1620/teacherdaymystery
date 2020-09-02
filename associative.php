<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form class="associative.php" action="associative.php" method="post">
    Enter Name:<input type="text" name="namee" >
    Enter Name:<input type="number" name="id" >
    <input type="submit" name="SUBMIT" value="">
    </form>
    <?php
    $nam = $_POST["namee"];
    $id = array('Name' => '$nam');
    echo implode($id);
     ?>
  </body>
</html>
