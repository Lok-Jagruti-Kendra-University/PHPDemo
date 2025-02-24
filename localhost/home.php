<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <h1>ТЫ ВООБЩЕ КТО?!></h1>
</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>