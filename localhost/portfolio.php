<!DOCTYPEhtml>
<html lang="en">
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
				<a href="portfolio.php">Portfolio</a>
				<a href="">TASKS</a>
				<a href="login.php">Profile</a>
				<a href="#" id="menu" class="icon">&#9776;</a>
			</div>
		</nav>
	</header>
	<table align=center border="1">
	<tr>
	  <th>id</th>
	  <th>description</th>
	  <th>subjects_id</th>
	</tr>

	<?php
	  $conn = mysqli_connect("localhost", "root", "root", "janna");
	  if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	  }
	  $sql = "SELECT * FROM tasks";

	  $result = $conn->query($sql);
	  if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	      echo "<tr><td>" . $row["id"]. "</td><td>" . $row["description"] . "</td><td>". $row["subjects_id"]. "</td></tr>";
	    }
	  } else { 
	    echo "0 results"; 
	  }

	  $conn->close();
	?>
	</table>
	<script src="script.js"></script>


</body>
</html>