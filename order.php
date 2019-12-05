<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Order Food</title>
</head>
<body>
<br>
<form action="addtoorder.php" method="post">

Sandwich:
<select name = "sandwich">
<?php

include_once('connection.php');
$stmt = $conn->prepare("SELECT * from Food where type = 0");
$stmt->execute();


while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
echo('<option value='.$row["FoodID"].'>'.$row["Name"].'</option>');
}
?>
</select>
<br>

Snack: 
<select name = "snack">
<?php

$stmt = $conn->prepare("SELECT * from Food where type = 1");
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
echo('<option value='.$row["FoodID"].'>'.$row["Name"].'</option>');
}
?>
</select>
<br>

Drink: 
<select name = "drink">
<?php

$stmt = $conn->prepare("SELECT * from Food where type = 2");
$stmt->execute();


while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
echo('<option value='.$row["FoodID"].'>'.$row["Name"].'</option>');
}
?>
</select>
<br>
Sausage Roll:
<input type="radio" name="sausage" value="Yes" checked> Yes
<input type="radio" name="sausage" value="No"> No<br>
<input type="submit" value="Add to Basket">

<?php
$stmt = $conn->prepare("SELECT * FROM basket");
$stmt->execute();
echo("<br>");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
?>
</form>
<?php
echo $_SESSION["loggedinuser"];
?>




















<br><a href="http://localhost/lunch/login.php">Log Out</a>
</body>
</html>