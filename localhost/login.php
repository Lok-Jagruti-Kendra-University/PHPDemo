<!DOCTYPE html>
<html>
<head>
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <form action="login-check.php" method="post">
        <h2>Логин</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label>Имя пользователя</label>
        <input type="text" name="uname" placeholder="Имя пользователя"><br>

        <label>Пароль</label>
        <input type="password" name="password" placeholder="Пароль"><br>

        <button type="submit">Логин</button>
          <a href="signup.php" class="ca">Создать аккаунт</a>
          <a href="index.php" class="ca">Выйти</a>
     </form>
</body>
</html>