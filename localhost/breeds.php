<!DOCTYPEhtml>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>HelloKitty</title>
  <link rel="stylesheet"  href="style_2.css">
  <link href="http://fonts.fontstorage.com/import/opensans.css" ref="stylesheet">
</head>
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
<?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
?>

<html>
<head>
  <link rel='stylesheet' type='text/css' href='stlz.css'>
  <title>CATS</title>
</head>

<body class="mainStl">
  <div class="headr">TASKS</div><br>
  <table id='tableMainPage' align=center border="1">
  <!--<table width=70% text-align=center background-color=#ff3bf8 border=1 align=center>-->
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Start typing a breed.." title="Search for breeds"><br>



    <tr class='header'>
      <th>Предмет</th>
      <th>Описание</th>
      <th>Фото</th>
    </tr>

    <?php
      $conn = mysqli_connect("localhost", "root", "root", "janna");
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      $sql = "select name as breed, description, price from breeds;";

      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>". $row["breed"]. "</td><td>". $row["description"]. "</td><td>". $row["price"]. "</tr>";
        }
      } else { 
        echo "0 results"; 
      }

      $conn->close();
    ?>
  </table>
    <!-- В этом js идёт фильтрация-->
  <script>
  function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("tableMainPage");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  </script>
</body>
</html>

<?php 
} else {
     header("Location: index.php");
     exit();
}
 ?>