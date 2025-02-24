<?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
?>

<html>
<head>
  <link rel='stylesheet' type='text/css' href='stlz.css'>
  <title>TASKS</title>
</head>

<body class="mainStl">
  <div class="headr">TASKS</div><br>
  <table id='tableMainPage' align=center border="1">
  <!--<table width=70% text-align=center background-color=#ff3bf8 border=1 align=center>-->
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Start typing.." title="Search for tasks"><br>



    <tr class='header'>
      <th>Предмет</th>
      <th>Описание</th>
      <th>Предмет</th>

    </tr>

    <?php
      $conn = mysqli_connect("localhost", "root", "root", "janna");
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
       $sql = "select subject, description, id from tasks;";

      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>". $row["subject"]. "</td><td>". $row["description"]. "</td><td>". $row["id"]. "</tr>";
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

        <a href="person.php">MYPAGE</a>
        <a href="logout.php">LOGOUT</a>
</body>
</html>

<?php 
} else {
     header("Location: index.php");
     exit();
}
 ?>