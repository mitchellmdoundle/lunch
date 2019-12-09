<!DOCTYPE html>
<html>
<head>
<title>Orders</title>
</head>
<body>
<?php
include_once('connection.php');
$stmt = $conn->prepare("SELECT user.Forename as FN, user.Surname as SN, user.House as H, orders.OrderID as Orid FROM user INNER JOIN  orders ON orders.UserID= user.UserID where Complete = 0");
$stmt->execute();
echo("<br>");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
echo($row["FN"].', '.$row["SN"].', '.$row["H"].', '.$row["Orid"]."<br>");





/* $stmt1 = $conn1->prepare("SELECT * FROM basket");
    $stmt1->execute();
    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
    {
    echo($row["OrderID"].', '.$row1["UserID"].', '.$row1["Dateneeded"].', '.$row1["Complete"]."<br>");
    } */
}
?>
</body>
</html>