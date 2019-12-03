<?php
header("Refresh:2; url= order.php");
print_r($_POST);
try{
    include_once("connection.php");
    array_map("htmlspecialchars", $_POST);
    $stmt = $conn->prepare("INSERT INTO Basket(OrderID,SandwichID,SnackID,Sausage,DrinkID)VALUES (null,null,null,null,:sausage,null)");
            $stmt->bindParam(':sausage', $_POST["sausage"]);
            $stmt->execute();
            }
catch(PDOException $e)
    {
        echo "error".$e->getMessage();
    }

$conn=null;
?>