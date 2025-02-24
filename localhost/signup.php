<!DOCTYPE html>
<html>
<head>
	<title>SIGN UP</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <form action="signup-check.php" method="post">
     	<h2>Регистрация</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

          <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>

          <label>Имя</label>
          <?php if (isset($_GET['name'])) { ?>
               <input type="text" 
                      name="name" 
                      placeholder="Имя"
                      value="<?php echo $_GET['name']; ?>"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="name" 
                      placeholder="Имя"><br>
          <?php }?>

          <label>Имя пользователя</label>
          <?php if (isset($_GET['uname'])) { ?>
               <input type="text" 
                      name="uname" 
                      placeholder="Имя пользователя"
                      value="<?php echo $_GET['uname']; ?>"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="uname" 
                      placeholder="Имя пользователя"><br>
          <?php }?>


     	<label>Пароль</label>
     	<input type="password" 
                 name="password" 
                 placeholder="Пароль"><br>

          <label>Подтверждение пароля</label>
          <input type="password" 
                 name="re_password" 
                 placeholder="Подтверждение пароля"><br>

     	<button type="submit">Регистрация</button>
          <a href="login.php" class="ca">Уже есть аккаунт?</a>
     </form>
</body>
</html>