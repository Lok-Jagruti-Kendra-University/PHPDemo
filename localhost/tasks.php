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
      $conn = mysqli_connect("localhost", "root", "root", "jana");
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

  <br><br><button onclick="location.href = 'mainPage.php';" id=mainPageBtn class='btn'>Go back</button>
  <br><br><button onclick="location.href = 'home.php';" id=homeBtn class='btn'>Back home</button>
</body>
</html>

<?php 
} else {
     header("Location: index.php");
     exit();
}
 ?>