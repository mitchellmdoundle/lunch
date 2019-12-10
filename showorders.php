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
<title>Orders</title>
</head>
<body>
<?php
include_once('connection.php');
$stmt = $conn->prepare("SELECT user.Forename as FN, user.Surname as SN, user.House as H, orders.OrderID as Orid, orders.Dateneeded as dateneeded FROM user 
INNER JOIN orders ON orders.UserID= user.UserID 
where Complete = 0
ORDER BY Dateneeded ASC
");
$stmt->execute();
echo("<br>");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
//echo($row["FN"].', '.$row["SN"].', '.$row["H"].', '.$row["Orid"]."<br>");
    $temp=$row['Orid'];
    $stmt1 = $conn->prepare("SELECT sw.Name as Swn, sn.Name as Snn, dr.Name as Drn, basket.Sausage as saus from basket 
        INNER JOIN food as sw on basket.SandwichID = sw.FoodID
        INNER JOIN food as sn on basket.SnackID = sn.FoodID
        INNER JOIN food as dr on basket.DrinkID = dr.FoodID
        where OrderID=$temp
    ");
    $stmt1->execute();
    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
    {
        if($row1["saus"]==1){
            $saus="Sausage Roll";
        }
        else{
            $saus="No Sausage Roll";
        }
        echo($row["dateneeded"]." - ".$row["FN"].', '.$row["SN"].', '.$row["H"].': '.$row1["Swn"].", ".$row1["Snn"].", ".$row1["Drn"].", ".$saus
        .' '.'<form action="updateorders.php" method="post">
        <input type="hidden" name="Orderid" value="'.$temp.'">
        <input type="submit" name="done" value="Done">
        </form>'.'<br>');
    }




/* $stmt1 = $conn1->prepare("SELECT * FROM basket");
    $stmt1->execute();
    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
    {
    echo($row["OrderID"].', '.$row1["UserID"].', '.$row1["Dateneeded"].', '.$row1["Complete"]."<br>");
    } */
}
/*$stmt = $conn->prepare("UPDATE players SET Active=:active WHERE UserID=$player");
$stmt->bindParam(':active', $_POST[$player]);    
$stmt->execute();*/
?>

<a href="http://localhost/lunch/food.php">Add a New Food Option</a><br>
<a href="http://localhost/lunch/login.php">Log Out</a>
</body>
</html>