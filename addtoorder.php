<?php
session_start();
header("Refresh:1; url= order.php");
//print_r($_POST);
try{
    include_once("connection.php");
    array_map("htmlspecialchars", $_POST);
    switch($_POST["sausage"]){
        case "No":
            $saus=0;
            break;
        case "Yes":
            $saus=1;
            break;  
    }
    $stmt = $conn->prepare("INSERT INTO basket(OrderID,SandwichID,SnackID,Sausage,DrinkID)VALUES (null,:sandwich,:snack,:sausage,:drink)");
    $stmt->bindParam(':sandwich', $_POST["sandwich"]);
    $stmt->bindParam(':sausage', $saus);
    $stmt->bindParam(':snack', $_POST["snack"]);
    $stmt->bindParam(':drink', $_POST["drink"]);
            $stmt->execute();
            }
catch(PDOException $e)
    {
        echo "error".$e->getMessage();
    }


//echo ("<br>");
//echo $_SESSION["loggedinuser"];
//echo ("<br>");
echo ("Order made");
$stmt = $conn->prepare("SELECT OrderID FROM basket ORDER BY OrderID DESC LIMIT 1");
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    $stmt1 = $conn->prepare("INSERT INTO orders (OrderID,UserID,Dateneeded,Complete)VALUES (:orderid,:userid,:dateneeded,0)");
    $stmt1->bindParam(':userid', $_SESSION["loggedinuser"]);
    $stmt1->bindParam(':dateneeded', $_POST["dateneeded"]);
    $stmt1->bindParam(':orderid', $row["OrderID"]);
    $stmt1->execute();
}
$conn=null;
?>