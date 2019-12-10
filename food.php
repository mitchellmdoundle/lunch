<?php
session_start();
if ($_SESSION['Role']!=1)
{
  header("Location:Login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Food</title>
</head>
<body>
<form action="addfood.php" method="post">
  <input type="radio" name="type" value="Sandwich" checked> Sandwich<br>
  <input type="radio" name="type" value="Snack"> Snack<br>
  <input type="radio" name="type" value="Drink"> Drink<br>
  Name:<input type="text" name="name"><br>
  <input type="submit" value="Add Food Item to Options">
</form>
<?php
include_once('connection.php');
$stmt = $conn->prepare("SELECT * FROM food ORDER BY Type Asc");
$stmt->execute();
echo("<br>");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
  if ($row["Type"]==0){
    $type="Sandwich";
  }
  else if ($row["Type"]==1){
    $type="Snack";
  }
  else if ($row["Type"]==2){
    $type="Drink";
  }
  else{
    $type="How did you do this.";
  }
echo($type.', '.$row["Name"]."<br>");
}
?>
<a href="http://localhost/lunch/showorders.php">Show Orders</a>
</body>
</html>
