<?php
  include_once('functions.php')
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>HelloKitty</title>
    <link rel="stylesheet"  href="style_2.css">
  <link href="http://fonts.fontstorage.com/import/opensans.css" ref="stylesheet">
  </head>
  <body>
    <header>
    <div class="header__logo"><p>KLYPOZZZ</p></div>
    <nav>
      <div class="topnav" id="myTopnav">
        <a href="index.php">HOME</a>
        <a href="tasks.php">TASKS</a>
        <a href="login.php">LOGIN</a>
        <a href="#" id="menu" class="icon">&#9776;</a>
      </div>
    </nav>
  </header>
    <form method="post" enctype="multipart/form-data">
      <input type="file" name="file">
      <input type="submit" value="Загрузить файл!">
    </form>
    <?php
    // если была произведена отправка формы
    if(isset($_FILES['file'])) {
      // проверяем, можно ли загружать изображение
      $check = can_upload($_FILES['file']);
    
      if($check === true){
        // загружаем изображение на сервер
        make_upload($_FILES['file']);
        echo "<strong>Файл успешно загружен!</strong>";
      }
      else{
        // выводим сообщение об ошибке
        echo "<strong>$check</strong>";  
      }
    }
    ?>
  </body>
</html>
